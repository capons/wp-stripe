<div class="tabber" id="tab1">

<div class="titleBar">

    <div class="titleBarIcon">
        <!-- <i class="icon-dashboard icon-4x"></i> -->
    </div>

    <div class="titleBarText">
        <h2>Dashboard - Your Webinar Settings</h2>

        <p>Here you can check out the overall stats for your webinar funnel and leads...</p>
    </div>

    <div class="launchConsole">
        <a href="<?php
        $console_link = wi_fixPerma($data->postID);
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
            $console_link = str_replace('http://', 'https://', $console_link);
        }
        echo $console_link;
        ?>console" target="_blank"><i
                class="icon-external-link-sign"></i> Show Live Console</a>
    </div>

    <br clear="all"/>
</div>

<!-- NEW AREA TOP -->

<div class="weDashLeft">

<?php
// Evergreen Check
if ($results->webinar_date == "AUTO") {
    // Evergreen
} else {
    ?>

    <div class="weDashWebinarTitle">

        <div class="dashWebinarTitleIcon"><i class="icon-share-sign icon-3x"></i></div>

        <div class="dashWebinarTitleCopy">
            <h2 style="color:#FFF !important;">Your Webinar Event URL</h2>

            <p>This is the URL for your live webinar...</p>
        </div>

        <br clear="left"/>

    </div>

    <div class="weDashWebinarInner">

        <div class="webinarURLArea">
            <input type="text" class="inputField inputFieldDash"
                   value="<?php echo wi_fixPerma($data->postID); ?>live"/>
        </div>perma

        <div class="webinarURLAreaStatus">

            <div class="webinarURLAreaStatusTitle">
                Webinar Master Switch:
                <span class="wmsTitle">Toggle the event / webinar status</span>
            </div>

            <ul class="webinarStatusGroup">
                <li><a href="#" class="webinarStatus webinarStatusFirst <?php
                    if ($results->webinar_switch == "countdown" || $results->webinar_switch == "") {
                        echo "webinarStatusSelected";
                    }
                    ?>" data="countdown"><i class="icon-time"></i> Countdown</a></li>
                <li><a href="#" class="webinarStatus <?php
                    if ($results->webinar_switch == "live") {
                        echo "webinarStatusSelected";
                    }
                    ?>" data="live"><i class="icon-microphone"></i> Live</a></li>
                <li><a href="#" class="webinarStatus <?php
                    if ($results->webinar_switch == "replay") {
                        echo "webinarStatusSelected";
                    }
                    ?>" data="replay"><i class="icon-refresh"></i> Replay</a></li>
                <li><a href="#" class="webinarStatus webinarStatusEnd <?php
                    if ($results->webinar_switch == "closed") {
                        echo "webinarStatusSelected";
                    }
                    ?>" data="closed"><i class="icon-lock"></i> Closed</a></li>
                <input type="hidden" name="webinar_switch" id="webinar_switch"
                       value="<?php echo $results->webinar_switch; ?>">
                <br clear="left"/>
            </ul>

        </div>
        <div style="border-top: 1px dotted #e2e2e2; padding-top: 15px; margin-top: 25px; ">
            <span style="font-size:16px; font-weight:bold; display:block;">1 Click Registation URL:</span>
            <span>replace NAME with their name & replace EMAIL with their email...</span>
            <input style="margin-top:15px;" onclick="this.select()" type="text" class="inputField inputFieldDash"
                   value="<?php echo wi_fixPerma($data->postID); ?>register-now&n=NAME&e=EMAIL"/>
        </div>

    </div>
<?php
}
?>

<div class="statsLabelx" style="text-align:right; padding-top:15px;">
    Total Views / <b>Unique Views</b>
</div>

<div class="webinarPreviewItem webinarPreviewItemTop" style="<?php
if ($results->webinar_date == "AUTO") {
    echo "margin-top:0px;";
}
?>">
    <?php
    // Get Total & Uniques
    $getTotal_lp = $data->total_lp;
    $getTotal_lp = explode("%%", $getTotal_lp);
    ?>
    <div class="webinarPreviewIcon"><i class="icon-file icon-2x"></i></div>
    <div class="webinarPreviewTitle"><a href="<?php echo get_permalink($data->postID); ?>" target="_blank"><i
                class="icon-external-link"></i> View Registration Page</a></div>
    <!-- <div class="webinarPreviewStat"><span class="dashViews" >Total: </span> <?php
    if ($getTotal_lp[1] == "") {
        echo "0";
    } else {
        echo $getTotal_lp[1];
    }
    ?> <span class="dashViews" >Uniques:</span> <?php
    if ($getTotal_lp[0] == "") {
        echo "0";
    } else {
        echo $getTotal_lp[0];
    }
    ?> </div> -->
    <div class="webinarPreviewStat"><span style="font-weight: normal;"><?php
            if ($getTotal_lp[1] == "") {
                echo "0";
            } else {
                echo $getTotal_lp[1];
            }
            ?> / </span> <?php
        if ($getTotal_lp[0] == "") {
            echo "0";
        } else {
            echo $getTotal_lp[0];
        }
        ?> </div>
    <br clear="both"/>
