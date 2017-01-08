<?php
$full_path = get_site_url();
$assets    = WEBINARIGNITION_URL . "inc/lp/";

// Get Results
$id      = $client;
$results = get_option( 'webinarignition_campaign_' . $id );
global $wpdb;
$evergreen_leads_table = $wpdb->prefix . "webinarignition_leads_evergreen";
$individual_offset = 0;
if (!empty($_GET["lid"]) && (int) $_GET["lid"] !== 0) {
	$lead_row = $wpdb->get_row($wpdb->prepare("SELECT date_picked_and_live FROM {$evergreen_leads_table} WHERE id = '{$_GET["lid"]}'"));
	$st_timestamp = strtotime($lead_row->date_picked_and_live);
	$individual_offset = time() - $st_timestamp;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<!-- META INFO -->
	<title><?php
		if ( $results->meta_site_title_webinar == "" ) {
			display( $results->lp_metashare_title, "Amazing Webinar" );
		} else {
			echo $results->meta_site_title_webinar;
		}
		?></title>
	<meta name="description" content="<?php
	if ( $results->meta_desc_webinar == "" ) {
		display( $results->lp_metashare_desc, "Join this amazing webinar, and discover industry trade secrets!" );
	} else {
		echo $results->meta_desc_webinar;
	}
	?>">

	<?php
	if ( $results->ty_share_image == "" ) {

	} else {
		?>
	<meta property="og:image" content="<?php display( $results->ty_share_image, "" ); ?>"/><?php } ?>

	<!-- Bootstrap -->
    <link href="<?php echo $assets; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $assets; ?>css/foundation.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo $assets; ?>css/main.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/webinar.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo $assets; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $assets; ?>css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css"/>




	<?php include( "css/webinar_css.php" ); ?>

	<!-- CUSTOM JS -->
	<script type="text/javascript">
		<?php display($results->custom_webinar_js, ""); ?>
	</script>
	<!-- CUSTOM CSS -->
	<style type="text/css">
		<?php display($results->custom_webinar_css, ""); ?>
	</style>

	<?php if ( $results->wp_head_footer === 'enabled' ) {
		wp_head();
	} ?>

</head>
<body>
<?php
$pluginName = "webinarignition";
$sitePath   = WEBINARIGNITION_URL;
if ( $results->live_stats != 'disabled' ) {
	?>
	<div style="display: none;">
		<script language="javascript" src="<?php echo $sitePath; ?>inc/lp/livecounter.php?s&c"></script>
	</div>
<?php } ?>

<!-- TOP AREA -->
<div class="topArea">
	<div class="bannerTop container">
		<?php
		if ( $results->webinar_banner_image == "" ) {
			// echo "NONE";
		} else {
			echo "<img src='$results->webinar_banner_image' />";
		}
		?>
	</div>
</div>

<!-- Main Area -->
<div class="mainWrapper">

<!-- WEBINAR WRAPPER -->
<div class="webinarWrapper container">

<!-- WEBINAR MAIN BLOCK LEFT -->
<div class="webinarBlock">

<!-- WEBINAR TOP AREA -->
<div class="webinarTopArea">

	<div class="webinarSound" style="color: <?php display( $results->webinar_speaker_color, "#222" ); ?>;">
		<i class="icon-volume-up"></i> <?php display( $results->webinar_speaker, "Turn Up Your Speakers" ); ?>
	</div>

	<div class="webinarShare">
		<?php
		if ( $results->social_share_links !== 'disabled' ) {
			?>
			<div class="webinarShareCopy" style="color: <?php display( $results->webinar_invite_color, "#222" ); ?>;">
				<i class="icon-user"></i> <?php display( $results->webinar_invite, "Invite Your Friends To The Webinar:" ); ?>
			</div>
			<div class="webinarShareIcons wi-block--sharing">
				<?php
				if ( $results->webinar_fb_share == "off" ) {

				} else {
					?>
					<div class="fb-like" data-href="<?php echo $results->webinar_permalink; ?>"
					     style="margin-right: 15px;"
					     data-layout="button_count" data-width="450" data-show-faces="false"></div>
				<?php } ?>
				<?php
				if ( $results->webinar_tw_share == "off" ) {

				} else {
					?>
					<a href="https://twitter.com/share" data-url="<?php echo $results->webinar_permalink; ?>"
					   class="twitter-share-button">Tweet</a>
				<?php } ?>
				<?php
				if ( $results->webinar_gp_share == "off" ) {

				} else {
					?>
					<!-- Place this tag where you want the share button to render. -->
					<div class="g-plus" data-action="share" data-annotation="bubble"
					     data-href="<?php echo $results->webinar_permalink; ?>"></div>

					<!-- Place this tag after the last share tag. -->
					<script type="text/javascript">
						(function () {
							var po = document.createElement('script');
							po.type = 'text/javascript';
							po.async = true;
							po.src = 'https://apis.google.com/js/platform.js';
							var s = document.getElementsByTagName('script')[0];
							s.parentNode.insertBefore(po, s);
						})();
					</script>&nbsp;
				<?php } ?>
				<?php
				if ( $results->webinar_ld_share == "off" ) {

				} else {
					?>
					<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
					<script type="IN/Share" data-url="<?php echo $results->webinar_permalink; ?>"
					        data-counter="right"></script>
				<?php } ?>
			</div>
		<?php } ?>
	</div>

	<br clear="all"/>

</div>
<!-- http://wordpress.dev/?page_id=2&live&lid=2&event=OI3shBXlqsw&live=1 -->
<!-- WEBINAR VIDEO -->
	<div class="webinarVideo">
	<div class="ctaArea">

	<div id="vidBox" style="display:inline-block; position:absolute">
			<?php if ( $results->webinar_date == "AUTO" ) { ?>

				<?php if ( $results->webinar_source_toggle !== 'iframe' ) { ?>
					<div class="autoWebinarLoading"
					     style="z-index: 888888; background-color: rgba(0, 0, 0, 0.8); width: 100%; position:absolute; display: none">

						<div class="autoWebinarLoadingCopy">
							<!-- <h2>Webinar Is Loading...</h2>
							<p>The webinar is loading, please wait a few seconds...</p>
							<br> -->
							<i class="icon-spinner icon-spin icon-large autoWebinarLoader"></i>
							<br/>

							<p>
								<b><?php display( $results->auto_video_load, "Please Wait - The Webinar Is Loading..." ); ?></b>
							</p>
						</div>

					</div>

					<video id="autoReplay" class="video-js vjs-default-skin" width="920" height="518">
						<source src="<?php echo $results->auto_video_url; ?>" type='video/mp4'/>
						<source src="<?php echo $results->auto_video_url2; ?>" type="video/webm"/>
					</video>

					<input type="hidden" id="autoVideoTime">
				<?php
				} else {
					echo do_shortcode( $results->webinar_iframe_source );
				} ?>

			<?php } else { ?>
				<?php
				display(
					do_shortcode( $results->webinar_live_video ), '<img src="' . $assets . '/images/videoplaceholder.png" />'
				);
				?>

			<?php } ?>
	</div>
	<?php if($results->webinar_live_overlay) {?>
		<!-- overlay fix -->
		<div id="vidOvl" style="background-color:rgba(0,0,0,0); width:100%; height:518px; display:inline-block; position:absolute">
		</div>

	<?php } ?>
			<div id="vidOvlSpc" style="width:100%; height: 100%;">
			</div>
			<?php if ( $results->webinar_date == "AUTO" ) { ?>
				<div class="timedUnderArea" id="orderBTN" style="display: <?php
				if ( $results->auto_action == "time" ) {
					echo "none";
				} else {
					echo "block";
				}
				?>;">
					<div id="orderBTNCopy">
						<?php display( $results->auto_action_copy, "" ); ?>
					</div>
					<div id="orderBTNArea">
						<?php
						if ( $results->auto_action_url == "off" ) {

						} else {
							?>
							<a href="<?php display( $results->auto_action_url, "#" ); ?>" target="_blank"
							   class="large radius button success  replayOrder"
							   style="background-color: <?php display( $results->replay_order_color, "#6BBA40" ); ?>; border: 1px solid rgba(0,0,0,0.20); width: 880px; margin-top:0px;"><?php display( $results->auto_action_btn_copy, "Click Here To Grab Your Copy Now" ); ?></a>
						<?php } ?>
					</div>
				</div>

			<?php } else { ?>
				<div class="timedUnderArea" id="orderBTN" style="display: none;">
					<div id="orderBTNCopy"></div>
					<div id="orderBTNArea"></div>
				</div>
			<?php } ?>

	</div>
	<!--/.ctaArea-->
	</div>
	<!--/.webinarVideo-->


<!-- WEBINAR BOTTOM AREA -->
<div class="webinarBottomArea" style="display:none;">

	<?php
	if ( $results->webinar_callin == "hide" ) {

	} else {
		?>
		<div class="webinarSound" style="color: <?php display( $results->webinar_callin_color, "#222" ); ?>;">
			<i class="icon-phone"></i> <?php display( $results->webinar_callin_copy, "To Join Call:" ); ?>  <a
				style="color: <?php display( $results->webinar_callin_color2, "#3E8FC7" ); ?>;"><?php display( $results->webinar_callin_number, "1-555-555-5555" ); ?></a>
		</div>
	<?php } ?>

	<div class="webinarShare">
		<div class="webinarShareCopy">
			<div class="webinarLive" style="color: <?php display( $results->webinar_live_color, "#498A00" ); ?>;">
				<?php display( $results->webinar_live, "Webinar Is Live" ); ?> <i class="icon-circle"></i>
			</div>
			<!-- <a href="#" class="button radius success">Webinar Is Live <i class="icon-circle"></i> </a> -->
		</div>
	</div>

	<br clear="all"/>

</div>

<!-- WEBINAR UNDER EXTRA CTA AREA -->
<div class="webinarUnderArea" style="margin-top: 30px;">
<div class="row">
	<div class="col-md-4">
	<!-- WEBINAR BLOCK RIGHT -->
	<div class="webinarBlockRight">

		<!-- WEBINAR INFO BLOCK -->
		<div class="webinarInfo">
			<div class="webinarTopBar">
				<i class="icon-exclamation-sign"></i>
				<?php display( $results->webinar_info_block_title, "Webinar Information" ); ?>
			</div>
			<div class="webinarInner" style="padding-top:0px;">
				<div class="webinarTitleBar"><i class="icon-microphone"></i>
					<?php display( $results->webinar_info_block_host, "Your Host:" ); ?></div>
				<div class="webinarInfoCopy">
					<?php
					display(
						$results->webinar_host, 'Your Name Here'
					);
					?>
				</div>
				<div class="webinarTitleBar webinarTitleBarAdded"><i class="icon-info"></i>
					<?php display( $results->webinar_info_block_desc, "What You Will Learn:" ); ?></div>
				<div class="webinarInfoCopy">
					<?php
					display(
						$results->webinar_desc, 'In this webinar, you will learn everything you need to know about the webinar...'
					);
					?>
				</div>
			</div>
		</div>

		<!-- GIVE AWAY BLOCK -->
		<div class="webinarQA" style="<?php
		if ( $results->webinar_giveaway_toggle == "hide" ) {
			echo "display: none;";
		}
		?>">
			<div class="webinarTopBar">
				<i class="icon-question-sign"></i> <?php display( $results->webinar_giveaway_title, "Your Special Gift:" ); ?>
			</div>
			<div class="webinarInner">

				<?php display( $results->webinar_giveaway, "<h4>Your Awesome Free Gift</h4><p>You can download this awesome report made you...</p><p>[ DOWNLOAD HERE ]</p>" );
				?>
			</div>
		</div>

	</div>
	<!--/.webinarBlockRight-->
	</div>


	<?php
	if ( $results->webinar_qa !== "hide" ) {
		?>
		<!-- QA AREA -->
		<div class="col-md-8">
			<div class="webinarExtraBlock">

				<div id="askQArea">
					<?php
					display(
						$results->webinar_qa_title, '<h4 style="margin-top: -5px;" >Got A Question?</h4>
					 <h5 class="subheader" style="margin-top: -15px;" >Submit your question, and we can answer it live on air...</h5>'
					);
					?>

					<?php
					if ( $results->webinar_qa == "custom" ) {
						display( $results->webinar_qa_custom, "CUSTOM Q/A SYSTEM WILL DISPLAY HERE... NO CODE ENTERED..." );
						?>
					<?php
					} else {
						?>
						<!-- <div class="webinarQACopy">Ask us a question and we will try to answer it live on the webinar...</div> -->
						<input type="text" id="optName" class="optNamer2"
						       placeholder="<?php display( $results->webinar_qa_name_placeholder, "Enter Your Full Name..." ); ?>">
						<input type="text" id="optEmail" class="optEmailr2"
						       placeholder="<?php display( $results->webinar_qa_email_placeholder, "Enter Your Best Email..." ); ?>">

						<input type="hidden" id="leadID">

						<textarea id="question"
						          placeholder="<?php display( $results->webinar_qa_desc_placeholder, "Ask Your Question Here..." ); ?>"
						          style="height: 80px;"></textarea>
						<a href="#" id="askQuestion" class="button"
						   style="border: 1px solid rgba(0,0,0,0.10); background-color: <?php display( $results->webinar_qa_button_color, "#3E8FC7" ); ?>;"><?php display( $results->webinar_qa_button, "Submit Your Question" ); ?></a>
					<?php } ?>
				</div>
				<div id="askQThankyou" style="display:none;">
					<?php display( $results->webinar_qa_thankyou, "<h4>Thank You For Your Question!</h4><h5 class='subheader' style='margin-top: -15px;'>The question block will refresh in 15 seconds...</h5>" ); ?>
				</div>
			</div>
		</div>
		<!--/.webinarExtraBlock-->
	<?php } ?>
</div>
</div>
<!--/.webinarUnderArea -->


</div>

<br clear="left"/>

</div>

</div>

<!-- BOTTOM AREA -->
<div class="bottomArea">
<div class="container">
	<div><?php display( $results->footer_copy, "All Rights Reserved - Copyright @ " . date( 'Y' ) ); ?></div>
	<?php if ( $results->footer_branding == "show" || $results->footer_branding == "" ) { ?>
		<div style="margin-top: 15px;"><a
				href="<?php display( $results->footer_branding_url, "//webinarignition.com/" ); ?>"
				target="_blank"><b><?php display( $results->footer_branding_copy, "Powered By WebinarIgnition" ); ?></b></a>
		</div>
	<?php } ?>
</div>
</div>


<div id="fb-root"></div>
<script>(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id))
			return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=203159309749638";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

