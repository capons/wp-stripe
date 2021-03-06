<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php if ( ! empty( $service_collection ) ) : ?>
    <table id="services_list" class="table table-striped" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 0">
        <thead>
            <tr>
                <th></th>
                <th class="first">&nbsp;</th>
                <th width="150"><?php _e( 'Title', 'bookly' ) ?></th>
                <th width="80"><?php _e( 'Duration', 'bookly' ) ?></th>
                <th width="80"><?php _e( 'Price', 'bookly' ) ?></th>
                <th width="140"><?php _e( 'Capacity', 'bookly' ) ?>
                    <img title="" data-original-title="" src="<?php echo plugins_url( 'backend/resources/images/help.png', AB_PATH . '/main.php' ) ?>" alt="" class="ab-popover" data-content="<?php echo esc_attr( __( 'The maximum number of customers allowed to book the service for the certain time period.', 'bookly' ) ) ?>" style="width:16px;margin-left:0;"></th>
                <th><?php _e( 'Staff', 'bookly' ) ?></th>
                <th><?php _e( 'Category', 'bookly' ) ?></th>
                <th class="last">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ( $service_collection as $i => $service ) {
                $row_class  = 'service-row ';
                if ( 0 == $i ) {
                    $row_class .= 'first';
                }
                if ( ! isset( $service_collection[$i + 1] ) ) {
                    $row_class .= 'last';
                }
                include 'list_item.php';
            }
        ?>
        </tbody>
    </table>

<?php endif ?>