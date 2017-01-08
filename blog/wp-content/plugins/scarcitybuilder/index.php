<?php

/*
    Plugin Name: Scarcity Builder
    Description: Conversion-Boosting Countdown Timers for WordPress
    Version: 2.2.13
    Author: Mark Thompson - Digital Kickstart
    Plugin URI: http://scarcitybuilder.com/
     Author URI: http://digitalkickstart.com/
*/

function scarcitybuilderx_wpadmin()
{
    add_menu_page( 'Scarcity Builder', 'Scarcity Builder', 'manage_options', 'scarcitybuilderx',
        'adminpage_for_scarcitybuilderx', plugins_url() . '/scarcitybuilder/include/favicon.png' );
}

add_action( 'admin_menu', 'scarcitybuilderx_wpadmin' );

register_activation_hook( __FILE__, 'activate_scarcitybuilderx' );

function activate_scarcitybuilderx()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "scarcitybuilderx";

    if ($wpdb->get_var( "show tables like '$table_name'" ) != $table_name) {

        $sql = "CREATE TABLE " . $table_name . " (
			    id INTEGER(40) UNSIGNED AUTO_INCREMENT,
			    name varchar(500),
			    color varchar(500),
			    font varchar(500),
			    size varchar(500),
			    day varchar(500),
			    hour varchar(500),
			    minutes varchar(500),
			    date varchar(500),
			    timezone varchar(500),
			    expiryaction varchar(500),
			    expiredtext LONG,
			    redirecturl varchar(500),
			    time varchar(500),
			    type varchar(500),
			    cookie varchar(500),
			    UNIQUE KEY id (id)
			 );";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}

function scarcitybuilderx_addPlayer(
    $name,
    $color,
    $font,
    $size,
    $day,
    $hour,
    $minutes,
    $date,
    $timezone,
    $expiryaction,
    $expiredtext,
    $redirecturl,
    $type,
    $cookie,
    $time
) {
    global $wpdb;
    $table_db_name = $wpdb->prefix . "scarcitybuilderx";
    $wpdb->insert( $table_db_name,
        array(
            'name'         => $name,
            'color'        => $color,
            'font'         => $font,
            'size'         => $size,
            'day'          => $day,
            'hour'         => $hour,
            'minutes'      => $minutes,
            'date'         => $date,
            'timezone'     => $timezone,
            'expiryaction' => $expiryaction,
            'expiredtext'  => $expiredtext,
            'redirecturl'  => $redirecturl,
            'type'         => $type,
            'cookie'       => $cookie,
            'time'         => $time
        )
    );
}

function scarcitybuilderx_updatePlayer(
    $name,
    $color,
    $font,
    $size,
    $day,
    $hour,
    $minutes,
    $date,
    $timezone,
    $expiryaction,
    $expiredtext,
    $redirecturl,
    $type,
    $cookie,
    $time,
    $id
) {
    global $wpdb;
    $table_db_name = $wpdb->prefix . "scarcitybuilderx";
    $wpdb->update( $table_db_name, array(
        'name'         => $name,
        'color'        => $color,
        'font'         => $font,
        'size'         => $size,
        'day'          => $day,
        'hour'         => $hour,
        'minutes'      => $minutes,
        'date'         => $date,
        'timezone'     => $timezone,
        'expiryaction' => $expiryaction,
        'expiredtext'  => $expiredtext,
        'redirecturl'  => $redirecturl,
        'type'         => $type,
        'cookie'       => $cookie,
        'time'         => $time
    ), array( 'id' => $id ) );
}

function scarcitybuilderx_deletePlayer( $id )
{
    global $wpdb;
    $table_db_name = $wpdb->prefix . "scarcitybuilderx";
    $wpdb->query( $wpdb->prepare( "DELETE FROM $table_db_name WHERE ID = $id", $id ) );
}

include( 'include/admin.php' );

function scarcitybuilderx( $atts, $content = null )
{
    extract( shortcode_atts( array(
        "id" => '#'
    ), $atts ) );

    global $post;
    global $wpdb;
    $getPage   = $wpdb->prefix . "scarcitybuilderx";
    $templates = $wpdb->get_results( "SELECT * FROM $getPage", ARRAY_A );

    $tpl = get_post_meta( $post->ID, '_template', true );

    foreach ($templates as $template) {


    }

    return "<script>
function resizeIframe(obj) {
obj.style.height = obj.contentWindow.document.getElementById('until2d').scrollHeight  + 'px' ;
}
</script>
<iframe scrolling='no' ALLOWTRANSPARENCY='true' id='the_iframe_" . $atts['id'] . "' name='the_iframe_" . $atts['id'] . "'  frameborder='0' style='width: 100%; height: 80px;  margin: 5px auto; display: block;  position: relative' class='scarcitybuilder' src='" . plugin_dir_url( __FILE__ ) . "shortcode/index.php?edit=" . $atts['id'] . "' onload='javascript:resizeIframe(this);'></iframe>";


}

add_shortcode( "scarcitybuilderx", "scarcitybuilderx" );


require_once( 'wp-updates-plugin.php' );
new WPUpdatesPluginUpdater_398( 'http://wp-updates.com/api/2/plugin', plugin_basename( __FILE__ ) );
