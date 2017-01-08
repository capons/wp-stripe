<?php
/**
 * This is the UI part of the social counter. 009 and 010 use different ui versions
 * User: ra
 * Date: 10/1/2014
 * Time: 11:26 AM
 */



class td_social_counter extends td_block {


    function __construct() {
        $this->block_id = 'td_social_counter';
        add_shortcode('td_social_counter', array($this, 'render'));
    }


    function render($atts){

        $td_social_api = new td_social_api();



        $this->block_uid = td_global::td_generate_unique_id(); //update unique id on each render


        extract(shortcode_atts(
            array(
                'icon_style' => '1', //not used
                'icon_size' => '32', //not yet used
                'custom_title' => '',
                'header_color' => '',
                'open_in_new_window' => ''
            ), $atts));


        $td_target = '';
        if (empty($open_in_new_window)) {
            $open_in_new_window = false;
        } else {
            $open_in_new_window = true;
            $td_target = ' target="_blank"';
        }


        $buffy = '';

        $buffy .= '<div id=' . $this->block_uid . ' class="td_block_wrap td_social widget widget_social">';
        $buffy .= $this->get_block_title_raw($atts, 'SOCIAL');


        foreach (td_social_icons::$td_social_icons_array as $td_social_id => $td_social_name) {
            if (!empty($atts[$td_social_id])) {

                $social_network_meta = $this->get_social_network_meta($td_social_id, $atts[$td_social_id], $td_social_api);
                //print_r($social_network_meta);
                $buffy .= '<div class="td_social_type">';
                $buffy .= td_social_icons::get_icon($social_network_meta['url'], $td_social_id, $icon_style, $icon_size, $open_in_new_window);
                $buffy .= '<span class="td_social_info">' . number_format($social_network_meta['api']) . '</span>';
                $buffy .= '<span class="td_social_info">' . $social_network_meta['text'] . '</span>';
                $buffy .= '<span class="td_social_button"><a rel="nofollow" href="' . $social_network_meta['url'] . '"' . $td_target . '>' .
                    $social_network_meta['button'] . '</a></span>';
                $buffy .= '</div>';
            }
        }


        $buffy .= '</div> <!-- ./block -->';


        if ($header_color != '') {
            $buffy .= '<style>';
            $buffy .= '#' . $this->block_uid . ' .td_social_button a { ';
            $buffy .= 'background-color:' . $header_color;
            $buffy .= '}';
            $buffy .= '</style>';
        }
        // $td_social_api->save_transient();

        return $buffy;
    }


    //used only on render
    function get_social_network_meta($service_id, $user_id, &$td_social_api) {
        switch ($service_id) {
            case 'facebook':
                return array(
                    'button' => __td('Like'),
                    'url' => "https://www.facebook.com/$user_id",
                    'text' => __td('Fans'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id),
                );
                break;
            case 'twitter':
                return array(
                    'button' => __td('Follow'),
                    'url' => "https://twitter.com/$user_id",
                    'text' => __td('Followers'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id),
                );
                break;

            case 'vimeo':
                return array(
                    'button' => __td('Like'),
                    'url' => "http://vimeo.com/$user_id",
                    'text' => __td('Likes'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id),
                );
                break;

            case 'youtube':
                return array(
                    'button' => __td('Subscribe'),
                    'url' => (strpos('channel/', $user_id) >= 0) ? "http://www.youtube.com/$user_id" : "http://www.youtube.com/user/$user_id",
                    'text' => __td('Subscribers'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id),
                );
                break;

            case 'googleplus':
                return array(
                    'button' => __td('+1'),
                    'url' => "https://plus.google.com/$user_id",
                    'text' => __td('Subscribers'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id),
                );
                break;

            case 'instagram':
                return array(
                    'button' => __td('Follow'),
                    'url' => "http://instagram.com/$user_id#",
                    'text' => __td('Followers'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id),
                );
                break;

            case 'soundcloud':
                return array(
                    'button' => __td('Follow'),
                    'url' => "https://soundcloud.com/$user_id",
                    'text' => __td('Followers'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id),
                );
                break;

            case 'rss':
                return array(
                    'button' => __td('Follow'),
                    'url' => get_bloginfo('rss2_url'),
                    'text' => __td('Followers'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id),
                );
                break;
        }
    }

    function get_map () {
        return array(
            "name" => __("Social counter", TD_THEME_NAME),
            "base" => "td_social_counter",
            "class" => "td_social_counter",
            "controls" => "full",
            "category" => __('Blocks', TD_THEME_NAME),
            'icon' => 'icon-pagebuilder-td_social_counter',
            "params" => array(
                array(
                    "param_name" => "facebook",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Facebook id:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "twitter",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Twitter id:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "youtube",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Youtube id:", TD_THEME_NAME),
                    "description" => "User: www.youtube.com/user/<b style='color: #000'>ENVATO</b><br/>Channel: www.youtube.com/<b style='color: #000'>channel/UCJr72fY4cTaNZv7WPbvjaSw</b>",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "vimeo",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Vimeo id:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "googleplus",
                    "type" => "textfield",
                    "value" =>'',
                    "heading" =>  __("Google Plus User:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "instagram",
                    "type" => "textfield",
                    "value" =>'',
                    "heading" =>  __("Instagram User:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "soundcloud",
                    "type" => "textfield",
                    "value" =>'',
                    "heading" =>  __("Soundcloud User:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "rss",
                    "type" => "textfield",
                    "value" =>'',
                    "heading" =>  __("Feed subscriber count:", TD_THEME_NAME),
                    "description" => "Write the number of followers",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "open_in_new_window",
                    "type" => "dropdown",
                    "value" => array('- Same window -' => '', 'New window' => 'y'),
                    "heading" => __("Open in:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Header color", TD_THEME_NAME),
                    "param_name" => "header_color",
                    "value" => '', //Default Red color
                    "description" => __("Choose a custom header color for this block", TD_THEME_NAME)
                ),
                array(
                    "param_name" => "custom_title",
                    "type" => "textfield",
                    "value" => "",
                    "heading" => __("Optional - custom title for this block:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    "param_name" => "hide_title",
                    "type" => "dropdown",
                    "value" => array('- Show title -' => '', 'Hide title' => 'hide_title'),
                    "heading" => __("Hide block title:", TD_THEME_NAME),
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                )
            )
        );
    }

}


td_global_blocks::add_instance('td_social_counter', new td_social_counter());

//register our widget
class td_social_counter_widget extends td_block_widget {
    var $td_block_id = 'td_social_counter'; // change only the block id, the rest is autogenerated
}

add_action('widgets_init', create_function('', 'return register_widget("td_social_counter_widget");'));
