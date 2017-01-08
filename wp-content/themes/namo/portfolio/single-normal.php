<?php
	//global $post;
	global $be_themes_data;
	$be_pb_class = 'page-builder';
	$be_pb_disabled = get_post_meta( get_the_ID(), '_be_pb_disable', true );
	//var_dump($be_pb_disabled);
	if( true === $be_pb_disabled || 'yes' == $be_pb_disabled || !isset( $be_themes_data['enable_pb'] ) || 0 == $be_themes_data['enable_pb'] ) {
		$be_pb_class = 'be-wrap no-page-builder';
		get_template_part( 'page-breadcrumb' );
	}
?>
<section id="content" class="no-sidebar-page">
	<div id="content-wrap" class="<?php echo $be_pb_class; ?>">
		<section id="page-content">
			<div class="clearfix">
				<?php 	
					the_content();					
					//get_template_part( 'portfolio/single', 'navigation' );				
				?>
			</div> <!--  End Page Content -->
		</section>
	</div>
</section>