<?php

// set :: force no time limit settings
// --------------------------------------------------------------------------------------
ini_set('display_errors', 1); 
error_reporting(E_ALL);

   ignore_user_abort();
   set_time_limit(100);
// --------------------------------------------------------------------------------------



// fnc :: mail - for email related tasks
// --------------------------------------------------------------------------------------
   $mail = function()
   {
   // dpn :: utility dependencies
   // -----------------------------------------------------------------------------------
      define('WP_USE_THEMES', false);
      require('../../../../wp-blog-header.php');
      status_header(200);
      require_once 'PHPMailerAutoload.php';
      require 'Services/Twilio.php';
      require 'schedule_email_live_fn.php';                    // live & auto functions
   // -----------------------------------------------------------------------------------


   // def :: define local vars
   // -----------------------------------------------------------------------------------
      $rpl = ['new'=>'live'];                                  // replace string values
      $qry = 'select id, camtype from '. $wpdb->prefix .'webinarignition';     // query string
      $lst = $wpdb->get_results($qry);                         // job list
      $cmp = null;                                             // campaign
   // -----------------------------------------------------------------------------------


   // itr :: iterate through `$lst` to get `$cmp`
   // -----------------------------------------------------------------------------------
      foreach ($lst as $cmp)
      {
      // fix :: replace type names
      // --------------------------------------------------------------------------------
         if (is_numeric($cmp->camtype) || $cmp->camtype == 'import')
         {
            $sil = get_option('webinarignition_campaign_'.$cmp->id);
            $cmp->camtype = 'live';
            if($sil->webinar_date == 'AUTO') {
               $cmp->camtype = 'auto';
            }
         }

         $cmp->camtype = (isset($rpl[$cmp->camtype]) ? $rpl[$cmp->camtype] : $cmp->camtype);
      // --------------------------------------------------------------------------------

      // def :: loop vars
      // --------------------------------------------------------------------------------
         $fnBaseName = "schedule_email_{$cmp->camtype}.php";
         $campaignID = $cmp->id;
      // --------------------------------------------------------------------------------

      // run :: require campaign associated file inside separate scope
      // --------------------------------------------------------------------------------
         call_user_func_array
         (
            function($campaignID,$fnBaseName)
            {
               if (file_exists($fnBaseName))
               { require($fnBaseName); }
            },

            [$campaignID, $fnBaseName]
         );
            
      // --------------------------------------------------------------------------------
      }
   // -----------------------------------------------------------------------------------
   };
// --------------------------------------------------------------------------------------



// run :: function based on string option
// --------------------------------------------------------------------------------------
   ${'mail'}();
// --------------------------------------------------------------------------------------

?>
