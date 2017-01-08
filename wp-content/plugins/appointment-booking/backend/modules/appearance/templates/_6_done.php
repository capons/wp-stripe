<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div class="ab-booking-form">
    <!-- Progress Tracker-->
    <?php $step = 6; include '_progress_tracker.php'; ?>
    <div class="ab-row-fluid">
      <span data-inputclass="input-xxlarge" class="ab_editable" data-notes="<?php echo esc_attr( $this->render( '_codes', compact( 'step' ), false ) ) ?>" data-placement="bottom" data-default="<?php echo esc_attr( get_option( 'ab_appearance_text_info_complete_step' ) ) ?>" id="ab-text-info-complete" data-type="textarea"><?php echo nl2br( esc_html( get_option( 'ab_appearance_text_info_complete_step' ) ) ) ?></span>
    </div>
</div>