</div>

<div class="webinarPreviewItem">
    <?php
 // Get Total & Uniques

    $getTotal_ty = $data->total_ty;
    $getTotal_ty = explode("%%", $getTotal_ty);
    ?>
    <div class="webinarPreviewIcon"><i class="icon-copy icon-2x"></i></div>
    <?php if ($results->webinar_date == "AUTO") { ?>
        <div class="webinarPreviewTitle"><a href="<?php echo wi_fixPerma($data->postID); ?>preview_auto_thankyou"
                                            target="_blank"><i class="icon-external-link"></i> View Thank You Page</a>
        </div>
    <?php } else { ?>
        <div class="webinarPreviewTitle"><a href="<?php echo wi_fixPerma($data->postID); ?>confirmed"
                                            target="_blank"><i class="icon-external-link"></i> View Thank You Page</a>
        </div>
    <?php } ?>
    <!-- <div class="webinarPreviewStat"><span class="dashViews" >Total: </span> <?php
    if ($getTotal_ty[1] == "") {
        echo "0";
    } else {
        echo $getTotal_ty[1];
    }
    ?> <span class="dashViews" >Uniques:</span> <?php
    if ($getTotal_ty[0] == "") {
        echo "0";
    } else {
        echo $getTotal_ty[0];
    }
    ?> </div> -->
    <div class="webinarPreviewStat"><span style="font-weight: normal;"><?php
            if ($getTotal_ty[1] == "") {
                echo "0";
            } else {
                echo $getTotal_ty[1];
            }
            ?> / </span> <?php
        if ($getTotal_ty[0] == "") {
            echo "0";
        } else {
            echo $getTotal_ty[0];
        }
        ?> </div>
    <br clear="both"/>
</div>



<?php
if ($results->webinar_date == "AUTO") {
    // Evergreen
} else {
    ?>

    <div class="webinarPreviewItem">
        <div class="webinarPreviewIcon"><i class="icon-time icon-2x"></i></div>
        <div class="webinarPreviewTitle"><a href="<?php echo wi_fixPerma($data->postID); ?>preview-countdown"
                                            target="_blank"><i class="icon-external-link"></i> Preview Countdown
                Page</a></div>
        <!-- <div class="webinarPreviewStat"><?php
        if ($data->total_cd == "") {
            echo "0";
        } else {
            echo $data->total_cd;
        }
        ?></div> -->
        <br clear="both"/>
    </div>

<?php
}
?>

<div class="webinarPreviewItem">
    <?php
    // Get Total & Uniques
    $getTotal_live = $data->total_live;
    $getTotal_live = explode("%%", $getTotal_live);
    ?>
    <div class="webinarPreviewIcon"><i class="icon-microphone icon-2x"></i></div>
    <div class="webinarPreviewTitle"><a href="<?php echo wi_fixPerma($data->postID); ?>preview-webinar"
                                        target="_blank"><i class="icon-external-link"></i> Preview Webinar Page</a>
    </div>
    <!-- <div class="webinarPreviewStat"><span class="dashViews" >Total: </span> <?php
    if ($getTotal_live[1] == "") {
        echo "0";
    } else {
        echo $getTotal_live[1];
    }
    ?> <span class="dashViews" >Uniques:</span> <?php
    if ($getTotal_live[0] == "") {
        echo "0";
    } else {
        echo $getTotal_live[0];
    }
    ?> </div> -->
    <div class="webinarPreviewStat"><span style="font-weight: normal;"><?php
            if ($getTotal_live[1] == "") {
                echo "0";
            } else {
                echo $getTotal_live[1];
            }
            ?> / </span> <?php
        if ($getTotal_live[0] == "") {
            echo "0";
        } else {
            echo $getTotal_live[0];
        }
        ?> </div>
    <br clear="both"/>
</div>

<div class="webinarPreviewItem webinarPreviewItemBottom">
    <?php
    // Get Total & Uniques
    $getTotal_replay = $data->total_replay;
    $getTotal_replay = explode("%%", $getTotal_replay);
    ?>
    <div class="webinarPreviewIcon"><i class="icon-film icon-2x"></i></div>
    <div class="webinarPreviewTitle"><a href="<?php echo wi_fixPerma($data->postID); ?>preview-replay"
                                        target="_blank"><i class="icon-external-link"></i> Preview Replay Page</a></div>
    <!-- <div class="webinarPreviewStat"><span class="dashViews" >Total: </span> <?php
    if ($getTotal_replay[1] == "") {
        echo "0";
    } else {
        echo $getTotal_replay[1];
    }
    ?> <span class="dashViews" >Uniques:</span> <?php
    if ($getTotal_replay[0] == "") {
        echo "0";
    } else {
        echo $getTotal_replay[0];
    }
    ?> </div> -->
    <div class="webinarPreviewStat"><span style="font-weight: normal;"><?php
            if ($getTotal_replay[1] == "") {
                echo "0";
            } else {
                echo $getTotal_replay[1];
            }
            ?> / </span> <?php
        if ($getTotal_replay[0] == "") {
            echo "0";
        } else {
            echo $getTotal_replay[0];
        }
        ?> </div>
    <br clear="both"/>
