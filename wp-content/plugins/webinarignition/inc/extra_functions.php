<?php

// fnc fix permalink uri variable deliminator
// --------------------------------------------------------
   function wi_fixPerma($postID = false, $url = false)
   {
      $pml = $url;
      if(!$pml) {
         $pml = $postID ? get_permalink($postID) : get_permalink();
      }
      $pml = ((strpos($pml, '?') !== false) ? "$pml&" : "$pml?");

      return $pml;
   }
// --------------------------------------------------------



function display($var, $placeholder)
{
    // check if var is set
    if ($var == "") {
        echo $placeholder;
    } else {
        echo stripcslashes($var);
    }
}



function wi_generate_key($length = 32)
{
    $str = "";
    $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}

// ####################################
//
//  Get PHP Timezone List
//
// ####################################
function tz_list()
{
    $zones_array = array();
    $timestamp = time();
    //$wi_timezone = date_default_timezone_get();
    foreach (timezone_identifiers_list() as $key => $zone) {
        //date_default_timezone_set($zone);
        $zones_array[$key]['zone'] = $zone;
        $zones_array[$key]['diff_from_GMT'] = wi_get_time_tz($timestamp, $zone, false, false, true);
    }
    //date_default_timezone_set($wi_timezone);
    return $zones_array;
}

function wi_get_time_tz($time, $timezone, $format = '12hour', $time_suffix = false, $zoneonly = false)
{
    $current_timezone = date_default_timezone_get();
    date_default_timezone_set($timezone);
    // Times
    switch ($format) {
        case "12hour":
            $time = date("g:i A", strtotime($time));
            break;
        case "24hour":
            $time = date("H:i", strtotime($time));
            break;
        default:
            break;
    }
    //$formatted_time = ($zoneonly ? "" : $time . " ") . 'UTC' . (preg_replace("%[+-]0%", "", (preg_replace("%([+-])0%", "$1", preg_replace("%:00%", "", date('P', $time)))))) . ($time_suffix ? " {$time_suffix}" : "");

    $utc = date('Z', strtotime(($time))) / 60 / 60;
    $utc = $utc > 0 ? '+'.$utc : $utc;

    $formatted_time = ($zoneonly ? "" : $time . " ") . 'UTC' . $utc;

    date_default_timezone_set($current_timezone);
    return $formatted_time;
}

function create_tz_select_list($selected = false)
{
    $region = "";
    ?>
    <select name="webinar_timezone" id="webinar_timezone"
            class="inputField inputFieldDash elem ">
        <?php
        foreach (tz_list() as $key => $timezone) {
        preg_match("%(.*?)/(.*)%", $timezone['zone'], $matches);
        if ($region != $matches[1]) {
        $region = $matches[1];
        if ($key != 0) { ?></optgroup><?php } ?>
        <optgroup label="<?php echo $region; ?>">
            <?php } ?>
            <option value="<?php print $timezone['zone'] ?>" <?php
            if ($selected == $timezone['zone']) {
                echo "selected";
            }
            ?>><?php echo "{$matches[2]} ({$timezone['diff_from_GMT']})"; ?></option>
            <?php } ?>
        </optgroup>
    </select>
<?php }

// ####################################
//
//  Translate Days or Months
//
// ####################################

function wi_translate_dm($data, $output = '', $type = 'months')
{
    $data = array_filter(explode(",", $data));
    if ($type == 'months') {
        $englishMonths = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $englishMonthsabbr = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

        // String Replace Months
        if (!empty($data)) {
            foreach ($englishMonths as $key => $month) {
                $output = preg_replace("%$month(?=\W)%", $data[$key], $output);
            }
            foreach ($englishMonthsabbr as $key => $month) {
                $output = preg_replace("%$month(?=\W)%", $data[$key], $output);
            }
        }
        return $output;
    }
    if ($type == 'days') {
        $englishDays = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $englishDaysabbr = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');

        if (!empty($data)) {
            foreach ($englishDays as $key => $day) {
                $output = preg_replace("%$day(?=\W)%", $data[$key], $output);
            }
            foreach ($englishDaysabbr as $key => $day) {
                $output = preg_replace("%$day(?=\W)%", $data[$key], $output);
            }
        }

        return $output;
    }


}

