<?php
/*
  Plugin Name: Webinar Ignition
  Description: WebinarIgnition is a premium webinar solution that allows you to create, run and manage webinars.  Build and fully customize, professional webinar registration, confirmation, live webinar and replay pages with ease..
  Version: 1.9.58
  Author: Mark Thompson, and Dylan Jones
 */


define('WEBINARIGNITION_URL', plugins_url('/', __FILE__));
define('WEBINARIGNITION_PATH', plugin_dir_path(__FILE__));

// Activation Here:
register_activation_hook(__FILE__, 'webinarignition_installer');
include("inc/activation.php");
include("WI_Logs.php");

//$plugin_info = get_site_transient('update_plugins');
//if(version_compare($plugin_info->checked[plugin_basename(__FILE__)],'1.8.61', '<') === true) {
    global $wpdb;

    $table_name = $wpdb->prefix . "wi_logs";

    if($wpdb->get_var("show tables like '$table_name'") != $table_name) {

	    $sql = "CREATE TABLE `$table_name` (
			`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			`campaign_id` bigint(20) unsigned DEFAULT NULL,
		    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		    `type` tinyint(4) DEFAULT NULL,
            `message` text NOT NULL,
            PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta($sql);
    }

//}

ini_set("display_errors", 0);
error_reporting(E_ALL);

// Functions
include("inc/extra_functions.php");


// AJAX Callbacks:
include("inc/callback.php");
include("inc/callback2.php");

// Email service integration
require_once "inc/email_service_integration.php";

include("inc/autowebinar_get_dates.php");

// Image Uploader:
include("inc/image.php");

// Menu Here:
include("inc/menu.php");

// Dashboard:
include("UI/index.php");

// Page Link:
include("inc/page_link.php");

// NEW :: Shortcode Widget
include("inc/shortcode_widget.php");

// extra stuff
function wi_admin_scripts()
{
    wp_enqueue_script('jquery-ui-sortable');
}

add_action('admin_enqueue_scripts', 'wi_admin_scripts');

// Updates
    require plugin_dir_path( __FILE__ ) . 'plugin-update-checker/plugin-update-checker.php';
    $MyUpdateChecker = PucFactory::buildUpdateChecker(
    'http://vcs.digitalkickstart.com/wp-updates/?action=get_metadata&slug=webinarignition', //Metadata URL.
    __FILE__, //Full path to the main plugin file.
    'webinarignition' //Plugin slug. Usually it's the same as the name of the directory.
    );
// --------------------------------------------------------------------------------------



// fix :: webinar preview security
// --------------------------------------------------------------------------------------
   function check_admin()
   {
      if (strstr($_SERVER['QUERY_STRING'], 'preview-') && !is_user_logged_in())
      {
         header("HTTP/1.1 403 Forbidden");
         ob_get_clean();
         exit();
      }
   }

   add_action('init', 'check_admin');
// --------------------------------------------------------------------------------------

/*
 *  Translate month name if possible else just return english month
 *  @param $date string mm-dd-yyyy e.g. 25-12-2016
 *  @param $results wp options (object)
  *  */
function translate_date($date, $results) {
    $split_date = explode('-', $date);
    $translated_months = explode(',', $results->auto_translate_months);
    if (!empty($translated_months[$split_date[0] - 1])) {
        $translated_month = trim($translated_months[$split_date[0] - 1]);
        return "{$split_date[1]} {$translated_month}, {$split_date[2]}";
    } else {
        return date('j M, Y', strtotime("{$split_date[2]}-{$split_date[0]}-{$split_date[1]}"));
    }
}
