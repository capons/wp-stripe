<?php

/* * **************************** */
/* * **************************** */
/* * *    CONFIGURATION         * */
/* * **************************** */
/* * **************************** */


$user_timeout = 1; // How long until a user is considered inactive (IN MINUTES)


/* * **************************** */
/* * **************************** */
/* * *    END CONFIGURATION     * */
/* * **************************** */
/* * **************************** */


ini_set("display_errors", false);
ini_set("error_reporting", false);
$js_mode = isset($_REQUEST['s']);
if ($js_mode) {
    header("Content-type: text/javascript");
}


// for php4 support:
if (!function_exists('file_put_contents')) {

    function file_put_contents($filename, $data) {
        $f = @fopen($filename, 'w');
        if (!$f) {
            return false;
        } else {
            $bytes = fwrite($f, $data);
            fclose($f);
            return $bytes;
        }
    }

}
// for win/linux support
if (!function_exists('funky_get_temp_dir')) {

    function funky_get_temp_dir() {
        if (!empty($_ENV['TMP'])) {
            return realpath($_ENV['TMP']);
        }
        if (!empty($_ENV['TMPDIR'])) {
            return realpath($_ENV['TMPDIR']);
        }
        if (!empty($_ENV['TEMP'])) {
            return realpath($_ENV['TEMP']);
        }
        $tempfile = tempnam(uniqid(rand(), TRUE), '');
        if (file_exists($tempfile)) {
            unlink($tempfile);
            return realpath(dirname($tempfile));
        }
        return false;
    }

}


// for win/linux support
if (!function_exists('get_user_online_count')) {

    function get_user_online_count($type = false, $full = true) {
        global $counter_matrix;
        $user_types = array();
        foreach ($counter_matrix as $key => $val) {
            if (!isset($user_types[$val['user_type']])) {
                $user_types[$val['user_type']] = 0;
            }
            $user_types[$val['user_type']]++;
        }
        if ($full) {
            $print = '';
            while (count($user_types)) {
                //foreach($user_types as $user_type => $count){
                $user_type = key($user_types);
                $user_count = array_shift($user_types);
                if ($type && $user_type != $type)
                    continue;
                if ($print != '') {
                    if (count($user_types))
                        $print .= ', ';
                    else
                        $print .= ' and ';
                } else {

                }
                $print .= $user_count . ' ' . $user_type . (($user_count > 1) ? '' : '');
            }
            if (!$print) {
                if ($type) {
                    $print = '0';
                } else {
                    $print = '0';
                }
            } else {
                $print .= '';
            }
            return $print;
        } else {
            if ($type) {
                return (isset($user_types[$type])) ? $user_types[$type] : 0;
            } else {
                return count($counter_matrix);
            }
        }
    }

}

$user_hash = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $_SERVER['HTTP_X_FORWARDED_FOR']);
$counter_file = funky_get_temp_dir() . "/ctemp_." . md5($_SERVER['HTTP_HOST']);
if (!isset($user_type))
    $user_type = ($_REQUEST['u']) ? $_REQUEST['u'] : '';

// add or edit this user
if (!is_file($counter_file)) {
    if (!touch($counter_file)) {
        $error = "Unable to create temp file for live counter: '.$counter_file.'";
        if ($js_mode) {
            echo 'if(typeof console!=="undefined") console.log("' . $error . '");';
        } else {
            echo $error;
        }
    }
}

$counter_matrix = @unserialize(@file_get_contents($counter_file));
if (!is_array($counter_matrix)) {
    $counter_matrix = array();
}

if (!isset($_REQUEST['n']) && !isset($counter_stop_recording)) {
    // overwrite existing ones too. incase membership type changes, and also updates their time.
    $counter_matrix[$user_hash] = array(
        "user_type" => $user_type,
        "time" => time()
    );
}

// do a cleanup.
$inactive_time = time() - ($user_timeout * 60);
foreach ($counter_matrix as $key => $val) {
    if ($val['time'] < $inactive_time) {
        unset($counter_matrix[$key]);
    }
}

// write back
file_put_contents($counter_file, serialize($counter_matrix));


// now work out how many users are online
if ($js_mode) {
    if (isset($_REQUEST['t'])) {
        // display total user count.
        $type = ($_REQUEST['t']) ? $_REQUEST['t'] : false;
        $print = get_user_online_count($type, true);
        echo 'document.write("' . $print . '");';
    } else if (isset($_REQUEST['c'])) {
        $type = ($_REQUEST['c']) ? $_REQUEST['c'] : false;
        $count = get_user_online_count($type, false);
        echo 'document.write("' . $count . '");';
    }
}

