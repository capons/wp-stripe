<?php
$config = array(
	'email'    => 'Please enter a valid email address',
	'phone'    => 'Please enter a valid phone number',
	'required' => 'Name and Email fields are required'
)
/* always include all elements inside a thrv-leads-slide-in element */
?>
<div
	class="thrv-leads-form-box tve_no_drag tve_no_icons tve_element_hover thrv_wrapper tve_editor_main_content tve_26_set tve_orange tve_brdr_solid thrv-leads-in-content">
	<div class="thrv_wrapper thrv_columns tve_clearfix" style="margin-bottom: 0;">
		<div class="tve_colm tve_foc tve_df tve_ofo ">
			<div style="width: 137px;" class="thrv_wrapper tve_image_caption aligncenter">
                             <span class="tve_image_frame">
                                <img class="tve_image"
                                     src="<?php echo TVE_LEADS_URL . 'editor-templates/_form_css/images/set_26_icon.png' ?>"
                                     style="width: 137px;"/>
                            </span>
			</div>
		</div>
		<div class="tve_colm tve_tfo tve_df tve_lst">
			<h2 style="color: #000; font-size: 34px; margin-top: 25px;margin-bottom: 15px;" class="rft">
                <span class="italic_text">
                    Subscribe to our Newsletter!
                </span>
			</h2>

			<p style="color: #000; font-size: 20px; margin-top: 0;">
				Aenean sollicitudin, lorem quis bibendum auctor, nisi elit
				ipsum, nec sagittis sem nibh id elit.
			</p>
		</div>
	</div>
	<div class="thrv_wrapper thrv_contentbox_shortcode" data-tve-style="5">
		<div class="tve_cb tve_cb5 tve_orange" style="margin: 20px -20px -30px -20px;">
			<div class="tve_cb_cnt">
				<div data-tve-style="1" class="thrv_wrapper thrv_lead_generation tve_clearfix tve_black thrv_lead_generation_horizontal tve_3" data-inputs-count="3" style="margin-top: 0;margin-bottom: 0;">
					<div style="display: none;" class="thrv_lead_generation_code"></div>
					<input type="hidden" class="tve-lg-err-msg" value="<?php echo htmlspecialchars( json_encode( $config ) ) ?>"/>
					<div class="thrv_lead_generation_container tve_clearfix">
						<div class="tve_lead_generated_inputs_container tve_clearfix">
							<div class="tve_lead_fields_overlay"></div>
							<div class="tve_lg_input_container  tve_lg_3 tve_lg_input">
								<input type="text" name="name" value="" data-placeholder="name" placeholder="Your Name">
							</div>
							<div class="tve_lg_input_container  tve_lg_3 tve_lg_input">
								<input type="text" name="email" value="" data-placeholder="email" placeholder="Your Email">
							</div>
							<div class="tve_lg_input_container tve_submit_container tve_lg_3 tve_lg_submit">
								<button type="Submit">SUBSCRIBE</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>