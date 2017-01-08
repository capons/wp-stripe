<?php

add_action('wp_ajax_nopriv_webinarignition_auto_lp_get_dates', 'webinarignition_auto_lp_get_dates_callback');
add_action('wp_ajax_webinarignition_auto_lp_get_dates', 'webinarignition_auto_lp_get_dates_callback');
function webinarignition_auto_lp_get_dates_callback()
{

    // Prototype For Evergreen Webinar
    // Get Variables
    $tz = $_POST['tz'];
    $ID = $_POST['id'];
    $weekdays = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
    // Get Results
    $results = get_option('webinarignition_campaign_' . $ID);

    // Timezone
    date_default_timezone_set($tz);

    // Calculate next days for a week
    $date_format = get_option("date_format");

    $next_day = array();
    foreach ($weekdays as $__day) {
        $_next_day = date('Y-m-d', strtotime("next " . ucfirst($__day)));
        $_next_day_formatted = date($date_format, strtotime($_next_day)); // 'l\, M\. j\, Y'
        $next_day[$__day] = array($_next_day, $_next_day_formatted);
    }
    // Today date
    $today_date = date('Y-m-d');
    $today_formatted = date($date_format, strtotime($today_date));
    $today_date_lang = strtolower(date('l', strtotime($today_date)));


    // Day Toggles
    $day_toggle = array(
        'monday' => $results->auto_monday,
        'tuesday' => $results->auto_tuesday,
        'wednesday' => $results->auto_wednesday,
        'thursday' => $results->auto_thursday,
        'friday' => $results->auto_friday,
        'saturday' => $results->auto_saturday,
        'sunday' => $results->auto_sunday
    );

    // Dates Array
    $dates = array();

    // Add Today
    if ($results->auto_today == "yes") {
        $todayCopyTranslate = "Instant Access / Today";
        if ($results->auto_translate_instant == "") {
        } else {
            $todayCopyTranslate = $results->auto_translate_instant;
        }
        $dates['instant_access'] = $todayCopyTranslate;
    }


    // The following block builds an array with days the size of a week, starting with tomorrow's day
    $week_traversal = array();
    $_pos = array_search($today_date_lang, $weekdays, TRUE);
    $_rel_pos = (($_pos + 1) > (count($weekdays) - 1) ? 0 : ($_pos + 1));
    $week_traversal = array_merge($week_traversal, array_slice($weekdays, $_rel_pos));
    $week_traversal = array_merge($week_traversal, array_slice($weekdays, 0, $_rel_pos));

    // Add today if there are hours available for registration (if not too late)
    if ($day_toggle[$today_date_lang] == 'yes')
        $dates[$today_date] = $today_formatted;

    foreach ($week_traversal as $__day) {
        if ($day_toggle[$__day] == 'yes') {
            $dates[$next_day[$__day][0]] = $next_day[$__day][1];
        }
    }

    // Final Step = Translate Days
    $days = $results->auto_translate_days;

    // Final Step = Translate Months
    $months = $results->auto_translate_months;

    // Remove Holidays & Blacklisted Dates
    $blacklisted_dates = $results->auto_blacklisted_dates;
    $blacklisted_dates = explode(", ", $blacklisted_dates);
    foreach ($blacklisted_dates as $date) {
        unset($dates[$date]);
    }

    $jsondates = json_encode($dates);

    $jsondates = wi_translate_dm($months, $jsondates);
    echo wi_translate_dm($days, $jsondates, 'days');
    die();

}