// ####################################
//
//  Convert UTC To TZID (Olson Time)
//
// ####################################
function wi_convert_utc_to_tzid($utc)
{
    switch ($utc) {
        case "-11":
            return "US/Samoa";
            break;
        case "-10":
            return "HST";
            break;
        case "-930":
            return "Pacific/Marquesas";
            break;
        case "-9":
            return "America/Adak";
            break;
        case "-8":
            return "America/Anchorage";
            break;
        case "-7":
            return "MST";
            break;
        case "-6":
            return "US/Mountain";
            break;
        case "-5":
            return "EST";
            break;
        case "-430":
            return "America/Caracas";
            break;
        case "-4":
            return "America/New_York";
            break;
        case "-3":
            return "Canada/Atlantic";
            break;
        case "-2":
            return "Atlantic/South_Georgia";
            break;
        case "-1":
            return "Atlantic/Cape_Verde";
            break;
        case "0":
            return "GMT";
            break;
        case "+1":
            return "Europe/London";
            break;
        case "+2":
            return "CET";
            break;
        case "+3":
            return "EET";
            break;
        case "+4":
            return "Asia/Dubai";
            break;
        case "+5":
            return "Indian/Maldives";
            break;
        case "+530":
            return "Asia/Calcutta";
            break;
        case "+545":
            return "Asia/Katmandu";
            break;
        case "+6":
            return "Asia/Dacca";
            break;
        case "+630":
            return "Indian/Cocos";
            break;
        case "+7":
            return "Asia/Bangkok";
            break;
        case "+8":
            return "Hongkong";
            break;
        case "+9":
            return "Japan";
            break;
        case "+930":
            return "Australia/Adelaide";
            break;
        case "+10":
            return "Australia/Melbourne";
            break;
        case "+11":
            return "Asia/Sakhalin";
            break;
        case "+12":
            return "NZ";
            break;
        default:
            return $utc;
    }
}

function wi_get_lead_evergreen($lead_id)
{
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";
    $leadinfo = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_db_name WHERE id = %d",
        array(
            $lead_id
        )
    ), OBJECT);

    return $leadinfo;
}

function wi_get_lead_live($lead_id)
{
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_leads_new";
    $leadinfo = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_db_name WHERE id = %d",
        array(
            $lead_id
        )
    ), OBJECT);

    return $leadinfo;
}

function wi_webinar_live_notification_times($start_date, $start_time)
{
    $newDate = strtotime($start_date[2] . "-" . $start_date[0] . "-" . $start_date[1]);
    $newTime = strtotime($start_time);

    $notification_times = array();
    $notification_times['live']['date'] = date("m-d-Y", $newDate);
    $notification_times['live']['time'] = date("H:i", $newTime);
    $notification_times['daybefore']['date'] = date("m-d-Y", strtotime('-1 day', $newDate));
    $notification_times['daybefore']['time'] = $notification_times['live']['time'];
    $notification_times['hourbefore']['date'] = $notification_times['live']['date'];
    $notification_times['hourbefore']['time'] = date("H:i", strtotime('-1 hour', $newTime));
    $notification_times['hourafter']['date'] = $notification_times['live']['date'];
    $notification_times['hourafter']['time'] = date("H:i", strtotime('+1 hour', $newTime));
    $notification_times['dayafter']['date'] = date("m-d-Y", strtotime('+1 day', $newDate));
    $notification_times['dayafter']['time'] = $notification_times['live']['time'];

    return $notification_times;
}

function prettifyNotificationTitle($num)
{
    switch ($num) {
        case 1:
            return "Day Before Notification";
            break;
        case 2:
            return "Hour Before Notification";
            break;
        case 3:
            return "Live Notification";
            break;
        case 4:
            return "Hour After Notification";
            break;
        case 5:
            return "Day After Notification";
            break;
    }


}
