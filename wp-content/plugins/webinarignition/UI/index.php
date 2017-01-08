<?php

// func :: dbug
// --------------------------------------------------------------------------------------
   function dbug()
   {
      $cvs = phpversion();                                  // current version string
      $rvs = '5.4.9';                                       // required version string

      if ( version_compare( $cvs, $rvs, '<' )) {
         echo '<br>
               <div class="error" style="display:inline-block; padding:12px; margin-left:2px; margin-top:20px">
                  <b>WARNING !!</b><br>
                  This plugin requires at least PHP version: '.$rvs.' but this server is on an older PHP version: '.$cvs.'<br><br>
                  It is <b>strongly</b> recommended that you contact your hosting provider to upgrade your PHP installation to the required version or better.<br>
                  If you ignore this, your software will throw errors or cause unwanted problems.
               </div>';
      }
   }
// --------------------------------------------------------------------------------------


function webinarignition_dashboard()
{
// fix :: notice on outdated PHP version
// --------------------------------------------------------------------------------------
   dbug();
// --------------------------------------------------------------------------------------

// Universal Variables

    $sitePath = WEBINARIGNITION_URL;
    ?>

    <!-- LOAD CSS -->
    <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600' rel='stylesheet' type='text/css'>

    <link href="<?php echo WEBINARIGNITION_URL; ?>css/bootstrap-2.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo WEBINARIGNITION_URL; ?>css/table.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo WEBINARIGNITION_URL; ?>css/datepicker.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo WEBINARIGNITION_URL; ?>css/timepicker.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo WEBINARIGNITION_URL; ?>css/colorpicker.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo $sitePath; ?>css/classic.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $sitePath; ?>css/classic.date.css" rel="stylesheet" type="text/css"/>

<!--  fix :: utils  -->
    <script type="text/javascript" src="<?php echo $sitePath; ?>inc/lp/js/utils.js"></script>
    <link href="<?php echo $sitePath; ?>inc/lp/css/utils.css" rel="stylesheet" type="text/css"/>
<!--  ============  -->

    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo WEBINARIGNITION_URL; ?>css/style.css" rel="stylesheet" type="text/css"/>
    <?php include("css.php"); ?>

    <!-- UI FRAMEWORK -->

    <?php include("ui-core.php"); ?>
    <?php include("ui-com2.php"); ?>

    <!-- JAVASCRIPT -->

    <script type="text/javascript" src="<?php echo $sitePath; ?>inc/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $sitePath; ?>inc/js/colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo $sitePath; ?>inc/js/colorconversion.js"></script>
    <script type="text/javascript" src="<?php echo $sitePath; ?>inc/js/picker.js"></script>
    <script type="text/javascript" src="<?php echo $sitePath; ?>inc/js/picker.date.js"></script>
    <script type="text/javascript" src="<?php echo $sitePath; ?>inc/js/picker.time.js"></script>
    <script type="text/javascript" src="<?php echo $sitePath; ?>inc/js/legacy.js"></script>
    <script type="text/javascript" src="<?php echo $sitePath; ?>inc/js/tz.js"></script>


    <script src="<?php echo $sitePath; ?>inc/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBINARIGNITION_URL; ?>inc/js/ar_integration.js"></script>
    <script type="text/javascript" src="<?php echo WEBINARIGNITION_URL; ?>inc/js/jquery.are-you-sure.js"></script>


    <?php include("js-core.php"); ?>
    <?php include("ie.php"); ?>

<?php
// Acitvation Look Up ::
    global $wpdb;
    $table_db_name = $wpdb->prefix . "webinarignition_wi";
    $statusCheck = $wpdb->get_row("SELECT * FROM $table_db_name WHERE id = '1' ", OBJECT);

    if ($statusCheck->switch == "") {
        // Not Active
        ?>

        <div id="mWrapper">

            <div id="mHeader">

                <div id="mLogo">

                    <div class="mLogoIMG">
                        <a href="<?php echo admin_url('?page=webinarignition-dashboard'); ?>">
                            <img border="0" class="welogo" src="<?php echo WEBINARIGNITION_URL; ?>images/mark-logo.png"
                                 width="284" alt="" border="0">
                        </a>
                    </div>

                    <div class="mSupport">
                        <a href="http://support.digitalkickstart.com/" target="_blank"><i class="icon-question-sign"
                                                                                          style="margin-right: 5px;"></i>
                            Support Area</a>
                    </div>

                    <div class="mSupport">
                        <a href="http://webinarignition.com/members/" target="_blank"><i class="icon-user"
                                                                                         style="margin-right: 5px;"></i>
                            Members Area</a>
                    </div>

                    <br clear="both"/>

                </div>

            </div>

            <div id="container">

                <div class="unlockTitle">
                    <div class="unlockTitle2">Unlock Your Copy WebinarIgnition</div>
                    <div class="unlockTitle3">Simply enter in your members area username and an active key...</div>
                </div>

                <div class="unlockForms">
                    <div class="unlockLabels">
                        <span>WebinarIgnition Username:</span>
                        <span style="margin-left: 200px;">Active Key:</span>
                    </div>

                    <input type="text" placeholder="Enter Your Username..." id="unlockUsername" class="unlockForm">
                    <input type="text" placeholder="Enter An Active Key..." id="unlockKey" class="unlockForm"
                           style="margin-left:15px;">
                    <a href="#" class="unlockBTN" id="unlockBTN" style="margin-left:15px;">Activate Plugin</a>
                </div>

                <div class="unlockSmall">
                    * Inside of the WebinarIgnition members area, you can get access to your license keys... *
                </div>

            </div>

        </div>

    <?php
    } else {
        ?>

        <div id="mWrapper">

            <div id="mHeader">

                <div id="mLogo">

                    <div class="mLogoIMG">
                        <a href="<?php echo admin_url('?page=webinarignition-dashboard'); ?>">
                            <img border="0" class="welogo" src="<?php echo WEBINARIGNITION_URL; ?>images/mark-logo.png"
                                 width="284" alt="" border="0">
                        </a>
                    </div>

                    <div class="mSupport">
                        <a href="http://support.digitalkickstart.com/" target="_blank"><i class="icon-question-sign"
                                                                                          style="margin-right: 5px;"></i>
                            Support Area</a>
                    </div>

                    <div class="mSupport">
                        <a href="http://webinarignition.com/members/" target="_blank"><i class="icon-user"
                                                                                         style="margin-right: 5px;"></i>
                            Members Area</a>
                    </div>

                    <br clear="both"/>

                </div>

            </div>

            <div id="container">

                <?php
                // Edit App

                if (isset($_GET['id'])) {
                    include("editapp.php");
                } // Create New App
                else if (isset($_GET['create'])) {
                    include("create.php");
                } // Create New AUTO
                else if (isset($_GET['create-auto'])) {
                    include("createauto.php");
                } // Support
                else if (isset($_GET['support'])) {
                    include("support.php");
                } // Show Dashboard ::
                else {
                    include("dash.php");
                }
                ?>

            </div>


        </div>


    <?php
    }
?>
    <script type="text/javascript" src="<?php echo WEBINARIGNITION_URL; ?>inc/js/nav_prompt.js"></script>

<?php
// END
}
