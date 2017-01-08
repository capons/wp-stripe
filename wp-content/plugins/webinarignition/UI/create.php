<div id="listapps" class="createWrapper" style="width: 940px;">

<div id="appHeader" class="dashHeaderListing" style="display: none;">
    <span><i class="icon-edit" style="margin-right: 5px;"></i> Create a New LIVE Webinar:</span>
</div>

<div id="formArea" style="padding:20px; ">

<div class="weCreateLeft">

    <div class="weCreateTitle">

        <div class="weCreateTitleCopy">
            <span class="weCreateTitleHeadline">Create New Webinar</span>
            <span class="weCreateTitleSubHeadline">Here you can set up a new webinar...</span>
        </div>

        <div class="weCreateTitleIcon">
            <i class="icon-arrow-right icon-3x weCreateTitleIconI"></i>
        </div>

        <br clear="both"/>

    </div>

    <div class="weCreateExtraSettings">

        <div class="createTitleCopy1">Webinar Name: <span style="font-weight:normal;">Give your new webinar a name / pretty url...</span>
            <br/><span id="notice_name" style="color:red; display:none;"><b>* Need a name!</b></span></div>
        <p class="createTitleCopy2">** Used for the URL: ie: <b>http://yoursite.com/webinar-name</b></p>
        <input class="inputField inputFieldDash2" placeholder="Ex: Webinar-With-Steve-Jobs" type="text" name="appname"
               id="appname" value="">

        <div class="createTitleCopy1" style="margin-top:15px;">Webinar Type: <span style="font-weight:normal;">Select the webinar type...</span>
        </div>
        <p class="createTitleCopy2">You can create a Live Webinar, Auto Webinar, OR Clone a Webinar...</p>

        <select class="inputField inputFieldDash2" name="cloneapp" id="cloneapp">
            <option value="new">NEW :: Live Webinar</option>
            <option value="auto">NEW :: Evergreen Webinar</option>
            <?php

            global $wpdb;
            $table_db_name = $wpdb->prefix . "webinarignition";

            $templates = $wpdb->get_results("SELECT * FROM $table_db_name", ARRAY_A);

            foreach ($templates as $template) {

                $name = stripslashes($template['appname']);
                $id = stripslashes($template['ID']);

                if ($template['cloneID'] == "") {
                    echo "<option  value='$id'>CLONE :: $name</option>";
                }

            }

            ?>
            <option value="import">IMPORT CAMPAIGN</option>
        </select>

        <div class="importArea" style="display:none;">
            <div class="createTitleCopy1" style="margin-top:15px;">Import Campaign: <span style="font-weight:normal;">Clone From External WI Install</span>
            </div>
            <p class="createTitleCopy2">Paste in the export code below from another WI campaign...</p>
            <textarea id="importcode" style="width:100%; height: 150px;"
                      placeholder="add import code here..."></textarea>
        </div>

        <div class="blue-btn-2create btn newWebinarBTN" id="createnewappBTN" style="">
            <a id="createnewapp" href="<?php echo admin_url('?page=webinarignition-dashboard&create'); ?>">
                <i class="icon-plus-sign" style="margin-right: 5px;"></i>
                Create New Webinar
            </a>
        </div>

    </div>

    <div class="timezoneRef" style="color: #FFF;">
        <div class="timezoneRefTitle"><b>REFERENCE</b> :: Your Local Timezone & Current Time</div>
        <div class="timezoneRefZ"></div>
    </div>

</div>

<div class="weCreateRight">

    <div class="weDashRight" style="margin-top: 0px;">

        <div class="weDashDateTitle">
            <!-- <i class="icon-ticket"></i> Webinar Event Info: -->
            <div class="dashWebinarTitleIcon"><i class="icon-ticket icon-3x"></i></div>

            <div class="dashWebinarTitleCopy">
                <h2 style="margin:0px; margin-top: 3px;">Webinar Event Info</h2>

                <p style="margin:0px; margin-top: 3px;">The core settings for your webinar event...</p>
            </div>

            <br clear="left">
        </div>

        <div class="weDashDateInner">

            <div class="weDashSection">
				<span class="weDashSectionTitle">Webinar Title *
					<span class="weDashSectionIcon"><i class="icon-desktop"></i></span>
				</span>
                <br clear="right">
                <input type="text" class="inputField inputFieldDash elem" name="webinar_desc" id="webinar_desc" value=""
                       placeholder="Your Webinar Title...">
            </div>

            <div class="weDashSection">
				<span class="weDashSectionTitle">Webinar Host(s) *
					<span class="weDashSectionIcon"><i class="icon-user"></i></span>
				</span>
                <br clear="right">
                <input type="text" class="inputField inputFieldDash elem" name="webinar_host" id="webinar_host" value=""
                       placeholder="The Name Of The Host(s)...">
            </div>

            <div class="weDashSection" id="createToggle1">
				<span class="weDashSectionTitle">Event Date *
					<span class="weDashSectionIcon"><i class="icon-calendar"></i></span>
				</span>
                <br clear="right">
                <input type="text" class="inputField inputFieldDash elem dp-date" name="webinar_date" id="webinar_date"
                       value="" placeholder="08-08-2013">
            </div>

            <div class="weDashSection" id="createToggle2">
				<span class="weDashSectionTitle">Event Time * <span class="weDashSectionSubTitle">(24hr Time)</span>
					<span class="weDashSectionIcon"><i class="icon-time"></i></span>
				</span>
                <br clear="right">
                <select name="webinar_start_time" id="webinar_start_time" class="inputField inputFieldDash elem ">
                    <option value="00:00">Mid-night</option>
                    <option value="01:00">1:00 AM</option>
                    <option value="02:00">2:00 AM</option>
                    <option value="03:00">3:00 AM</option>
                    <option value="04:00">4:00 AM</option>
                    <option value="05:00">5:00 AM</option>
                    <option value="06:00">6:00 AM</option>
                    <option value="07:00">7:00 AM</option>
                    <option value="08:00">8:00 AM</option>
                    <option value="08:30">8:30 AM</option>
                    <option value="09:00">9:00 AM</option>
                    <option value="09:30">9:30 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="10:30">10:30 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="11:30">11:30 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="12:30">12:30 PM</option>
                    <option value="13:00">1:00 PM</option>
                    <option value="13:30">1:30 PM</option>
                    <option value="14:00">2:00 PM</option>
                    <option value="14:30">2:30 PM</option>
                    <option value="15:00">3:00 PM</option>
                    <option value="15:30">3:30 PM</option>
                    <option value="16:00">4:00 PM</option>
                    <option value="16:30">4:30 PM</option>
                    <option value="17:00">5:00 PM</option>
                    <option value="17:30">5:30 PM</option>
                    <option value="18:00" selected>6:00 PM</option>
                    <option value="18:30">6:30 PM</option>
                    <option value="19:00">7:00 PM</option>
                    <option value="19:30">7:30 PM</option>
                    <option value="20:00">8:00 PM</option>
                    <option value="20:30">8:30 PM</option>
                    <option value="21:00">9:00 PM</option>
                    <option value="21:30">9:30 PM</option>
                    <option value="22:00">10:00 PM</option>
                    <option value="23:00">11:00 PM</option>
                </select>
            </div>

            <div class="weDashSection" id="createToggle3">
				<span class="weDashSectionTitle">Event Timezone *
					<span class="weDashSectionIcon"><i class="icon-globe"></i></span>
				</span>
                <br clear="right">
                <?php create_tz_select_list(); ?>
            </div>

        </div>


    </div>

</div>

<br clear="all"/>
</div>

</div>

<br clear="left"/>
