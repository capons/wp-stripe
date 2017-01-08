<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    echo $progress_tracker;
?>
<div style="display: table; width: 100%" class="ab-row-fluid">
    <div class="ab-desc ab-hidden">
        <div class="ab-col-1">
            <?php echo $info_text ?>
        </div>
        <div class="ab-col-2">
            <button class="ab-add-item ab-btn ladda-button" data-style="zoom-in" data-spinner-size="40">
                <span class="ladda-label"><?php echo AB_Utils::getTranslatedOption( 'ab_appearance_text_button_book_more' ) ?></span>
            </button>
            <div class="ab--holder ab-label-error ab-bold"></div>
        </div>
    </div>
</div>
<div class="ab-cart-step">
    <div class="ab-cart">
        <table>
            <thead class="ab-desktop-version">
                <tr>
                    <th><?php echo AB_Utils::getTranslatedOption( 'ab_appearance_text_label_service' ) ?></th>
                    <th><?php _e( 'Date', 'bookly' ) ?></th>
                    <th><?php _e( 'Time', 'bookly' ) ?></th>
                    <th><?php echo AB_Utils::getTranslatedOption( 'ab_appearance_text_label_employee' ) ?></th>
                    <th class="ab-rtext"><?php _e( 'Price', 'bookly' ) ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="ab-desktop-version">
            <?php foreach ( $cart_items as $key => $item ) : ?>
                <tr data-cart-key="<?php echo $key ?>">
                    <td><?php echo $item['service_title'] ?></td>
                    <td><?php echo AB_DateTimeUtils::formatDate( $item['appointment_datetime'] ) ?></td>
                    <td><?php echo AB_DateTimeUtils::formatTime( $item['appointment_datetime'] ) ?></td>
                    <td><?php echo $item['staff_name'] ?></td>
                    <td class="ab-rtext"><?php echo $item['column_price'] ?></td>
                    <td class="ab-rtext ab-nowrap">
                        <a href="javascript:void(0)" title="<?php esc_attr_e( 'Edit', 'bookly' ) ?>" class="ab--actions ladda-button" data-style="zoom-in" data-spinner-size="15" data-action="edit"></a>
                        <a href="javascript:void(0)" title="<?php esc_attr_e( 'Remove', 'bookly' ) ?>" class="ab--actions ladda-button" data-style="zoom-in" data-spinner-size="15" data-action="drop"></a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
            <tbody class="ab-mobile-version">
            <?php foreach ( $cart_items as $key => $item ) : ?>
                <tr data-cart-key="<?php echo $key ?>">
                    <th><?php echo AB_Utils::getTranslatedOption( 'ab_appearance_text_label_service' ) ?></th>
                    <td><?php echo $item['service_title'] ?></td>
                </tr>
                <tr data-cart-key="<?php echo $key ?>">
                    <th><?php _e( 'Date', 'bookly' ) ?></th>
                    <td><?php echo AB_DateTimeUtils::formatDate( $item['appointment_datetime'] ) ?></td>
                </tr>
                <tr data-cart-key="<?php echo $key ?>">
                    <th><?php _e( 'Time', 'bookly' ) ?></th>
                    <td><?php echo AB_DateTimeUtils::formatTime( $item['appointment_datetime'] ) ?></td>
                </tr>
                <tr data-cart-key="<?php echo $key ?>">
                    <th><?php echo AB_Utils::getTranslatedOption( 'ab_appearance_text_label_employee' ) ?></th>
                    <td><?php echo $item['staff_name'] ?></td>
                </tr>
                <tr data-cart-key="<?php echo $key ?>">
                    <th><?php _e( 'Price', 'bookly' ) ?></th>
                    <td><?php echo $item['column_price'] ?></td>
                </tr>
                <tr data-cart-key="<?php echo $key ?>">
                    <th></th>
                    <td>
                        <a href="javascript:void(0)" title="<?php esc_attr_e( 'Edit', 'bookly' ) ?>" class="ab--actions ladda-button" data-style="zoom-in" data-spinner-size="20" data-action="edit"></a>
                        <a href="javascript:void(0)" title="<?php esc_attr_e( 'Remove', 'bookly' ) ?>" class="ab--actions ladda-button" data-style="zoom-in" data-spinner-size="20" data-action="drop"></a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
            <tfoot class="ab-mobile-version">
                <tr>
                    <th><?php _e( 'Total', 'bookly' ) ?>:</th>
                    <td><strong class="ab-total-price"><?php echo AB_Utils::formatPrice( $total ) ?></strong></td>
                </tr>
            </tfoot>
            <tfoot class="ab-desktop-version">
                <tr>
                    <td colspan="4"><strong><?php _e( 'Total', 'bookly' ) ?>:</strong></td>
                    <td class="ab-rtext"><strong class="ab-total-price "><?php echo AB_Utils::formatPrice( $total ) ?></strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="ab-row-fluid ab-nav-steps ab-clear">
    <button class="ab-left ab-back-step ab-btn ladda-button" data-style="zoom-in" data-spinner-size="40">
        <span class="ladda-label"><?php echo AB_Utils::getTranslatedOption( 'ab_appearance_text_button_back' ) ?></span>
    </button>
    <button class="ab-right ab-next-step ab-btn ladda-button" data-style="zoom-in" data-spinner-size="40">
        <span class="ladda-label"><?php echo AB_Utils::getTranslatedOption( 'ab_appearance_text_button_next' ) ?></span>
    </button>
</div>