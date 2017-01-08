<?php

// Functions For Form Elements ::

// DISPLAY SINGLE FIELD:

function display_field($num, $data, $title, $id, $help, $placeholder){

	// Output HTML

	?>

	<div class="editSection">

		<div class="inputTitle">
			<div class="inputTitleCopy" ><?php echo $title; ?></div>
			<div class="inputTitleHelp" ><?php echo $help; ?></div>
		</div>

		<div class="inputSection">
			<input class="inputField elem" placeholder="<?php echo $placeholder; ?>" type="text" name="<?php echo $id; ?>" id="<?php echo $id; ?>" value="<?php echo htmlspecialchars(stripcslashes($data)); ?>">
		</div>
		<br clear="left" >

	</div>

	<?php
}

// DISPLAY SINGLE FIELD W/ IMAGE BUTTON

function display_field_image($num, $data, $title, $id, $help, $placeholder){

	// Output HTML

	?>

	<div class="editSection">

		<div class="inputTitle">
			<div class="inputTitleCopy" ><?php echo $title; ?></div>
			<div class="inputTitleHelp" ><?php echo $help; ?></div>
		</div>

		<div class="inputSection">
			<input style="float:left; width: 420px; " placeholder="<?php echo $placeholder; ?>" class="inputField elem" type="text" name="<?php echo $id; ?>" id="<?php echo $id; ?>" value="<?php echo htmlspecialchars(stripcslashes($data)); ?>">
			<div style="float:right; margin-top: 10px; margin-bottom:15px;" class='launch_media_lib grey-btn ' photoBox='<?php echo $id; ?>' >Upload Image</div>
			<br clear="all" >
		</div>
		<br clear="left" >

	</div>

	<?php
}

// DISPLAY TEXTAREA:

function display_textarea($num, $data, $title, $id, $help, $placeholder){

	// Output HTML

	?>

	<div class="editSection">

		<div class="inputTitle">
			<div class="inputTitleCopy" ><?php echo $title; ?></div>
			<div class="inputTitleHelp" ><?php echo $help; ?></div>
		</div>

		<div class="inputSection">
			<textarea name="<?php echo $id; ?>" placeholder="<?php echo $placeholder; ?>" id="<?php echo $id; ?>" class="inputTextarea elem" ><?php echo htmlspecialchars(stripcslashes($data)); ?></textarea>
		</div>
		<br clear="left" >

	</div>

	<?php
}

// DISPLAY OPTIONS

function display_option($num, $data, $title, $id, $help, $options){

	// Get options:

	$items = explode(",", $options);
	$first_option = "N/A";


	// Output HTML

	?>

	<div class="editSection">

		<div class="inputTitle">
			<div class="inputTitleCopy" ><?php echo $title; ?></div>
			<div class="inputTitleHelp" ><?php echo $help; ?></div>
		</div>



		<div class="inputSection" style="padding-top:20px; padding-bottom: 30px;" >
		<?php

		$i = 0; // Counter
		$selectedClass = "";
		$selectedClass2 = "";

		foreach($items as $item) {

			$item = explode("[", $item);
			$item[0] = trim($item[0]);
			$item[1] = str_replace("]", "", $item[1]);

			if( $data == "" && $i == "0" ){
			  	// Is First Element && Data is null
				$selectedClass = "optionSelectorSelected";
				$selectedClass2 = "icon-circle";
				$first_option = $item[1];
			}

			?>
			<a href="#" class="opts-grp-<?php echo $id;?> optionSelector <?php if($data == $item[1] ){ echo "optionSelectorSelected"; } ?> <?php echo $selectedClass; ?> " data-value="<?php echo $item[1]; ?>" data-id="<?php echo $id;?>"  ><i class="<?php if($data == $item[1] ){ echo "icon-circle"; } else { echo "icon-circle-blank"; } ?> iconOpts <?php echo $selectedClass2; ?>"></i> <?php echo $item[0]; ?></a>
			<?php

			$i++; // add to counter
			$selectedClass = ""; // Reset Class
			$selectedClass2 = "";

		}
		?>

		<input type="hidden" name="<?php echo $id; ?>" id="<?php echo $id; ?>" value="<?php if( $data == "" ){ echo $first_option; } else { echo $data; }; ?>" />

		</div>
		<br clear="left" >

	</div>

	<?php
}

// DISPLAY WP EDITOR:

function display_wpeditor($num, $data, $title, $id, $help){

			// $id = htmlspecialchars(stripcslashes($results->$id));

			$settings = array(
				'wpautop' => false, // use wpautop - add p tags when they press enter
				'media_buttons' => false, // show insert/upload button(s)
				'teeny' => false, // output the minimal editor config used in Press This
				'tinymce' => array(
				'height' => '250' // the height of the editor
			));

			// Output HTML

			?>

			<div class="editSection">

				<div class="inputTitle">
					<div class="inputTitleCopy" ><?php echo $title; ?></div>
					<div class="inputTitleHelp" ><?php echo $help; ?></div>
				</div>

				<div class="inputSection">
					<?php wp_editor( stripcslashes($data) , $id, $settings ); ?>
					<div style="float:right; margin-top: 10px; margin-bottom:15px;" class='launch_media_lib grey-btn ' photoBox='<?php echo $id; ?>' >Insert Image</div>
				</div>
				<br clear="left" >

			</div>

			<?php

}

// DISPLAY - ACTION FOR CALLBACK:

function display_field_hidden($id, $callback){

	// Output HTML

	?>
		<input class="inputField elem" type="hidden" name="<?php echo $id; ?>" id="<?php echo $id; ?>" value="<?php echo $callback; ?>">

	<?php
}

