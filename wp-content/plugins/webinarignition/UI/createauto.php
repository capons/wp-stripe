<div id="listapps" style="width: 940px;" >

	<div id="appHeader" style="padding-bottom: 25px; padding-top: 25px; background-color: #4B97C3; text-shadow: 2px 2px 1px rgba(0,0,0,0.20); border-bottom: 3px solid rgba(0,0,0,0.20);">
		<span><i class="icon-edit" style="margin-right: 5px;" ></i> Create a New AUTO Webinar:</span>
	</div>
	
	<div id="formArea" style="padding:20px; ">

		<!-- <div class="createTitle">Webinar Type: <span style="font-weight:normal;">A New Webinar Or Clone Webinar...</span></div>
		<select class="inputField" name="cloneapp" id="cloneapp" >
		  <option value="new">Create New Auto Webinar</option>
			<?php 
		   	
		   	global $wpdb;
		    $table_db_name = $wpdb->prefix . "webinarignition";

		   	$templates = $wpdb->get_results("SELECT * FROM $table_db_name WHERE camtype = 'auto'", ARRAY_A);
		   	
		   	foreach($templates as $template){
		   	
		   		$name = stripslashes($template['appname']);
		   		$id = stripslashes($template['ID']);

		   		if( $template['cloneID'] == "" ){
		   			echo "<option  value='$id'>Clone: $name</option>";
		   		}
		   		
		   		// echo "<option  value='$id'>Clone: $name</option>";
		   	
		   	}
		   	
		   	?>
		</select> -->

		<input type="hidden" name="cloneapp" id="cloneapp" value="new"  >
		
		<div class="createTitle" style="margin-top: 20px;" >Webinar Name: <span style="font-weight:normal;">Give your new webinar a name...</span> <span id="notice_name" style="color:red; display:none;"><b>* Need a name!</b></span></div>
		<p>Used for the URL: ie: http://yoursite.com/webinar-name</p>

		<input class="inputField" placeholder="Ex. Webinar With Steve Jobs" type="text" name="appname" id="appname" value="">

		<div class="createTitle" style="margin-top: 15px;">Webinar Title: <span style="font-weight:normal;">What your webinar is about</span></div>

		<input class="inputField" placeholder="Ex. Learn How We Crush It With Webinars" type="text" name="webinar_desc" id="webinar_desc" value="">

		<div class="createTitle" style="margin-top: 15px;">Webinar Hosts: <span style="font-weight:normal;">Who is hosting your webinar</span></div>

		<input class="inputField" placeholder="Ex. John Wayne" type="text" name="webinar_host" id="webinar_host" value="">

		<div class="createTitle" style="margin-top: 15px;">Webinar Dates To Include: <span style="font-weight:normal;">Days Of The Week For Webinars</span></div>
		<p>These are the days of the week you want have webinars appear on, in english, names of the day, ie: monday, and must be seperated by commas</p>
		<input class="inputField elem" placeholder="" type="text" name="webinar_dates" id="webinar_dates" value="monday, tuesday, thursday, friday">

		<div class="createTitle" style="margin-top: 15px;">Webinar Dates To Exclude: <span style="font-weight:normal;">Non-Selectable Dates</span></div>
		<p>These are dates like holidays, you don't want to have webinars for. Seperated by commas, MM-DD</p>
		<input class="inputField elem" placeholder="" type="text" name="webinar_blocked_dates" id="webinar_blocked_dates" value="01-01, 12-24, 12-25, 05-05">

		<div class="createTitle" style="margin-top: 15px;">Webinar Times: <span style="font-weight:normal;">Times Webinars Will Be Running</span></div>
		<p>These are the times you want the webinars to run, ie, 12:00 (12pm), must be in 24hr time, HH:MM and seperated by commas (leads timzeone used *)</p>
		<input class="inputField elem" placeholder="" type="text" name="webinar_times" id="webinar_times" value="13:00, 18:00">

		<div class="createTitle" style="margin-top: 15px;">Allow For Today Option: <span style="font-weight:normal;">Leads Can Watch Replay Right Away</span></div>
		<p>Leads will be able to pick three days a head of time...</p>
		<select name="webinar_instant" id="webinar_instant" class="inputField elem ">
				<option value="yes"  >Yes, allow for webinar replay to be watched instantly</option>
				<option value="no"  >No, do not allow webinar replay to be watched instantly</option>
		</select>

		<div class="createTitle" style="margin-top: 15px;">Days Lanuage: <span style="font-weight:normal;">Language Code For Printed Days</span></div>
		<p>If you want to show the dates selected in a different language, enter the lang code below, default, english, <a href="http://www.loc.gov/standards/iso639-2/php/code_list.php" target="_blank">Get Code Here</a></p>
		<input class="inputField" placeholder="HH:MM" type="text" name="webinar_lang" id="webinar_lang" value="en">


	</div>
	


	<div class="appnew" style="margin-top: -20px;" >

		<span class="blue-btn-2 btn" id="createnewapp2" ><a href="#">Create New Auto Webinar</a></span>

		<br clear="right" >

	</div>

</div>

<br clear="left" />
