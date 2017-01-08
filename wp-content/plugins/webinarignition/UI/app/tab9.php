<div class="tabber" id="tab9" style="display: none;">

	<div class="titleBar">
		<h2>Design / Templates</h2>
		<p>Here you can select which front-end theme you want and what webinar theme you want...</p>
	</div>

	<?php

	// display_edit_toggle(
	// 	"film",
	// 	"Front End Template",
	// 	"we_design_fe",
	// 	"Setup for the video that is played on the webinar replay page..."
	// );

	?>

	<div id="we_design_fe" class="we_edit_area" style="display:block;" >
		<?php
		
		display_option_img( 
			$_GET['id'],
			$results->fe_template,
			"Registration Funnel Theme", 
			"fe_template",
			"You can choose between the styles on the right. This is for the landing page/registration page and for the thank you page styles...",
			"$sitePath"."images/lp1.png [lp],
			 $sitePath"."images/lp2.png [ss],
			 $sitePath"."images/lp3.png [cp]"
		);

		?>
	</div>

	<div class="bottomSaveArea">
		<a href="#" class="blue-btn-44 btn saveIt" style="color:#FFF;" ><i class="icon-save" ></i> Save & Update</a>
	</div>

</div>