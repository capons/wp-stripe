<?php error_reporting( 0 ); ?>
<!-- ON AIR AREA -->
<div id="leadTab" style="display:none;" class="consoleTabs">

<div class="statsDashbord">

    <div class="statsTitle statsTitle-Lead">

        <div class="statsTitleIcon">
            <i class="icon-group icon-2x"></i>
        </div>

        <div class="statsTitleCopy">
            <h2>Manage Registrants For Webinar</h2>

            <p>All your Registrants / Leads for the event...</p>
        </div>

        <br clear="left"/>

    </div>

</div>

<div class="innerOuterContainer">
<div class="innerContainer">

<div class="questionMainTa2b" style="margin-top: 20px;">

<div class="airSwitch" style="padding-top: 0px;">

    <div class="airSwitchLeft">
        <span class="airSwitchTitle">Your Registrants Command Center</span>
        <span class="airSwitchInfo">All the stats you will need for your registrants...</span>
    </div>

    <div class="airSwitchRight">
        <?php if ($results->webinar_date == "AUTO") { ?>
            <a target="_blank" href="<?php echo $sitePath; ?>inc/csv2A.php?id=<?php echo $client; ?>"
               class="small button secondary" style="margin-right: 0px;"><i class="icon-file-text"></i>
                Export CSV</a>
            <a target="_blank" href="<?php echo $sitePath; ?>inc/csv2hlA.php?id=<?php echo $client; ?>"
               class="small button secondary" style="margin-right: 0px;"><i class="icon-file-text"></i>
                HOT LEADS</a>
            <a href="#" id="showtrackingcode" class="small button secondary" style="margin-right: 0px;"><i
                    class="icon-dollar"></i> Get Order Code</a>
        <?php } else { ?>
            <a target="_blank" href="<?php echo $sitePath; ?>inc/csv2.php?id=<?php echo $client; ?>"
               class="small button secondary" style="margin-right: 0px;"><i class="icon-file-text"></i>
                Export CSV</a>
            <a target="_blank" href="<?php echo $sitePath; ?>inc/csv2hl.php?id=<?php echo $client; ?>"
               class="small button secondary" style="margin-right: 0px;"><i class="icon-file-text"></i>
                HOT LEADS</a>
            <a href="#" id="showtrackingcode" class="small button secondary" style="margin-right: 0px;"><i
                    class="icon-dollar"></i> Get Order Code</a>
            <a href="#" id="importLeads" class="small button secondary thickbox"
               style="margin-right: 0px;"><i class="icon-group"></i> Import Leads (CSV)</a>
        <?php } ?>
    </div>

    <br clear="all"/>

    <!-- <div class="leadQuickStatBar">
					
					<span class="radius secondary label labelStat"><i class="icon-group icon"></i> Total Registrants: <span class="success label label22 radius" id="leadTotal"><?php echo $totalLeads; ?></span> </span>
					<span class="radius secondary label labelStat convertSpan"><i class="icon-caret-right icon"></i> <i id="conversion1" >0%</i></span>
					<span class="radius secondary label labelStat"><i class="icon-eye-open icon"></i> Attended Event: <span class="success label label22 radius" id="eventTotal" >0</span></span>
					<span class="radius secondary label labelStat convertSpan"><i class="icon-caret-right icon"></i> <i id="conversion2" >0%</i></span>
					<span class="radius secondary label labelStat"><i class="icon-film icon"></i> Watched Replay: <span class="success label label22 radius" id="replayTotal">0</span></span>
					<span class="radius secondary label labelStat convertSpan"><i class="icon-caret-right icon"></i> <i id="conversion3">0%</i></span>
					<span class="radius secondary label labelStat"><i class="icon-dollar icon"></i> Ordered: <span class="success label label22 radius" id="orderTotal" >0</span></span>

				</div> -->

    <!-- Import CSV File Area -->
    <div class="importCSVArea" style="display: none;">
        <h2>Import Leads Into This Campaign</h2>
        <h4>Paste in your CSV in the area below. <b>Must Follow This Format: NAME, EMAIL, PHONE</b></h4>
        <textarea id="importCSV" placeholder="Add your CSV Code here..."></textarea>
        <a href="#" class="button secondary" id="addCSV">Import Leads Now</a>
    </div>

    <!-- New Stats Funnel Design Leads -->
    <div class="leadStatBlock">

        <div class="leadStat leadStat1">
            <div class="leadStatTop"><?php echo $totalLeads; ?></div>
            <div class="leadStatLabel" style="border-bottom-left-radius: 5px;">total leads</div>
        </div>

        <div class="leadStat leadStat2">
            <div class="leadStatTop"><span id="eventTotal">0</span></div>
            <div class="leadStatLabel">attended live event</div>
        </div>

        <div class="leadStat leadStat3">
            <div class="leadStatTop"><span id="replayTotal">0</span></div>
            <div class="leadStatLabel">watched replay</div>
        </div>

        <div class="leadStat leadStat4">
            <div class="leadStatTop"><span id="orderTotal">0</span></div>
            <div class="leadStatLabel" style="border-bottom-right-radius: 5px;">purchased</div>
        </div>

        <br clear="left"/>

    </div>