<script>!function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
		if (!d.getElementById(id)) {
			js = d.createElement(s);
			js.id = id;
			js.src = p + '://platform.twitter.com/widgets.js';
			fjs.parentNode.insertBefore(js, fjs);
		}
	}(document, 'script', 'twitter-wjs');</script>


<!-- JS AREA -->
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script> -->
<script src="<?php echo $assets; ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>js/cookie.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>js/polling.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>js/updater.js"></script>

<?php if ( $results->webinar_date == "AUTO" ) { ?>

	<link href="//vjs.zencdn.net/5.8.8/video-js.css" rel="stylesheet">
	<script src="//vjs.zencdn.net/5.8.8/video.js"></script>

<?php } ?>


<script type="text/javascript">
	jQuery.expr[':'].parents = function (a, i, m) {
		return jQuery(a).parents(m[3]).length < 1;
	};

	$(document).ready(function () {

		// AJAX FOR WP
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

		// TRACK +1 VIEW
		$getTrackingCookie = $.cookie('we-trk-live-<?php echo $client; ?>');

		if ($getTrackingCookie != "tracked") {
			// No Cookie Set - Track View
			$.cookie('we-trk-live-<?php echo $client; ?>', "tracked", {expires: 30});
			var data = {action: '<?php echo $pluginName; ?>_track_view', id: "<?php echo $client; ?>", page: "live"};
			$.post(ajaxurl, data, function (results) {
			});
		} else {
			// Already tracked...
		}
		// Track +1 Total
		var data = {action: '<?php echo $pluginName; ?>_track_view_total', id: "<?php echo $client; ?>", page: "live"};
		$.post(ajaxurl, data, function (results) {
		});

		<?php if(1==2) { //never show this block of code. remove conditional statement if needed ?>
		var data = {action: 'webinarignition_track_view', id: "<?php echo $client; ?>", page: "live"};
		$.post(ajaxurl, data, function (results) {
		});
		<?php } ?>

		// VIDEO FIXES:
		$(".ctaArea").find("iframe, embed, object").height(518).width(920);

		// ASK QUESTION
		$('#askQuestion').click(function () {

                    function validateEmail(email) {
                        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                        return re.test(email);
                    }

			$question = $("#question").val();
			$Name = $("#optName").val();
			$Email = $("#optEmail").val();
			$ID = $("#leadID").val();

                        if( !validateEmail( $Email ) ) {
                            $('#optEmail').addClass("errorField");
                            return false;
                        }

			if ($question == "") {
				// No Question
				$("#question").addClass("errorField");
			} else {

				// Submit Question...
				$("#question").removeClass("errorField");

				// AJAX Question
				var data = {
					action: 'webinarignition_submit_question',
					id: "<?php echo $client; ?>",
					question: "" + $question + "",
					name: "" + $Name + "",
					email: "" + $Email + "",
					lead: "" + $ID + ""
				};
				$.post(ajaxurl, data, function (results) {

					$("#askQArea").hide();
					$("#askQThankyou").show();

					setTimeout(function () {
						$("#askQArea").show();
						$("#askQThankyou").hide();
						$("#question").val("");
					}, 15000);

				});

			}

			return false;
		});

		// Track Event Attending
		$checkCookie = $.cookie('we-trk-<?php echo $client; ?>');
		// Post & Track
		<?php if ( $results->webinar_date == "AUTO" ) { ?>
		var data = {
			action: 'webinarignition_trk_event_auto',
			id: "<?php echo $client; ?>",
			cookie: "<?php echo $_COOKIE['we-trk-' . $client]; ?>",
			ip: "<?php echo $_SERVER['REMOTE_ADDR']; ?>"
		};
		<?php } else { ?>
		var data = {
			action: 'webinarignition_trk_event',
			id: "<?php echo $client; ?>",
			cookie: "<?php echo $_COOKIE['we-trk-' . $client]; ?>",
			ip: "<?php echo $_SERVER['REMOTE_ADDR']; ?>"
		};
		<?php } ?>
		$.post(ajaxurl, data, function (results) {
		});

		// Get Name / Email
		<?php if ( $results->webinar_date == "AUTO" ) { ?>
		var data = {
			action: 'webinarignition_get_qa_name_email2',
			cookie: "<?php echo $_GET['lid']; ?>",
			ip: "<?php echo $_SERVER['REMOTE_ADDR']; ?>"
		};
		<?php } else { ?>
		var data = {
			action: 'webinarignition_get_qa_name_email',
			cookie: "<?php echo $_COOKIE['we-trk-' . $client]; ?>",
			ip: "<?php echo $_SERVER['REMOTE_ADDR']; ?>"
		};
		<?php } ?>

		$.post(ajaxurl, data, function (results) {
			// Set Name & Email -- if nothing
			if (results == "0") {
				// alert("Nothing");
			} else {
				// Got Info
				$qaInfo = results.split("//");
				$("#optName").val($qaInfo[0]);
				// $("#optName").attr("disabled","disabled");
				$("#optEmail").val($qaInfo[1]);
				// $("#optEmail").attr("disabled","disabled");
				$("#leadID").val($qaInfo[2]);
			}
		});

		// Polling For Live Broadcast Message
		<?php if ( $results->webinar_date != "AUTO" && $results->live_stats!='disabled' ) { ?>
		$.PeriodicalUpdater('<?php echo $sitePath; ?>inc/air.php', {
			method: 'get',
			data: {id: "<?php echo $client; ?>", ip: "<?php echo $_SERVER['REMOTE_ADDR']; ?>"},
			minTimeout: 10000,
			maxTimeout: 20000,
			multiplier: 2,
			type: 'text',
			maxCalls: 0,
			autoStop: 0,
			cookie: {},
			verbose: 0
		}, function (remoteData, success, xhr, handle) {

			$response = remoteData;
			if ($response == "OFF") {
				// Do Nothing
				$("#orderBTN").hide();
			} else {
				$("#orderBTN").show();
				$("#orderBTNCopy").html(remoteData);
			}
		});
		<?php } ?>

	});

