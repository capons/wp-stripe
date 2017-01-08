<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php if ( ! empty ( $coupons_collection ) ) : ?>
    <div class="table-responsive">
        <table class="table table-striped" cellspacing="0" cellpadding="0" border="0" id="coupons_list">
            <thead>
            <tr>
                <th class="first"><?php _e( 'Code', 'bookly' ) ?></th>
                <th width="100"><?php _e( 'Discount (%)', 'bookly' ) ?></th>
                <th width="80"><?php _e( 'Deduction', 'bookly' ) ?></th>
                <th width="135"><?php _e( 'Usage limit', 'bookly' ) ?></th>
                <th width="160"><?php _e( 'Number of times used', 'bookly' ) ?></th>
                <th width="10" class="">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ( $coupons_collection as $i => $coupon ) {
                $row_class  = 'coupon-row ';
                if ( 0 == $i ) {
                    $row_class .= 'first';
                } elseif ( ! isset( $coupons_collection[$i + 1] ) ) {
                    $row_class .= 'last';
                }

                include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'list_item.php';
            }
            ?>
            </tbody>
        </table>
    </div>
<?php endif ?>