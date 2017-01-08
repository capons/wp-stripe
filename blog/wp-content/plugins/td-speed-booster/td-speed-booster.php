<?php
/*
	Plugin Name: tagDiv Speed Booster
	Plugin URI: http://tagdiv.com
	Description: Speed booster for Newspaper and Newsmag theme - It moves the styles and all the scripts of the theme to the bottom when needed. It activates internal theme optimizations for better speed and it adds async js .
	Author: tagDiv
	Version: 3.2
	Author URI: http://tagdiv.com
*/

/*

    3.2 - better bbpress support on newsmag
    3.1 - fixed issue with flashing white on load on newspaper theme
        - better compatibility with themes that do not have wp booster framework
        - Newsmag loads fonts in a bundle now
    3.0 - better visual composer support
    2.8 - Newsmag support added :)
    2.7 - fixed ie 9 10 11 window resize bug
    2.6 - fixed rendering bug on the loading of the page
    2.5 - code improvements, newspaper 4 compatibility
        - makes most of the javascript files use defer parsing
        - better compatibility with revolution slider
    2.4 - updated jquery version
        - support for https
    2.3 - fixed warnings when trying to move javascript files that are not registered
 */


define('TD_SPEED_BOOSTER' , 'v3.2');


class td_speed_booster {

    var $styles_for_footer = array(); // here we keep all the stylesheets IDs that we want to move to the footer

    var $is_ie = false; // if the browser is detected as IE, treat it differently

    var $async_js_scripts = array(
        'contact-form-7',
        'bbpress',
        'woocommerce',
        'site',
        'devicepx',
        'js_composer_front'
    );


    var $td_theme_name = '';
    var $td_theme_version = '';
    var $td_deploy_mode = '';


    function __construct() {
        add_action('td_wp_booster_loaded', array($this, 'td_wp_booster_loaded'));
    }


    function td_wp_booster_loaded() {
        // read the theme version and name if defined
        if (defined('TD_THEME_VERSION') and defined('TD_THEME_NAME') and defined('TD_DEPLOY_MODE')) {
            $this->td_theme_version = TD_THEME_VERSION;
            $this->td_theme_name = TD_THEME_NAME;
            $this->td_deploy_mode = TD_DEPLOY_MODE;
        } else {
            return;
        }


        // detect IE 8 9 10 11
        if (!empty($_SERVER['HTTP_USER_AGENT']) and (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false))) {
            $this->is_ie = true;
        }

        // add hooks
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts_hook'), 1002);  // 1002 priority - because visual composer has 1000 and we use 1001 in the wp010 theme
        add_action('wp_footer', array($this, 'wp_footer_hook'), 15);
        if ($this->is_ie === false) {
            add_action('wp_head', array($this, 'wp_head_hook'), 15);
        }
    }



    function enqueue_scripts_hook() {
        global $wp_scripts;

        //detect revmin - revolution slider and do not move jquery
        if( !is_admin() and !isset($wp_scripts->registered['revmin'])){
            if (is_ssl()) {
                $td_protocol = 'https';
            } else {
                $td_protocol = 'http';
            }

            wp_deregister_script('jquery');
            wp_register_script('jquery', ($td_protocol . '://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'), true, '1.11.1', true);
            wp_enqueue_script('jquery');
        }


        if ($this->td_theme_name == 'Newsmag') {
            // wp 010
            //$this->move_style_to_footer('js_composer_front');
            //$this->move_style_to_footer('js_composer_custom_css');
        }

        // Newsmag dosn't move the css to the bottom as such, bbpress should stay at the top
        if ($this->td_theme_name != 'Newsmag') {
            $this->move_style_to_footer('bbp-default-bbpress');  //bpress old
            $this->move_style_to_footer('bbp-default');  //bpress
            $this->move_style_to_footer('google-font-rest');
            $this->move_style_to_footer('contact-form-7');
        }



        /**
         * Move the style only on newspaper
         * @todo move the style also on newsmag after we fix all the issues
         */
        if ($this->is_ie === false and $this->td_theme_name == 'Newspaper') {
            $this->move_style_to_footer('td-bootstrap');
            $this->move_style_to_footer('td-theme'); //this is the main style of the theme, it depends on td-bootstrap to load
        }


        $this->move_style_to_footer('woocommerce_frontend_styles');

        //jetpack lost styles
        $this->move_style_to_footer('jetpack-subscriptions');
        $this->move_style_to_footer('jetpack-widgets');

        /**
         * move javascript to footer
         */
        $this->move_js_to_footer('themepunchtools');
        $this->move_js_to_footer('revmin');


        // remove strange custom.css file loaded by visual composer
        wp_deregister_style('js_composer_custom_css');



        // replace comment-reply.min.js with inline version


    }


    function wp_footer_hook() {
        //get the theme version for style
        $current_theme_version = $this->td_theme_version;

        //on demo mode, autogenerate version hourly + day
        if ($this->td_deploy_mode == 'demo') {
            $current_theme_version = date('jG');
        }



        foreach ($this->styles_for_footer as $style_id => $style_src) {
            echo "<link rel='stylesheet' id='" . $style_id . "-css'  href='" . $style_src . "?ver=" . $current_theme_version . "' type='text/css' media='all' />\n";
        }
    }



    function wp_head_hook() {
        if ($this->td_theme_name == 'Newspaper') {
            echo '<style>body {visibility:hidden;}</style>';
        }
    }



    function move_style_to_footer($style_id) {
        global $wp_styles;
        if (!empty($wp_styles->registered[$style_id]) and !empty($wp_styles->registered[$style_id]->src)) {
            $this->styles_for_footer[$style_id] = $wp_styles->registered[$style_id]->src;
            wp_deregister_style($style_id);
        }
    }

    function move_js_to_footer($js_id) {
        global $wp_scripts;
        if (isset($wp_scripts->registered[$js_id])) {
            wp_enqueue_script($js_id, ($wp_scripts->registered[$js_id]->src), '', $wp_scripts->registered[$js_id]->ver, true);
        }

    }


    function async_js_hook($url) {
        //check to see if we have js
        if (strpos( $url, '.js' ) === false) {
            return $url;
        }
        if ($this->strpos_array($url, $this->async_js_scripts) === false) {
            return $url;
        } else {
            return "$url' defer='defer";
        }
    }


    private function strpos_array($haystack_string, $needle_array, $offset=0) {
        foreach($needle_array as $query) {
            if(strpos($haystack_string, $query, $offset) !== false) {
                return true; // stop on first true result
            }
        }
        return false;
    }


}





new td_speed_booster();

