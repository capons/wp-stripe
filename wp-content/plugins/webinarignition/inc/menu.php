<?php

// SETTING UP THE PLUGIN MENU...

add_action('admin_menu', 'webinarignition_admin_menu');

function webinarignition_admin_menu() {
    $pluginName = "webinarignition";
    add_menu_page($pluginName, 'Webinar Ignition', 'manage_options', $pluginName . '-dashboard', $pluginName . '_dashboard', WEBINARIGNITION_URL . 'images/icon22.png');
}
