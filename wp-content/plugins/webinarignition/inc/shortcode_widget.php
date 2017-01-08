<?php

function wi_shortcode_styles() {
    ob_start();
    ?>
    <style>
        .wi_webinar_widget {
            width: 100%;
            background-color: #fff;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            /*border: 1px solid rgba(0,0,0,0.1);*/
            /*border-bottom: 2px solid rgba(0,0,0,0.2);*/
            /*padding: 10px;*/
            margin: 15px 10px;

            font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            font-weight: 300;
        }

        .webinar_title {
            text-align: center;
            font-size: 24px;
            line-height: 36px;
            padding: 20px;
            border-bottom: 1px solid #DDD;
            color: #222222;
        }

        .wi_webinar_date {
            background-color: #C95456;
            color: #FFF;
            /*font-weight: bold;*/
            text-align: center;
            padding: 10px 20px;
            text-transform: uppercase;
            border-bottom: 2px solid rgba(0, 0, 0, 0.2);
            border-top: 2px solid rgba(0, 0, 0, 0.2);
        }

        .wi_webinar_sign_up {
            text-align: center;
            background-color: #F7F7F7;
            padding: 20px;
            border-bottom: 2px solid rgba(0, 0, 0, 0.2);
            color: #222222;
        }

        .wi_webinar_headline1 {
            display: block;
            font-size: 24px;
            font-weight: bold;
        }

        .wi_webinar_headline2 {
            display: block;
            margin-top: 5px;
            font-size: 14px;
        }

        .wi_signup_btn {
            border: 1px solid rgba(0, 0, 0, 0.1);
            width: 100% !important;
            background-color: #55B369 !important;
            display: block !important;
            margin-top: 10px !important;
            font-size: 18px !important;
            font-weight: bold !important;
            padding: 10px !important;
            border-radius: 5px !important;
            border-bottom: 2px solid rgba(0, 0, 0, 0.2) !important;
            text-decoration: none !important;
            color: #FFF !important;
            height: 46px !important;
            line-height: 23px !important;
        }

        .wi_signup_btn:hover {
            text-decoration: none !important;
            color: #FFF !important;
            background-color: #4ba05e !important;
        }

        .wi_webinar_input {
            display: block;
            margin-top: 10px;
            width: 100%;
            border-radius: 5px;
            height: 46px;
            line-height: 46px;
            padding-left: 10px;
            padding-right: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .wi_webinar_spam {
            border-top: 1px solid #DDD;
            padding-top: 15px;
            margin-top: 15px;
            text-transform: uppercase;
            font-size: 10px;
            color: #757575;
        }
    </style>
    <?php
    $custom_css = ob_get_clean();
    echo $custom_css;
}

add_action('wp_print_styles', 'wi_shortcode_styles');

function wiWidget($atts) {

    ob_start();

    // Get ID
    extract(shortcode_atts(array(
        'id' => '1'
    ), $atts));

    // Get Content From Options
    $results = get_option('webinarignition_campaign_' . $id);

    $liveWebbyDate = explode("-", $results->webinar_date);

    $autoDate = $liveWebbyDate[2] . "-" . $liveWebbyDate[0] . "-" . $liveWebbyDate[1];

    $mymonth = date('F', strtotime($autoDate));
    $myday = date('l', strtotime($autoDate));
    $myday_number = date('jS', strtotime($autoDate));
    $myear = date('Y', strtotime($autoDate));
    $autoDate_format = date('l\, F jS\, Y', strtotime($autoDate));
    // Final Step = Translate Months
    $months = $results->auto_translate_months;
    $days = $results->auto_translate_days;

    $autoDate_format = wi_translate_dm($months, $autoDate_format);
    $autoDate_format = wi_translate_dm($days, $autoDate_format, 'days');

    $autoTime = wi_get_time_tz($results->webinar_start_time,$results->webinar_timezone, $results->time_format, $results->time_suffix);

    $splitAutoDate = explode(",", $autoDate_format);
    $splitAutoDate2 = explode(".", $splitAutoDate[1]);

    $liveEventMonth = $splitAutoDate2[0];
    $liveEventDateDigit = $splitAutoDate2[1];
    $TZID = wi_convert_utc_to_tzid($results->webinar_timezone);
    $dateTime = new DateTime();
    $dateTime->setTimeZone(new DateTimeZone($TZID));
    $TZID = $dateTime->format('T');

    ?>

    <div class="wi_webinar_widget">
        <!-- webinar title -->
        <div class="webinar_title">
            <?php echo $results->webinar_desc; ?>
        </div>

        <div class="wi_webinar_date">
            <?php
            if ($results->lp_webinar_day)
                echo $results->lp_webinar_day;
            else
                echo $myday;
            ?>,

            <?php
            if ($results->lp_webinar_month)
                echo $results->lp_webinar_month;
            else
                echo $liveEventMonth;

            echo ' ', $myear;
            ?>

            <span>
				<?php //echo $results->lp_webinar_headline ? $results->lp_webinar_headline : $autoDate_format; ?>
			</span>
			<span>
				<?php
                if ($results->lp_webinar_subheadline) {
                    echo $results->lp_webinar_subheadline;
                } else {
                    echo '@' . $autoTime . ' ', $TZID;
                }
                ?>
	        </span>
        </div>

        <div class="wi_webinar_sign_up">
            <?php
            display(
                $results->lp_optin_headline, '<span class="wi_webinar_headline1" >RESERVE YOUR SPOT!</span>
									 <span class="optinHeadline2" >WEBINAR REGISTRATION</span>'
            );
            ?>

            <div class="wi_optin_form">

                <form name="input" action="<?php echo WEBINARIGNITION_URL . 'inc/lp/posted.php'; ?>" method="POST">
                    <input type="hidden" name="campaignID" value="<?php echo $id; ?>"/>
                    <input type="text" class="wi_webinar_input" id="name" name="name" placeholder="Enter your name... ">
                    <input type="email" class="wi_webinar_input" id="email" name="email"
                           placeholder="Enter your email address... ">
                    <input type="submit" value="<?php display($results->lp_optin_btn, "Register For The Webinar"); ?>"
                           class="wi_signup_btn"/>
                </form>

            </div>

            <div class="wi_webinar_spam">
                <?php display($results->lp_optin_spam, "* we will not spam, rent, sell, or lease your information *"); ?>
            </div>

        </div>


    </div>

    <?php    return ob_get_clean();   ?>


<?php
}

// Adding Widget
add_shortcode('wi_webinar', 'wiWidget');

// make shortcode work in text widget
add_filter('widget_text', 'do_shortcode');

?>