</script>

<script type="text/javascript">
	(function () {
		var po = document.createElement('script');
		po.type = 'text/javascript';
		po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(po, s);
	})();
</script>

<script type="text/javascript">
    <?php
        if ( $results->webinar_date == "AUTO" ) {
    // For Auto Webinar...
    ?>

        jQuery(document).ready(function ($){

            if (document.getElementById('autoReplay'))  {

                videojs("autoReplay").ready(function () {

                    var myPlayer = this;

					<?php if ($individual_offset > 0) : ?>
						myPlayer.one("loadedmetadata", function() {
							console.log(myPlayer.duration());
							if (myPlayer.duration() > "<?= $individual_offset ?>") {
								myPlayer.currentTime(<?= $individual_offset ?>);
								myPlayer.play();
							}
						});
					<?php else: ?>
						myPlayer.play();
					<?php endif; ?>


                    setTimeout(function(){ //added a 15 sec delay because mPlayer.currenTime() is giving the wrong value
                                       //upon page load, causing the CTA button to show immediately.
                        myPlayer.on('timeupdate', function () {
                                var num = myPlayer.currentTime();
                                num = Math.ceil(num * 10) / 10;
                                var minutes = Math.floor(num / 60);
                                $("#autoVideoTime").val(minutes);
                                $(".autoWebinarLoading").fadeOut("fast");
                                // Trigger Timed Action
                                var timedAction = <?php echo (!empty($results->auto_action_time) ? $results->auto_action_time : 0); ?>;
                                if (minutes >= timedAction) {
                                        $("#orderBTN").show();
                                }
                        });

                    }, 15000);

                myPlayer.on('ended', function () {
                    <?php
                    if ($results->auto_redirect == "redirect") {
                    ?>
                    window.location.href = "<?php echo $results->auto_redirect_url; ?>";
                    <?php } ?>
                });

            });

        }
});

    <?php } ?>
</script>

<?php if ( $results->wp_head_footer === 'enabled' ) {
	wp_footer();
} ?>

<!--Extra code-->
<?php
echo $results->footer_code;
?>


<script>
// --------------------------------------------------------------------------------------
/*
	document.getElementById('autoReplay_html5_api').addEventListener
	(
		'loadedmetadata',function(vid)
		{
			var vid = getElementById('autoReplay_html5_api');
			var ovl = document.createElement('div');

			vid.style.position = 'absolute';
			vid.style.zIndex = 98;

			ovl.setAttribute('style', 'position:absolute; z-index:99; width:920px; height:518px; background:#BADA55');

			vid.parentNode.appendChild(ovl);
		},
		false
	);
*/
// --------------------------------------------------------------------------------------
</script>

</body>
</html>
