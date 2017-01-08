<?php

if (!isset($campaignID))
{
   require_once('schedule_notifications.php');
}
else
{
   // Get ALL Leads
   global $wpdb;
   $table_db_name = $wpdb->prefix . "webinarignition_leads_evergreen";
   $query = "SELECT * FROM $table_db_name WHERE app_id = '$campaignID'";
   $results = $wpdb->get_results($query, OBJECT);

   // Loop Through Leads
   foreach ($results as $result) {
       // LOOP START ##################
       // GET DATE -------------------
       // Get Date
       // Set Timezone:
       date_default_timezone_set($result->lead_timezone);

       $date_and_time = date('Y-m-d H:i');
       $date_only = date('Y-m-d');
       $time_only = date('H:i');
       $time_only_e = explode(":", $time_only);

       $time = strtotime($time_only);
       $startTime = date("H:i", strtotime('-30 minutes', $time));
       $endTime = date("H:i", strtotime('+30 minutes', $time));

       $time_buffer = $time_only_e[1] - 10;
       $time_buffer2 = $time_only_e[1] + 10;
       $date_and_time_buffer_negative = $date_only . " " . $startTime;
       $date_and_time_buffer_plus = $date_only . " " . $endTime;
       // ####################
       // Check If Lead is Complete - Ignore
       if ($result->lead_status == "complete") {
           // IGNORE - done sequence
       } else {
           // ####################################
           //
           // Check 1 Day After
           //
           // ####################################
           if ($result->date_1_day_after_check != "sent" && ($time - strtotime($result->date_1_day_after) >= 0)) {
               // Send Out Email
               // echo "<br><br><b>EMAIL :: 1 DAY AFTER :: ". $result->email ."</b>";
               WI_Logs::add(prettifyNotificationTitle(5) . " ({$result->date_1_day_after}) triggered for {$result->name} ({$result->email}) - chosen starting date: {$result->date_picked_and_live}", $campaignID, WI_Logs::AUTO_EMAIL);
               if(we_cron_email($campaignID, $result->ID, 5, $result->name, $result->email, $result->date_picked_and_live, $result->lead_timezone)) {
                   // Update In DB
                   $wpdb->update($table_db_name, array(
                       'date_1_day_after_check' => 'sent',
                       'date_after_live_check' => 'sent',
                       'date_picked_and_live_check' => 'sent',
                       'date_1_day_before_check' => 'sent',
                       'date_1_hour_before_check' => 'sent',
                       'lead_status' => 'complete'
                   ), array('id' => $result->ID));
               }
               continue;
           }

           // ####################################
           //
           // Check After Live Is Over
           //
           // ####################################
           if ($result->date_after_live_check != "sent" && ($time - strtotime($result->date_after_live) >= 0)) {
               // Send Out Email
               // echo "<br><br><b>EMAIL :: 1 HOUR AFTER :: ". $result->email ."</b>";
               WI_Logs::add(prettifyNotificationTitle(4) . " ({$result->date_after_live}) triggered for {$result->name} ({$result->email}) - chosen starting date: {$result->date_picked_and_live}", $campaignID, WI_Logs::AUTO_EMAIL);
               if(we_cron_email($campaignID, $result->ID, 4, $result->name, $result->email, $result->date_picked_and_live, $result->lead_timezone)) {
                   // Update In DB
                   $wpdb->update($table_db_name, array(
                       'date_after_live_check' => 'sent',
                       'date_picked_and_live_check' => 'sent',
                       'date_1_day_before_check' => 'sent',
                       'date_1_hour_before_check' => 'sent'
                   ), array('id' => $result->ID));
               }
               continue;
           }

           // ####################################
           //
           // Check LIVE Webinar
           //
           // ####################################
           if ($result->date_picked_and_live_check != "sent" && ($time - strtotime($result->date_picked_and_live) >= 0)) {
               // Send Out Email
               // echo "<br><br><b>EMAIL :: EVENT LIVE :: ". $result->email ."</b>";
               WI_Logs::add(prettifyNotificationTitle(3) . " ({$result->date_picked_and_live}) triggered for {$result->name} ({$result->email}) - chosen starting date: {$result->date_picked_and_live}", $campaignID, WI_Logs::AUTO_EMAIL);
               if(we_cron_email($campaignID, $result->ID, 3, $result->name, $result->email, $result->date_picked_and_live, $result->lead_timezone)) {
                   // Update In DB
                   $wpdb->update($table_db_name, array(
                       'date_picked_and_live_check' => 'sent',
                       'date_1_day_before_check' => 'sent',
                       'date_1_hour_before_check' => 'sent'
                   ), array('id' => $result->ID));
               }
               continue;
           }

           // ####################################
           //
           // Check 1 Hour Before
           //
           // ####################################
           if ($result->date_1_hour_before_check != "sent" && ($time - strtotime($result->date_1_hour_before) >= 0)) {
               // Send Out Email
               // echo "<br><br><b>EMAIL :: 1 HOUR BEFORE :: ". $result->email ."</b>";
               WI_Logs::add(prettifyNotificationTitle(2) . " ({$result->date_1_hour_before}) triggered for {$result->name} ({$result->email}) - chosen starting date: {$result->date_picked_and_live}", $campaignID, WI_Logs::AUTO_EMAIL);
               if(we_cron_email($campaignID, $result->ID, 2, $result->name, $result->email, $result->date_picked_and_live, $result->lead_timezone)) {
                   // Update In DB
                   $wpdb->update($table_db_name, array('date_1_hour_before_check' => 'sent', 'date_1_day_before_check' => 'sent'), array('id' => $result->ID));
               }
               if($result->phone) {
                   WI_Logs::add("TXT notification ({$result->date_1_hour_before}) triggered for {$result->name} ({$result->phone}) - chosen starting date: {$result->date_picked_and_live}", $campaignID, WI_Logs::AUTO_SMS);
                   wi_send_txt_auto($campaignID, $result->phone, $result->ID);
               }
               continue;
           }

           // start if loop
           // ####################################
           //
           // Check 1 Day Before
           //
           // ####################################

           if ($result->date_1_day_before_check != "sent" && ($time - strtotime($result->date_1_day_before) >= 0)) {
               // Send Out Email
               // echo "<br><br><b>EMAIL :: 1 DAY BEFORE :: ". $result->email ."</b>";
               WI_Logs::add(prettifyNotificationTitle(1) . " ({$result->date_1_day_before}) triggered for {$result->name} ({$result->email}) - chosen starting date: {$result->date_picked_and_live}", $campaignID, WI_Logs::AUTO_EMAIL);
               if(we_cron_email($campaignID, $result->ID, 1, $result->name, $result->email, $result->date_picked_and_live, $result->lead_timezone)) {
                   // Update In DB
                   $wpdb->update($table_db_name, array('date_1_day_before_check' => 'sent'), array('id' => $result->ID));
               }
               continue;
           }
           // end if loop
       }
   }
}
