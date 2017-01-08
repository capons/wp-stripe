<style type="text/css">

	/*TOP AREA CSS STUFF*/
	.topArea{
		<?php if($results->webinar_banner_bg_style == "hide"){ echo "display: none;";} ?>
		background-color: <?php if($results->webinar_banner_bg_color == ""){ echo "#FFF"; } else { echo $results->webinar_banner_bg_color; } ?>;
		<?php
			if($results->webinar_banner_bg_repeater == ""){
				echo "border-top: 3px solid rgba(0,0,0,0.20);
					  border-bottom: 3px solid rgba(0,0,0,0.20);";
			} else{
				echo "background-image: url($results->webinar_banner_bg_repeater);";
			}
		?>
	}

	.mainWrapper{
		background-color: <?php if($results->webinar_background_color == ""){ echo "#f1f1f1;"; } else { echo $results->webinar_background_color; } ?>;
		<?php
			if($results->webinar_background_image == ""){
				echo "border-top: 3px solid rgba(0,0,0,0.05);
					  border-bottom: 3px solid rgba(0,0,0,0.05);";
			} else{
				echo "background-image: url($results->webinar_background_image);";
			}
		?>
	}

	.webinarVideo{
		background-color: <?php if($results->webinar_live_bgcolor == ""){ echo "#212121;"; } else { echo $results->webinar_live_bgcolor . "!important"; } ?>;
	}

	.webinarTopBar{
		background-color: <?php if($results->webinar_live_bgcolor == ""){ echo "#212121;"; } else { echo $results->webinar_live_bgcolor . "!important"; } ?>;
	}

	.webinarExtireTop{
		/*background-color: <?php if(!isset($results->replay_cd_color) || $results->replay_cd_color == ""){ echo "#2d2d2d;"; } else { echo $results->replay_cd_color . "!important"; } ?>;*/
		color: <?php if(!isset($results->replay_cd_color) || $results->replay_cd_color == ""){ echo "#2d2d2d;"; } else { echo $results->replay_cd_color . "!important"; } ?>;
	}

	.countdown_section{
		background-color: #2d2d2d;
	}

	/*.webinarReplayExpireCopy span{
		background-color: <?php if(!isset($results->replay_cd_color2) || $results->replay_cd_color2 == ""){ echo "#8e1113;"; } else { echo $results->replay_cd_color2 . ""; } ?>;
	}*/

	.webinarReplayExpireCopy span{
		background-color: none;
	}

	.autoWebinarLoadingCopy{
		color: #FFF;
		/*font-size: 24px;*/
		/*font-weight: bold;*/
		text-align: center;
		width: 500px;
		margin-right: auto;
		margin-left: auto;
		padding-top: 100px;
	}

	.autoWebinarLoadingCopy h2{
		color: #fff;
	}

	.autoWebinarLoader{
		font-size: 72px;
	}

</style>