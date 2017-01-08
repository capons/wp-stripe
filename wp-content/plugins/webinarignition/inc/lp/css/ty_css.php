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
		background-color: #f1f1f1;
	}


</style>