</div>

<div class="timezoneRef" style="<?php
if ($results->webinar_date == "AUTO") {
    echo "display:none;";
}
?>">
    <div class="timezoneRefTitle"><b>REFERENCE</b> :: Your Local Timezone & Current Time</div>
    <div class="timezoneRefZ"></div>
</div>

<?php if ($results->webinar_date == "AUTO") { ?>

    <div class="timezoneRef">
        <b>Notice:</b> The previews above for Thank You Page, Webinar & Replay are just previews. The change depending
        on the time & date choosen by the lead...
    </div>

<?php } ?>

</div>

<div class="weDashRight">

<div class="weDashDateTitle">
    <!-- <i class="icon-ticket"></i> Webinar Event Info: -->
    <div class="dashWebinarTitleIcon"><i class="icon-ticket icon-3x"></i></div>

    <div class="dashWebinarTitleCopy">
        <h2 style="margin:0px; margin-top: 3px;">Webinar Event Info</h2>

        <p style="margin:0px; margin-top: 3px;">The core settings for your webinar event...</p>
    </div>

    <br clear="left"/>
</div>

<div class="weDashDateInner">

<div class="weDashSection">
                                <span class="weDashSectionTitle">Webinar Title
                                        <span class="weDashSectionIcon"><i class="icon-desktop"></i></span>
                                </span>
    <br clear="right"/>
    <input type="text" class="inputField inputFieldDash elem" name="webinar_desc" id="webinar_desc"
           value="<?php echo $results->webinar_desc; ?>"/>
</div>

<div class="weDashSection">
                                <span class="weDashSectionTitle">Webinar Host(s)
                                        <span class="weDashSectionIcon"><i class="icon-user"></i></span>
                                </span>
    <br clear="right"/>
    <input type="text" class="inputField inputFieldDash elem" name="webinar_host" id="webinar_host"
           value="<?php echo $results->webinar_host; ?>"/>
</div>

<?php
// Evergreen Check
if ($results->webinar_date == "AUTO") {
    // Evergreen
    ?>
    <input type="hidden" class="inputField inputFieldDash elem dp-date" name="webinar_date" id="webinar_date"
           value="<?php echo $results->webinar_date; ?>"/>
<?php
} else {
    ?>

    <div class="weDashSection">
                                        <span class="weDashSectionTitle">Event Date
                                                <span class="weDashSectionIcon"><i class="icon-calendar"></i></span>
                                        </span>
        <br clear="right"/>
        <input type="text" class="inputField inputFieldDash elem dp-date" name="webinar_date" id="webinar_date"
               value="<?php echo $results->webinar_date; ?>"/>
    </div>

    <div class="weDashSection">
                                        <span class="weDashSectionTitle">Event Time
                                                <span class="weDashSectionIcon"><i class="icon-time"></i></span>
                                        </span>
        <br clear="right"/>
        <?php $starttimeTZ = $results->webinar_start_time; ?>
        <input type="text" class="inputField inputFieldDash elem dp-time" name="webinar_start_time"
               id="webinar_start_time"
               value="<?php echo $results->webinar_start_time; ?>"/>
    </div>

    <div class="weDashSection">
                                        <span class="weDashSectionTitle">Event Timezone
                                                <span class="weDashSectionIcon"><i class="icon-globe"></i></span>
                                        </span>
                                        <br clear="right"/>
                                        <?php
                                        $webinarTZ = wi_convert_utc_to_tzid($results->webinar_timezone);
                                        create_tz_select_list($webinarTZ);
                                        ?>

                                        <!-- <input type="text" class="inputField inputFieldDash elem" name="webinar_timezone" id="webinar_timezone" value="<?php echo $results->webinar_timezone; ?>" /> -->
    </div>

    <!-- NEW SHORTCODE -->
    <div class="weDashSection">
        <span class="weDashSectionTitle">Shortcode Sign Up Widget
                <span class="weDashSectionIcon"><i class="icon-code"></i></span>
        </span>
        <br clear="right">
        <input type="text" class="inputField inputFieldDash elem" value="[wi_webinar id='<?php echo $ID; ?>']">
    </div>

<?php
}
?>

</div>