</div>

<table id="leads" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="leadHead"><i class="icon-user" style="margin-right: 5px;"></i>Registrants
                Information:
            </th>
            <th><i class="icon-eye-open" style="margin-right: 5px;"></i>Attended Event:</th>
            <th><i class="icon-film" style="margin-right: 5px;"></i>Watched Replay:</th>
            <th><i class="icon-dollar" style="margin-right: 5px;"></i>Ordered:</th>
            <th width="90"><i class="icon-trash" style="margin-right: 5px;"></i> Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
        foreach ($leads as $leads) {
            ?>
            <tr id="table_lead_<?php echo $leads->ID; ?>" class="leadTableBlock">
                <td style="padding: 15px; width: 350px;">
                                <span class="leadName"><span class="fbLead"
                                                             style="display: <?php if ($leads->trk1 == "FB") {
                                                                 echo "inline";
                                                             } else {
                                                                 echo "none";
                                                             } ?>;"><i
                                            class="icon-facebook-sign"></i></span> <?php echo $leads->name; ?> </span>
                                <span class="leadInfoSub">
                                    <i class="icon-calendar"
                                       style="margin-right: 5px;"></i> <?php echo $leads->created; ?>
                                    <b><i class="icon-envelope-alt"
                                          style="margin-right: 5px; margin-left: 5px;"></i> <?php echo $leads->email; ?>
                                    </b>
                                </span>
                                <span class="leadInfoSub" style="margin-top: 5px;"><i class="icon-mobile-phone"
                                                                                      style="margin-right: 5px;"></i> <?php if ($leads->phone == "undefined" || $leads->phone == "") {
                                        echo "No Phone";
                                    } else {
                                        echo $leads->phone;
                                    } ?>
                                </span>
                    <?php if ($results->webinar_date == "AUTO") { ?>
                        <span class="leadInfoSub">
                                                    <i class="icon-time"
                                                       style="margin-right: 5px; color: green"></i> <?php echo $leads->date_picked_and_live; ?>
                            <b><i class="icon-sun"
                                  style="margin-right: 5px; margin-left: 5px;color: orangered"></i> <?php echo $leads->lead_timezone; ?>
                            </b>
                                </span>
                    <?php } ?>
                </td>
                <td><span class="radius checkEvent <?php if ($leads->event == "No" || $leads->event == "") {
                        echo "secondary";
                    } else {
                        echo "success";
                    } ?> label"><?php if ($leads->event == "No" || $leads->event == "") {
                            echo "No";
                        } else {
                            echo "Yes";
                        } ?></span></td>
                <td><span
                        class="radius checkReplay <?php if ($leads->replay == "No" || $leads->replay == "") {
                            echo "secondary";
                        } else {
                            echo "success";
                        } ?> label"><?php if ($leads->replay == "No" || $leads->replay == "") {
                            echo "No";
                        } else {
                            echo "Yes";
                        } ?></span></td>
                <td><span class="radius checkOrder <?php if ($leads->trk2 == "") {
                        echo "secondary";
                    } else {
                        echo "success";
                    } ?> label"><?php if ($leads->trk2 == "") {
                            echo "No";
                        } else {
                            echo $leads->trk2;
                        }; ?></span></td>

                <td>
                    <center><i class="icon-remove delete_lead" lead_id="<?php echo $leads->ID; ?>"></i>
                    </center>
                </td>
            </tr>
        <?php

        }

        ?>

        <?php
        foreach ($leadsOLD as $leads) {
            ?>
            <tr id="table_lead_<?php echo $leads->ID; ?>" class="leadTableBlock">
                <td style="padding: 15px; width: 350px;">
                                <span class="leadName"><span class="fbLead"
                                                             style="display: <?php if ($leads->trk1 == "FB") {
                                                                 echo "inline";
                                                             } else {
                                                                 echo "none";
                                                             } ?>;"><i
                                            class="icon-facebook-sign"></i></span> <?php echo $leads->name; ?> </span>
                                <span class="leadInfoSub"><i class="icon-calendar"
                                                             style="margin-right: 5px;"></i> <?php echo $leads->created; ?>
                                    <b><i class="icon-envelope-alt"
                                          style="margin-right: 5px; margin-left: 5px;"></i> <?php echo $leads->email; ?>
                                    </b></span>
                                <span class="leadInfoSub" style="margin-top: 5px;"><i class="icon-mobile-phone"
                                                                                      style="margin-right: 5px;"></i> <?php if ($leads->phone == "undefined") {
                                        echo "No Phone";
                                    } else {
                                        echo $leads->phone;
                                    } ?> </span>
                </td>
                <td><span class="radius checkEvent secondary label">N/A</span></td>
                <td><span class="radius checkReplay secondary label">N/A</span></td>
                <td><span class="radius checkOrder secondary label">N/A</span></td>

                <td>
                    <center><i class="icon-remove delete_lead2" lead_id="<?php echo $leads->ID; ?>"></i>
                    </center>
                </td>
            </tr>
        <?php
        }

        ?>

    </tbody>
</table>

<br clear="all"/>

</div>

</div>
</div>

</div>

