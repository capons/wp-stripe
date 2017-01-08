<!-- ON AIR AREA -->
	<div id="onairTab" style="display:none;" class="consoleTabs" >

		<div class="statsDashbord">

			<div class="statsTitle statsTitle-Air">
				
				<div class="statsTitleIcon">
				<i class="icon-microphone icon-2x"></i>
				</div>
				
				<div class="statsTitleCopy">
				<h2>On Air Message</h2>
				<p>Manage the live broadcasting message to live viewers...</p>
				</div>
				
				<br clear="left" />

			</div>

		</div>

	<div class="innerOuterContainer">	
	<div class="innerContainer">

		<div class="airSwitch">
			
			<div class="airSwitchLeft">
				<span class="airSwitchTitle" >On Air Broadcast Switch</span>
				<span class="airSwitchInfo">If set to ON, the message/html below will appear under the webinar (instantly) for people on the webinar...</span>
			</div>

			<div class="airSwitchRight">
				<p class="field switch">
				    <input type="hidden" id="airToggle" value="<?php if( !isset($results->air_toggle) || $results->air_toggle == "" || $results->air_toggle == "on"  ){ echo "on"; } else { echo $results->air_toggle; } ?>"  >
				    <label for="radio1" class="cb-enable <?php if( !isset($results->air_toggle) || $results->air_toggle == "" || $results->air_toggle == "on" ){ echo "selected"; } ?> "><span>On</span></label>
				    <label for="radio2" class="cb-disable <?php if( isset($results->air_toggle) && $results->air_toggle == "off" ){ echo "selected"; } ?>"><span>Off</span></label>
				</p>
			</div>
			
			<br clear="all" />

		</div>

		<div class="airEditorArea" style="margin-top: 20px;" >
			<textarea name="content" id="airCopy" style="width:100%; height: 400px;"><?php echo isset($results->air_html) ? stripcslashes($results->air_html) : ""; ?></textarea>
			
			<?php //wp_editor( $content, $editor_id, $settings = array() ); ?>
			<!-- <div class="airExtraOptions">
				<span class="airSwitchTitle" >Order Block Style</span>
				<span class="airSwitchInfo">Choose from a few different block styles...</span>
				<?php echo isset($results->air_block_style) ? stripcslashes($results->air_block_style) : ""; ?>
				<select style="margin-top: 10px;" id="air_block_style"  >
				  <option value="normal">Clean & Simple White</option>
				  <option value="black">Dark BG With White Text</option>
				  <option value="discount">Discount Red Cut Out Border</option>
				  <option value="green">Green Stand Out</option>
				  <option value="blue">Blue Stand Out</option>
				  <option value="red">Red Stand Out</option>
				  <option value="orange">Orange Stand Out</option>
				</select>
			</div> -->

			<div class="airExtraOptions">
				<span class="airSwitchTitle" >Order Button To Copy</span>
				<span class="airSwitchInfo">This is the copy that is displayed on the button...</span>
				<input type="text" style="margin-top: 10px;"  placeholder="Ex: Click Here To Download Your Copy" id="air_btn_copy" value="<?php echo isset($results->air_btn_copy) ? stripcslashes($results->air_btn_copy) : ""; ?>"  >
			</div>

			<div class="airExtraOptions">
				<span class="airSwitchTitle" >Order Button URL</span>
				<span class="airSwitchInfo">This is the url the button goes to (leave blank if you don't want the button to appear)...</span>
				<input type="text" style="margin-top: 10px;"  placeholder="Ex: http://yoursite.com/order-now" id="air_btn_url" value="<?php echo isset($results->air_btn_url) ? stripcslashes($results->air_btn_url) : ""; ?>" >
			</div>

		</div>

		<div class="airSwitchSaveArea">

			<div class="airSwitchFooterLeft">
				<!-- <span class="airSwitchInfo"><b>Live Message Status (Control AJAX Requests)</b></span>
				<select style="margin-top: 10px;" id="airSetting" >
				  <option value="on" <?php if( isset($results->air_setting) && ($results->air_setting == "" || $results->air_setting == "on" )){ echo "selected"; } ?> >Enable Live Message Check</option>
				  <option value="off" <?php if( isset($results->air_setting) && $results->air_setting == "off" ){ echo "selected"; } ?> >Disable Live Message Check</option>
				</select> -->
			</div>

			<div class="airSwitchFooterRight" style="margin-bottom: 20px;" >
				<a href="#" id="saveAir" class="small button radius success" style="margin-right:0px;" ><i class="icon-save"></i> Save On Air Settings</a>
			</div>

			<br clear="all" />

		</div>

	</div>
	</div>

	</div>