</div>

<br clear="left"/>

<!-- NEW AREA END -->


<div style="">
    <!--
                                <div class="statsDashbord" style="display:none;" >

                                                <div class="statsDashBlock">
                                                                <div class="statsDashBlockNumber"><?php
    if ($data->total_lp == "") {
        echo "0";
    } else {
        echo $data->total_lp;
    }
    ?></div>
                                                                <div class="statsDashBlockTag">landing page</div>
                                                </div>

                                                <div class="statsDashBlock">
                                                                <div class="statsDashBlockNumber"><?php
    if ($data->total_ty == "") {
        echo "0";
    } else {
        echo $data->total_ty;
    }
    ?></div>
                                                                <div class="statsDashBlockTag">thank you page</div>
                                                </div>

                                                <div class="statsDashBlock">
                                                                <div class="statsDashBlockNumber"><?php
    if ($data->total_live == "") {
        echo "0";
    } else {
        echo $data->total_live;
    }
    ?></div>
                                                                <div class="statsDashBlockTag">live webinar</div>
                                                </div>

                                                <div class="statsDashBlock">
                                                                <div class="statsDashBlockNumber"><?php
    if ($data->total_replay == "") {
        echo "0";
    } else {
        echo $data->total_replay;
    }
    ?></div>
                                                                <div class="statsDashBlockTag">webinar replay</div>
                                                </div>

                                                <br clear="left" />

                                </div>

                                <br clear="left" /> -->

    <div class="editableSectionHeading2" style="display:none;">

        <?php
        // Display Leads For This App

        $getVersion = "webinarignition_leads";
        $table_db_name = $wpdb->prefix . $getVersion;

        $ID = $_GET['id'];

        $leads = $wpdb->get_results("SELECT * FROM $table_db_name WHERE app_id = '$ID' ", OBJECT);
        $leads2 = $wpdb->get_results("SELECT * FROM $table_db_name WHERE app_id = '$ID' ", ARRAY_A);

        $totalLeads = count($leads2);
        ?>

        <div class="editableSectionTitle">
            <i class="icon-user"></i>
            Manage Your Leads ( Total Leads: <?php echo $totalLeads; ?> )
        </div>

        <div class="editableSectionToggle">
            <!-- <i class="toggleIcon  icon-chevron-down "></i> -->
        </div>

        <br clear="all"/>

    </div>

    <div class="leads" style="clear: both; display:none;">
        <table id="leads" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><i class="icon-user" style="margin-right: 5px;"></i>Full Name</th>
                    <th><i class="icon-envelope-alt" style="margin-right: 5px;"></i>Email Address</th>
                    <th><i class="icon-mobile-phone" style="margin-right: 5px;"></i>Phone</th>
                    <th><i class="icon-calendar" style="margin-right: 5px;"></i>Sign Up Date</th>
                    <th width="70"><i class="icon-trash" style="margin-right: 5px;"></i> Delete</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($leads as $leads) {
                    ?>
                    <tr id="table_lead_<?php echo $leads->ID; ?>">
                        <td><?php echo $leads->name; ?></td>
                        <td><?php echo $leads->email; ?></td>
                        <td><?php echo $leads->phone; ?></td>
                        <td><?php echo $leads->created; ?></td>
                        <td>
                            <center><i class="icon-remove delete_lead" lead_id="<?php echo $leads->ID; ?>"></i></center>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>

</div>

<br clear="all"/>

<div style="border-top: 1px dotted #e2e2e2; padding-top: 15px; margin-top: 25px; ">
    <span style="float: right;" id="deleteCampaign"
          data-nonce="<?php echo wp_create_nonce('wi_delete_campaign_' . $_GET['id']); ?>" class="grey-btn"><i
            class="icon-trash" style="margin-right: 5px;"></i> Delete This Campaign</span>
    <span style="float: left;" id="exportCampaign" class="grey-btn"><a
            href="#TB_inline?width=637&height=550&inlineId=export-campaign" class="thickbox"><i class="icon-magic"
                                                                                                style="margin-right: 5px;"></i>
            Export Campaign</a></span>
    <span style="float: right; margin-right: 15px;" id="resetStats2" class="grey-btn"><i class="icon-bar-chart"
                                                                                         style="margin-right: 5px;"></i> <a
            href="#" id="resetStats">Reset View Stats</a></span>
    <br clear="right"/>
</div>

<!-- Export Modal -->
<?php add_thickbox(); ?>
<div id="export-campaign" style="display:none;">
    <p style="font-weight: bold; font-size: 18px;">Export Campaign Code:</p>

    <p style="margin-top:-25px;">copy this code & paste into the import campaign on the create Webinar Page...</p>
    <textarea onclick="this.select()"
              style="width:100%; height:250px;"><?php echo base64_encode(serialize($results)); ?></textarea>
</div>


</div>
