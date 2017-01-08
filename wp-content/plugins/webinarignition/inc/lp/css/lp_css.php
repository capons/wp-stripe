<style type="text/css">

	/*TOP AREA CSS STUFF*/
	.topArea{
		<?php if($results->lp_banner_bg_style == "hide" ){ echo "display: none;";} ?>
		background-color: <?php if($results->lp_banner_bg_color == ""){ echo "#FFF"; } else { echo $results->lp_banner_bg_color; } ?>;
		<?php
			if($results->lp_banner_bg_repeater == ""){
				echo "border-top: 3px solid rgba(0,0,0,0.20);
					  border-bottom: 3px solid rgba(0,0,0,0.20);";
			} else{
				echo "background-image: url($results->lp_banner_bg_repeater);";
			}
		?>
	}

	.mainWrapper{
		background-color: <?php if($results->lp_background_color == ""){ echo "#f1f1f1;"; } else { echo $results->lp_background_color; } ?>;
		<?php
			if($results->lp_background_image == ""){
				echo "border-top: 3px solid rgba(0,0,0,0.05);
					  border-bottom: 3px solid rgba(0,0,0,0.05);";
			} else{
				echo "background-image: url($results->lp_background_image);";
			}
		?>
	}

	.videoBlock{
		background-color: <?php if($results->lp_cta_bg_color == ""){ echo "#212121;"; } else { echo $results->lp_cta_bg_color; } ?>;
	}

	.innerHeadline{
		background-color: <?php if($results->lp_sales_headline_color == ""){ echo "#0496AC;"; } else { echo $results->lp_sales_headline_color; } ?>;
	}

	#optinBTN{
		background-color: <?php if($results->lp_optin_btn_color == ""){ echo "#74BB00;"; } else { echo $results->lp_optin_btn_color; } ?>;
	}

</style>