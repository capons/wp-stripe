<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class AB_BookingController
 */
class AB_BookingController extends AB_Controller
{
    private $info_text_codes = array();

    protected function getPermissions()
    {
        return array( '_this' => 'anonymous' );
    }

    /**
     * Render Bookly shortcode.
     *
     * @param $attributes
     * @return string
     */
    public function renderShortCode( $attributes )
    {
        global $sitepress;

        $assets = '';

        if ( get_option( 'ab_settings_link_assets_method' ) == 'print' ) {
            $this->print_assets = ! wp_script_is( 'bookly', 'done' );
            if ( $this->print_assets ) {
                ob_start();

                // The styles and scripts are registered in AB_Frontend.php
                wp_print_styles( 'ab-reset' );
                wp_print_styles( 'ab-picker-date' );
                wp_print_styles( 'ab-picker-classic-date' );
                wp_print_styles( 'ab-picker' );
                wp_print_styles( 'ab-ladda-themeless' );
                wp_print_styles( 'ab-ladda-min' );
                wp_print_styles( 'ab-main' );
                wp_print_styles( 'ab-columnizer' );
                wp_print_styles( 'ab-intlTelInput' );

                wp_print_scripts( 'ab-spin' );
                wp_print_scripts( 'ab-ladda' );
                wp_print_scripts( 'ab-picker' );
                wp_print_scripts( 'ab-picker-date' );
                wp_print_scripts( 'ab-hammer' );
                wp_print_scripts( 'ab-jq-hammer' );
                wp_print_scripts( 'ab-intlTelInput' );
                // Android animation.
                if ( stripos( strtolower( $_SERVER['HTTP_USER_AGENT'] ), 'android' ) !== false ) {
                    wp_print_scripts( 'ab-jquery-animate-enhanced' );
                }
                wp_print_scripts( 'bookly' );

                $assets = ob_get_clean();
            }
        } else {
            $this->print_assets = true; // to print CSS in template.
        }

        // Find bookings with any of payment statuses ( PayPal, 2Checkout, PayU Latam ).
        $status = array ( 'booking' => 'ok' );
        $this->form_id = uniqid();
        if ( isset ( $_SESSION['bookly'] ) ) {
            foreach ( $_SESSION['bookly'] as $form_id => $data ) {
                if ( isset( $data['payment'] ) ) {
                    if ( ! isset ( $data['payment']['processed'] ) ) {
                        switch ( $data['payment']['status'] ) {
                            case 'success':
                            case 'processing':
                                $this->form_id = $form_id;
                                $status['booking'] = 'finished';
                                break;
                            case 'cancelled':
                            case 'error':
                                $this->form_id = $form_id;
                                $status['booking']  = 'cancelled';
                                end( $data['data']['cart'] );
                                $status['cart_key'] = key( $data['data']['cart'] );
                                break;
                        }
                        // Mark this form as processed for cases when there are more than 1 booking form on the page.
                        $_SESSION['bookly'][ $form_id ]['payment']['processed'] = true;
                    }
                } else {
                    unset ( $_SESSION['bookly'][ $form_id ] );
                }
            }
        }

        // Handle shortcode attributes.
        $hide_date_and_time = (bool) @$attributes['hide_date_and_time'];
        $fields_to_hide  = isset ( $attributes['hide'] ) ? explode( ',', $attributes['hide'] ) : array();
        $this->attrs = array(
            'category_id'            => (int) @$attributes['category_id'],
            'service_id'             => (int) @$attributes['service_id'],
            'staff_member_id'        => (int) @$attributes['staff_member_id'],
            'hide_categories'        => in_array( 'categories',    $fields_to_hide ) ? true : (bool) @$attributes['hide_categories'],
            'hide_services'          => in_array( 'services',      $fields_to_hide ) ? true : (bool) @$attributes['hide_services'],
            'hide_staff_members'     => in_array( 'staff_members', $fields_to_hide ) ? true : (bool) @$attributes['hide_staff_members'],
            'hide_date'              => $hide_date_and_time ? true : in_array( 'date',       $fields_to_hide ),
            'hide_week_days'         => $hide_date_and_time ? true : in_array( 'week_days',  $fields_to_hide ),
            'hide_time_range'        => $hide_date_and_time ? true : in_array( 'time_range', $fields_to_hide ),
            'show_number_of_persons' => (bool) @$attributes['show_number_of_persons'],
        );
        $this->skip_service_step = ( ! $this->attrs['show_number_of_persons'] &&
            $this->attrs['hide_categories'] &&
            $this->attrs['hide_services'] &&
            $this->attrs['service_id'] &&
            $this->attrs['hide_staff_members'] &&
            $this->attrs['hide_date'] &&
            $this->attrs['hide_week_days'] &&
            $this->attrs['hide_time_range']
        );
        if ( $this->skip_service_step ) {
            // Store attributes in session for later use in Time step.
            $_SESSION['bookly'][ $this->form_id ]['attrs'] = $this->attrs;
        }

        // Prepare URL for AJAX requests.
        $this->ajax_url = admin_url( 'admin-ajax.php' );
        // Support WPML.
        if ( $sitepress instanceof SitePress ) {
            switch ( $sitepress->get_setting( 'language_negotiation_type' ) ) {
                case 1: // url: /de             Different languages in directories.
                    $this->ajax_url .= '/' . $sitepress->get_current_language();
                    break;
                case 2: // url: de.example.com  A different domain per language. Not available for Multisite
                    break;
                case 3: // url: ?lang=de        Language name added as a parameter.
                    $this->ajax_url .= '?lang=' . $sitepress->get_current_language();
                    break;
            }
        }

        return $assets . $this->render( 'short_code', array( 'status' => $status ), false );
    }

    /**
     * 1. Step service.
     *
     * @return string JSON
     */
    public function executeRenderService()
    {
        $response = null;
        $form_id  = $this->getParameter( 'form_id' );

        if ( $form_id ) {
            $userData = new AB_UserBookingData( $form_id );
            $userData->load();

            if ( $this->hasParameter( 'cart_key') ) {
                $userData->setCartKey( $this->getParameter( 'cart_key' ) );
            } else {
                $userData->addEmptyCartItem();
            }

            if ( get_option( 'ab_settings_use_client_time_zone' ) ) {
                $time_zone_offset = $this->getParameter( 'time_zone_offset' );
                $userData->fillData( array(
                    'time_zone_offset' => $time_zone_offset,
                    'date_from' => date( 'Y-m-d', current_time( 'timestamp' ) + AB_Config::getMinimumTimePriorBooking() - ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS + $time_zone_offset * 60 ) )
                ) );
            }

            $this->_prepareProgressTracker( 1, $userData );
            $this->info_text = $this->_prepareInfoText( 1, AB_Utils::getTranslatedOption( 'ab_appearance_text_info_service_step' ), $userData );

            // Available days and times.
            $days_times = AB_Config::getDaysAndTimes( $userData->get( 'time_zone_offset' ) );
            // Prepare week days that need to be checked.
            $days_checked = $userData->get( 'days' );
            if ( empty( $days_checked ) ) {
                // Check all available days.
                $days_checked = array_keys( $days_times['days'] );
            }
            $bounding = AB_Config::getBoundingDaysForPickadate( $userData->get( 'time_zone_offset' ) );
            $casest   = AB_Config::getCaSeSt();

            $response = array(
                'success'    => true,
                'html'       => $this->render( '1_service', array(
                    'userData'      => $userData,
                    'days'          => $days_times['days'],
                    'times'         => $days_times['times'],
                    'days_checked'  => $days_checked,
                    'show_cart_btn' => $this->_showCartButton( $userData->get( 'cart' ) )
                ), false ),
                'categories' => $casest['categories'],
                'staff'      => $casest['staff'],
                'services'   => $casest['services'],
                'date_max'   => $bounding['date_max'],
                'date_min'   => $bounding['date_min'],
                'cart_key'   => $userData->getCartKey(),
                'attributes' => $userData->get( 'service_id' )
                    ? array(
                        'service_id'        => $userData->get( 'service_id' ),
                        'staff_member_id'   => $userData->getInitialStaffId(),
                        'number_of_persons' => $userData->get( 'number_of_persons' ),
                    )
                    : null
            );
        } else {
            $response = array( 'success' => false, 'error' => __( 'Form ID error.', 'bookly' ) );
        }

        // Output JSON response.
        wp_send_json( $response );
    }

    /**
     * 2. Step time.
     *
     * @return string JSON
     */
    public function executeRenderTime()
    {
        $response = null;
        $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );

        if ( $userData->load() || ! $this->hasParameter( 'cart_key') ) {
            if ( $this->hasParameter( 'cart_key') ) {
                $userData->setCartKey( $this->getParameter( 'cart_key' ) );
            } else {
                // If cart_key is not present then Service step is skipped.
                $this->_addCartItemForSkippedServiceStep( $userData );
            }
            $availableTime = new AB_AvailableTime( $userData );
            if ( $this->hasParameter( 'selected_date' ) ) {
                $availableTime->setSelectedDate( $this->getParameter( 'selected_date' ) );
            } else {
                $availableTime->setSelectedDate( $userData->get( 'date_from' ) );
            }
            $availableTime->load();

            $this->_prepareProgressTracker( 2, $userData );
            $this->info_text = $this->_prepareInfoText( 2, AB_Utils::getTranslatedOption( 'ab_appearance_text_info_time_step' ), $userData );

            // Render slots by groups (day or month).
            $slots = array();
            foreach ( $availableTime->getSlots() as $group => $group_slots ) {
                $slots[ $group ] = preg_replace( '/>\s+</', '><', $this->render( '_time_slots', array(
                     'group' => $group,
                     'slots' => $group_slots,
                     'is_all_day_service' => $availableTime->isAllDayService(),
                ), false ) );
            }

            // Set response.
            $response = array(
                'success'        => true,
                'has_slots'      => ! empty ( $slots ),
                'has_more_slots' => $availableTime->hasMoreSlots(),
                'day_one_column' => AB_Config::showDayPerColumn(),
                'slots'          => $slots,
                'selected_slot'  => $userData->get( 'appointment_datetime' ),
                'cart_key'       => $userData->getCartKey(),
                'html'           => $this->render( '2_time', array(
                    'date'          => AB_Config::showCalendar() ? $availableTime->getSelectedDateForPickadate() : null,
                    'has_slots'     => ! empty ( $slots ),
                    'show_cart_btn' => $this->_showCartButton( $userData->get( 'cart' ) )
                ), false ),
            );

            if ( AB_Config::showCalendar() ) {
                $bounding = AB_Config::getBoundingDaysForPickadate( $userData->get( 'time_zone_offset' ) );
                $response['date_max'] = $bounding['date_max'];
                $response['date_min'] = $bounding['date_min'];
                $response['disabled_days'] = $availableTime->getDisabledDaysForPickadate();
            }
        } else {
            $response = array( 'success' => false, 'error' => __( 'Session error.', 'bookly' ) );
        }

        // Output JSON response.
        wp_send_json( $response );
    }

    public function executeRenderNextTime()
    {
        $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );

        if ( $userData->load() ) {
            $userData->setCartKey( $this->getParameter( 'cart_key' ) );
            $availableTime = new AB_AvailableTime( $userData );
            $availableTime->setLastFetchedSlot( $this->getParameter( 'last_slot' ) );
            $availableTime->load();

            $html = '';
            foreach ( $availableTime->getSlots() as $group => $group_slots ) {
                $html .= $this->render( '_time_slots', array(
                    'group' => $group,
                    'slots' => $group_slots,
                    'is_all_day_service' => $availableTime->isAllDayService(),
                ), false );
            }

            // Set response.
            $response = array(
                'success'        => true,
                'html'           => preg_replace( '/>\s+</', '><', $html ),
                'has_slots'      => $html != '',
                'has_more_slots' => $availableTime->hasMoreSlots(), // show/hide the next button
                'selected_slot'  => $userData->get( 'appointment_datetime' )
            );
        } else {
            $response = array( 'success' => false, 'error' => __( 'Session error.', 'bookly' ) );
        }

        // Output JSON response.
        wp_send_json( $response );
    }

    /**
     * 3. Step cart.
     */
    public function executeRenderCart()
    {
        $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );

        if ( $userData->load() ) {
            $userData->dropIncompleteCartItems();

            $this->_prepareProgressTracker( 3, $userData );
            $this->info_text = $this->_prepareInfoText( 3, AB_Utils::getTranslatedOption( 'ab_appearance_text_info_cart_step' ), $userData );
            $cart_items = array();
            $use_client_time_zone = get_option( 'ab_settings_use_client_time_zone' );
            $userData->foreachCartItem( function ( AB_UserBookingData $userData, $cart_key ) use ( &$cart_items, $use_client_time_zone ) {
                if ( $use_client_time_zone ) {
                    $appointment_datetime = AB_DateTimeUtils::formatTime(
                        AB_DateTimeUtils::applyTimeZoneOffset(
                            $userData->get( 'appointment_datetime' ), $userData->get( 'time_zone_offset' )
                        )
                    );
                } else {
                    $appointment_datetime = $userData->get( 'appointment_datetime' );
                }
                $cart_items[ $cart_key ] = array(
                    'appointment_datetime' => $appointment_datetime,
                    'number_of_persons'    => $userData->get( 'number_of_persons' ),
                    'service_title' => $userData->getCartService()->getTitle(),
                    'staff_name'    => $userData->getCartStaffName(),
                    'column_price'  => ( $userData->get( 'number_of_persons' ) > 1 ? $userData->get( 'number_of_persons' ) . ' &times; ' : '' ) . AB_Utils::formatPrice( $userData->getCartServicePrice() )
                );
            } );

            $cart_info = $userData->getCartInfo( false );   // without coupon

            $response = array(
                'success' => true,
                'html'    => $this->render( '3_cart', array(
                    'cart_items' => $cart_items,
                    'total'      => $cart_info['total_price'],
                ), false )
            );
        } else {
            $response = array( 'success' => false, 'error' => __( 'Session error.', 'bookly' ) );
        }

        // Output JSON response.
        wp_send_json( $response );
    }

    /**
     * 4. Step details.
     *
     * @return string JSON
     */
    public function executeRenderDetails()
    {
        $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );

        if ( $userData->load() ) {
            $userData->setCartKey( $this->getParameter( 'cart_key' ) );
            // Prepare custom fields data.
            $cf_data = array();
            $custom_fields = $userData->get( 'custom_fields' );
            if ( $custom_fields !== null ) {
                foreach ( json_decode( $custom_fields, true ) as $field ) {
                    $cf_data[ $field['id'] ] = $field['value'];
                }
            }

            $this->_prepareProgressTracker( 4, $userData );
            $this->info_text = $this->_prepareInfoText( 4, AB_Utils::getTranslatedOption( 'ab_appearance_text_info_details_step' ), $userData );
            $this->info_text_guest = ( get_current_user_id() == 0 ) ? $this->_prepareInfoText( 3, AB_Utils::getTranslatedOption( 'ab_appearance_text_info_details_step_guest' ), $userData ) : '';
            if ( strpos( get_option( 'ab_custom_fields' ), '"captcha"' ) !== false ) {
                // Init Captcha.
                AB_Captcha::init( $this->getParameter( 'form_id' ) );
            }
            $response = array(
                'success'  => true,
                'html'     => $this->render( '4_details', array(
                    'userData'      => $userData,
                    'custom_fields' => AB_Utils::getTranslatedCustomFields( get_option( 'ab_custom_fields_per_service' ) ? $userData->getCartService()->get( 'id' ) : null ),
                    'cf_data'       => $cf_data,
                    'show_cart_btn' => get_option( 'ab_custom_fields_per_service' ) == 1 ? $this->_showCartButton( $userData->get( 'cart' ) ) : false,
                    'captcha_url'   => admin_url( 'admin-ajax.php?action=ab_captcha&form_id=' . $this->getParameter( 'form_id' ) . '&' . microtime( true ) )
                ), false )
            );
        } else {
            $response = array( 'success' => false, 'error' => __( 'Session error.', 'bookly' ) );
        }

        // Output JSON response.
        wp_send_json( $response );
    }

    /**
     * 5. Step payment.
     *
     * @return string JSON
     */
    public function executeRenderPayment()
    {
        $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );

        if ( $userData->load() ) {
            $payment_disabled = AB_Config::isPaymentDisabled();

            $cart_info = $userData->getCartInfo();
            if ( $cart_info['total_price'] <= 0 ) {
                $payment_disabled = true;
            }

            if ( $payment_disabled == false ) {
                $this->form_id   = $this->getParameter( 'form_id' );
                $this->_prepareProgressTracker( 5, $userData );
                $this->info_text = $this->_prepareInfoText( 5, AB_Utils::getTranslatedOption( 'ab_appearance_text_info_payment_step' ), $userData );
                $this->info_text_coupon = $this->_prepareInfoText( 5, AB_Utils::getTranslatedOption( 'ab_appearance_text_info_coupon' ), $userData );

                // Set response.
                $response = array(
                    'success'  => true,
                    'disabled' => false,
                    'html'     => $this->render( '5_payment', array(
                        'coupon_code'        => $userData->get( 'coupon' ),
                        'payment_status'     => $userData->extractPaymentStatus(),
                        'pay_local'          => get_option( 'ab_settings_pay_locally' ) != 'disabled',
                        'pay_paypal'         => get_option( 'ab_paypal_type' ) != 'disabled',
                        'pay_stripe'         => get_option( 'ab_stripe' ) != 'disabled',
                        'pay_2checkout'      => get_option( 'ab_2checkout' ) != 'disabled',
                        'pay_authorizenet'   => get_option( 'ab_authorizenet_type' ) != 'disabled',
                        'pay_payulatam'      => get_option( 'ab_payulatam' ) != 'disabled',
                        'pay_payson'         => get_option( 'ab_payson' ) != 'disabled',
                    ), false )
                );
            } else {
                $response = array(
                    'success'  => true,
                    'disabled' => true,
                );
            }
        } else {
            $response = array( 'success' => false, 'error' => __( 'Session error.', 'bookly' ) );
        }

        // Output JSON response.
        wp_send_json( $response );
    }

    /**
     * 6. Step done ( complete ).
     *
     * @return string JSON
     */
    public function executeRenderComplete()
    {
        $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );

        if ( $userData->load() ) {
            $this->_prepareProgressTracker( 6, $userData );
            $success_html = $this->progress_tracker;
            $payment =  $userData->extractPaymentStatus();
            switch ( $payment['status'] ) {
                case 'processing':
                    $success_html .= $this->_prepareInfoText( 6, __( 'Your payment has been accepted for processing.', 'bookly' ), $userData );
                    break;
                default:
                    $success_html .= $this->_prepareInfoText( 6, AB_Utils::getTranslatedOption( 'ab_appearance_text_info_complete_step' ), $userData );
                    break;
            }

            $response = array (
                'success' => true,
                'html'    => array (
                    'success' => $success_html,
                    'error'   => __( 'The selected time is not available anymore. Please, choose another time slot.', 'bookly' )
                ),
                'final_step_url' => get_option( 'ab_settings_final_step_url' )
            );
        } else {
            $response = array( 'success' => false, 'error' => __( 'Session error.', 'bookly' ) );
        }

        // Output JSON response.
        wp_send_json( $response );
    }

    /**
     * Save booking data in session.
     */
    public function executeSessionSave()
    {
        $form_id = $this->getParameter( 'form_id' );
        $errors  = array();
        if ( $form_id ) {
            $userData = new AB_UserBookingData( $form_id );
            $userData->load();
            $userData->setCartKey( $this->getParameter( 'cart_key' ) );
            $parameters = $this->getParameters();
            $errors = $userData->validate( $parameters );
            if ( empty ( $errors ) ) {
                // Remove captcha from custom fields.
                if ( isset( $parameters['custom_fields'] ) && isset( $parameters['captcha_id'] ) ) {
                    $parameters['custom_fields'] = json_encode( array_filter( json_decode( $parameters['custom_fields'] ), function ( $value ) use ( $parameters ) {
                        return $value->id != $parameters['captcha_id'];
                    } ) );
                }

                $userData->fillData( $parameters );
                if ( isset( $parameters['custom_fields'] ) && get_option( 'ab_custom_fields_per_service' ) != 1 ) {
                    $custom_fields = $parameters['custom_fields'];
                    $userData->foreachCartItem( function ( AB_UserBookingData $userData, $cart_key ) use ( $custom_fields ) {
                        $userData->setCartKey( $cart_key );
                        $userData->set( 'custom_fields', $custom_fields );
                    } );
                }
            }
        }

        // Output JSON response.
        wp_send_json( $errors );
    }

    /**
     * Save cart appointments.
     */
    public function executeSaveAppointment()
    {
        $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );

        if ( $userData->load() ) {
            $success = false;
            $failed_cart_key = $userData->getFailedCartKey();
            if ( $failed_cart_key === null ) {
                $cart_info = $userData->getCartInfo();
                $coupon    = $userData->getCoupon();
                $is_payment_disabled    = AB_Config::isPaymentDisabled();
                $is_pay_locally_enabled = AB_Config::isPayLocallyEnabled();
                if ( $is_payment_disabled || $is_pay_locally_enabled || $cart_info['total_price'] <= 0 ) {
                    $success = true;
                    foreach ( $userData->get( 'cart' ) as $cart_key => $cart_item ) {
                        $userData->setCartKey( $cart_key );
                        // Create appointment.
                        $customer_appointment = $userData->save();
                        if ( ! $is_payment_disabled ) {
                            // Create payment record.
                            $payment = new AB_Payment();
                            $total_appointment_price = $cart_info['items'][ $cart_key ]['total_price'];
                            if ( $coupon && $total_appointment_price <= 0 ) {
                                // Create fake payment record for 100% discount coupons.
                                $payment->set( 'total', '0.00' );
                                $payment->set( 'type',  AB_Payment::TYPE_COUPON );

                            } elseif ( $is_pay_locally_enabled && $total_appointment_price > 0 ) {
                                // Create record for local payment.
                                $payment->set( 'total', $total_appointment_price );
                                $payment->set( 'type',  AB_Payment::TYPE_LOCAL );
                            }
                            $payment->set( 'customer_appointment_id', $customer_appointment->get( 'id' ) );
                            $payment->set( 'created', current_time( 'mysql' ) );
                            $payment->set( 'status',  AB_Payment::STATUS_COMPLETED );
                            $payment->save();
                        }
                    }
                }
            }

            if ( $success ) {
                $response = array( 'success' => true );
            } else {
                $response = array(
                    'success' => false,
                    'failed_cart_key' => $failed_cart_key,
                    'error' => get_option( 'ab_settings_cart_enabled' )
                        ? __( 'The highlighted time is not available anymore. Please, choose another time slot.', 'bookly' )
                        : __( 'The selected time is not available anymore. Please, choose another time slot.', 'bookly' )
                );
            }
        } else {
            $response = array( 'success' => false, 'error' => __( 'Session error.', 'bookly' ) );
        }

        wp_send_json( $response );
    }

    /**
     * Save cart items as pending appointments.
     */
    public function executeSavePendingAppointment()
    {
        // List of gateways valid for this action.
        $valid_gateways = array(
            AB_Payment::TYPE_PAYULATAM
        );

        $gateway = $this->getParameter( 'gateway' );

        if ( in_array( $gateway, $valid_gateways ) && get_option( 'ab_' . $gateway ) ) {
            $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );
            if ( $userData->load() ) {
                $ca_ids          = array();  // customer_appointment ids
                $failed_cart_key = $userData->getFailedCartKey();
                $cart_info       = $userData->getCartInfo();
                if ( $failed_cart_key === null ) {
                    foreach ( $userData->get( 'cart' ) as $cart_key => $cart_item ) {
                        $userData->setCartKey( $cart_key );
                        // Create appointment.
                        $customer_appointment = $userData->save( false );
                        // Create payment record.
                        $payment = new AB_Payment();
                        $payment->set( 'customer_appointment_id', $customer_appointment->get( 'id' ) );
                        $payment->set( 'created', current_time( 'mysql' ) );
                        $payment->set( 'total',   $cart_info['items'][ $cart_key ]['total_price'] );
                        $payment->set( 'type',    $this->getParameter( 'gateway' ) );
                        $payment->set( 'status',  AB_Payment::STATUS_PENDING );
                        $payment->save();
                        $ca_ids[] = $customer_appointment->get( 'id' );
                    }
                    $response = array(
                        'success' => true,
                        'ca_ids'  => implode( ',', $ca_ids )
                    );
                } else {
                    $response = array(
                        'success' => false,
                        'failed_cart_key' => $failed_cart_key,
                        'error' => get_option( 'ab_settings_cart_enabled' )
                            ? __( 'The highlighted time is not available anymore. Please, choose another time slot.', 'bookly' )
                            : __( 'The selected time is not available anymore. Please, choose another time slot.', 'bookly' )
                    );
                }
            } else {
                $response = array( 'success' => false, 'error' => __( 'Session error.', 'bookly' ) );
            }
        } else {
            $response = array( 'success' => false, 'error' => __( 'Invalid gateway.', 'bookly' ) );
        }

        wp_send_json( $response );
    }

    public function executeCheckCart()
    {
        $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );

        if ( $userData->load() ) {
            $failed_cart_key = $userData->getFailedCartKey();
            if ( $failed_cart_key === null ) {
                $response = array( 'success' => true );
            } else {
                $response = array(
                    'success' => false,
                    'failed_cart_key' => $failed_cart_key,
                    'error' => get_option( 'ab_settings_cart_enabled' )
                        ? __( 'The highlighted time is not available anymore. Please, choose another time slot.', 'bookly' )
                        : __( 'The selected time is not available anymore. Please, choose another time slot.', 'bookly' )
                );
            }
        } else {
            $response = array( 'success' => false, 'error' => __( 'Invalid gateway.', 'bookly' ) );
        }

        wp_send_json( $response );
    }

    /**
     * Cancel Appointment using token.
     */
    public function executeCancelAppointment()
    {
        $customer_appointment = new AB_CustomerAppointment();

        if ( $customer_appointment->loadBy( array( 'token' => $this->getParameter( 'token' ) ) ) ) {
            $allow_cancel = true;
            $minimum_time_prior_cancel = (int) get_option( 'ab_settings_minimum_time_prior_cancel', 0 );
            if ( $minimum_time_prior_cancel > 0 ) {
                $appointment = new AB_Appointment();
                if ( $appointment->load( $customer_appointment->get( 'appointment_id' ) ) ) {
                    $allow_cancel_time = strtotime( $appointment->get( 'start_date' ) ) - $minimum_time_prior_cancel * HOUR_IN_SECONDS;
                    if ( current_time( 'timestamp' ) > $allow_cancel_time ) {
                        $allow_cancel = false;
                    }
                }
            }

            if ( $allow_cancel ) {
                // Send email.
                AB_NotificationSender::send( AB_NotificationSender::INSTANT_CANCELLED_APPOINTMENT, $customer_appointment );

                $customer_appointment->deleteCascade();
            }

            if ( $this->url = $allow_cancel ? get_option( 'ab_settings_cancel_page_url' ) : get_option( 'ab_settings_cancel_denied_page_url' ) ) {
                wp_redirect( $this->url );
                $this->render( 'cancel_appointment' );
                exit;
            }
        }

        $this->url = home_url();
        if ( isset ( $_SERVER['HTTP_REFERER'] ) ) {
            if ( parse_url( $_SERVER['HTTP_REFERER'], PHP_URL_HOST ) == parse_url( $this->url, PHP_URL_HOST ) ) {
                // Redirect back if user came from our site.
                $this->url = $_SERVER['HTTP_REFERER'];
            }
        }
        wp_redirect( $this->url );
        $this->render( 'cancel_appointment' );
        exit;
    }

    /**
     * Apply coupon
     */
    public function executeApplyCoupon()
    {
        if ( ! get_option( 'ab_settings_coupons' ) ) {
            wp_send_json_error();
        }

        $response = null;
        $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );

        if ( $userData->load() ) {
            $coupon_code = $this->getParameter( 'coupon' );

            $coupon = new AB_Coupon();
            $coupon->loadBy( array(
                'code' => $coupon_code,
            ) );

            if ( $coupon->isLoaded() && $coupon->get( 'used' ) < $coupon->get( 'usage_limit' ) ) {
                $userData->fillData( array( 'coupon' => $coupon_code ) );
                $cart_info = $userData->getCartInfo();
                $response = array(
                    'success' => true,
                    'state'   => 'applied',
                    'text'    => $this->_prepareInfoText( 5, AB_Utils::getTranslatedOption( 'ab_appearance_text_info_coupon' ), $userData ),
                    'total'   => $cart_info['total_price']
                );
            } else {
                $userData->fillData( array( 'coupon' => null ) );
                $response = array(
                    'success' => true,
                    'state'   => 'invalid',
                    'error'   => __( 'This coupon code is invalid or has been used', 'bookly' ),
                    'text'    => $this->_prepareInfoText( 5, AB_Utils::getTranslatedOption( 'ab_appearance_text_info_coupon' ), $userData )
                );
            }
        } else {
            $response = array( 'success' => false, 'error' => __( 'Session error.', 'bookly' ) );
        }

        // Output JSON response.
        wp_send_json( $response );
    }

    /**
     * Log in to WordPress in the Details step.
     */
    public function executeWpUserLogin()
    {
        /** @var WP_User $user */
        $user = wp_signon();
        if ( is_wp_error( $user ) ) {
            wp_send_json_error( array( 'message' => __( 'Incorrect username or password.' ) ) );
        } else {
            $customer = new AB_Customer();
            if ( $customer->loadBy( array( 'wp_user_id' => $user->ID ) ) ) {
                $user_info = array(
                    'name'  => $customer->get( 'name' ),
                    'email' => $customer->get( 'email' ),
                    'phone' => $customer->get( 'phone' )
                );
            } else {
                $user_info  = array(
                    'name'  => $user->display_name,
                    'email' => $user->user_email
                );
            }
            $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );
            $userData->load();
            $userData->fillData( $user_info );
            wp_send_json_success( $user_info );
        }
    }


    public function executeCartDropAppointment()
    {
        $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );
        $total_price = 0;
        if ( $userData->load() ) {
            $userData->dropCartItem( $this->getParameter( 'cart_key' ) );
            $cart_info   = $userData->getCartInfo();
            $total_price = $cart_info['total_price'];
        }
        wp_send_json_success( array( 'total_price' => AB_Utils::formatPrice( $total_price ) ) );
    }

    /**
     * Get info for IP.
     */
    public function executeIpInfo()
    {
        $curl = new AB_Curl();
        $curl->options['CURLOPT_CONNECTTIMEOUT'] = 8;
        $curl->options['CURLOPT_TIMEOUT']        = 10;
        if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '';
        }
        @header( 'Content-Type: application/json; charset=UTF-8' );
        echo $curl->get( 'http://ipinfo.io/' . $ip .'/json' );
        wp_die();
    }

    /**
     * Output a PNG image of captcha to browser.
     */
    public function executeCaptcha()
    {
        AB_Captcha::draw( $this->getParameter( 'form_id' ) );
    }

    public function executeCaptchaRefresh()
    {
        AB_Captcha::init( $this->getParameter( 'form_id' ) );
        wp_send_json_success( array( 'captcha_url' => admin_url( 'admin-ajax.php?action=ab_captcha&form_id=' . $this->getParameter( 'form_id' ) . '&' . microtime( true ) ) ) );
    }

    /**
     * Render progress tracker into a variable.
     *
     * @param int $booking_step
     * @param AB_UserBookingData $userData
     */
    private function _prepareProgressTracker( $booking_step, AB_UserBookingData $userData )
    {
        if ( get_option( 'ab_appearance_show_progress_tracker' ) ) {
            $payment_disabled = AB_Config::isPaymentDisabled();
            if ( ! $payment_disabled ) {
                // Assume that payment is disabled and check all cart items. If one is incomplete or its price is more
                // than zero then the payment step should be displayed.
                $payment_disabled = true;
                $userData->foreachCartItem( function ( AB_UserBookingData $userData ) use ( &$payment_disabled ) {
                    $initial_service_price = $userData->getInitialServicePrice();
                    if ( $initial_service_price === false && ! $userData->get( 'staff_id' )
                        || $initial_service_price > 0
                        || $userData->getCartServicePrice() > 0
                    ) {
                        $payment_disabled = false;
                        return false;
                    };
                } );
            }

            $this->progress_tracker = $this->render( '_progress_tracker', array(
                'booking_step'      => $booking_step ,
                'payment_disabled'  => $payment_disabled,
                'show_cart' => get_option( 'ab_settings_cart_enabled' ) &&
                    ( get_option( 'ab_woocommerce_enabled' )
                      && get_option( 'ab_woocommerce_product' )
                      && class_exists( 'WooCommerce' )
                      && WC()->cart->get_cart_url() !== false
                    ) === false,
                'skip_service_step' => isset ( $_SESSION['bookly'][ $this->getParameter( 'form_id' ) ]['attrs'] )
            ), false );
        } else {
            $this->progress_tracker = '';
        }
    }

    /**
     * Render info text into a variable.
     *
     * @param integer            $step
     * @param string             $text
     * @param AB_UserBookingData $userData
     * @return string
     */
    private function _prepareInfoText( $step, $text, $userData )
    {
        if ( empty ( $this->info_text_codes ) ) {
            if ( $step == 1 ) {
                // No replacements.
            } elseif ( $step == 2 || ( get_option( 'ab_custom_fields_per_service' ) && $step == 4 ) ) {
                if ( $step == 2 ) {
                    $service_price = $userData->getInitialServicePrice();
                    $staff_name    = $userData->getInitialStaffName();
                    $staff_info    = '';
                } else {    // Step Details before Cart.
                    $service_price = $userData->getCartService()->get( 'price' );
                    $staff_name    = $userData->getCartStaffName();
                    $staff_info    = $userData->getCartStaffInfo();
                }
                $service           = $userData->getCartService();
                $number_of_persons = $userData->get( 'number_of_persons' );
                if ( get_option( 'ab_settings_use_client_time_zone' ) ) {
                    $service_time  = AB_DateTimeUtils::formatTime(
                        AB_DateTimeUtils::applyTimeZoneOffset(
                            $userData->get( 'appointment_datetime' ), $userData->get( 'time_zone_offset' )
                        )
                    );
                } else {
                    $service_time  = AB_DateTimeUtils::formatTime( $userData->get( 'appointment_datetime' ) );
                }

                $this->info_text_codes = array(
                    '[[STAFF_NAME]]'        => '<b>' . $staff_name . '</b>',
                    '[[STAFF_INFO]]'        => '<b>' . $staff_info . '</b>',
                    '[[SERVICE_NAME]]'      => '<b>' . $service->getTitle() . '</b>',
                    '[[CATEGORY_NAME]]'     => '<b>' . $service->getCategoryName() . '</b>',
                    '[[NUMBER_OF_PERSONS]]' => '<b>' . $number_of_persons . '</b>',
                    '[[SERVICE_TIME]]'      => '<b>' . $service_time . '</b>',
                    '[[SERVICE_DATE]]'      => '<b>' . AB_DateTimeUtils::formatDate( $userData->get( 'appointment_datetime' ) ) . '</b>',
                    '[[SERVICE_PRICE]]'     => '<b>' . ( $service_price !== false ? AB_Utils::formatPrice( $service_price ) : '' ) . '</b>',
                    '[[TOTAL_PRICE]]'       => '<b>' . ( $service_price !== false ? AB_Utils::formatPrice( $service_price * $number_of_persons ) : '' ) . '</b>',
                    '[[LOGIN_FORM]]'        => ( get_current_user_id() == 0 ) ? $this->render( '_login_form', array(), false ) : '',
                );
            } else {
                $data = array(
                    'service'           => array(),
                    'service_name'      => array(),
                    'category_name'     => array(),
                    'staff_name'        => array(),
                    'staff_info'        => array(),
                    'service_date'      => array(),
                    'service_price'     => array(),
                    'number_of_persons' => array(),
                );
                $userData->foreachCartItem( function ( AB_UserBookingData $userData ) use ( &$data ) {
                    $service                  = $userData->getCartService();
                    $data['service_name'][]   = $service->getTitle();
                    $data['category_name'][]  = $service->getCategoryName();
                    $data['staff_name'][]     = $userData->getCartStaffName();
                    $data['staff_info'][]     = $userData->getCartStaffInfo();
                    $data['service_date'][]   = AB_DateTimeUtils::formatDate( $userData->get( 'appointment_datetime' ) );
                    $data['service_price'][]  = AB_Utils::formatPrice( $userData->getCartServicePrice() );
                    if ( get_option( 'ab_settings_use_client_time_zone' ) ) {
                        $data['service_time'][] = AB_DateTimeUtils::formatTime(
                            AB_DateTimeUtils::applyTimeZoneOffset(
                                $userData->get( 'appointment_datetime' ), $userData->get( 'time_zone_offset' )
                            )
                        );
                    } else {
                        $data['service_time'][] = AB_DateTimeUtils::formatTime( $userData->get( 'appointment_datetime' ) );
                    }
                    $data['number_of_persons'][] = $userData->get( 'number_of_persons' );
                } );

                $cart_info = $userData->getCartInfo( $step > 3 );

                $this->info_text_codes  = array(
                    '[[STAFF_NAME]]'        => '<b>' . implode( ', ', $data['staff_name'] ) . '</b>',
                    '[[STAFF_INFO]]'        => '<b>' . implode( ', ', $data['staff_info'] ) . '</b>',
                    '[[SERVICE_NAME]]'      => '<b>' . implode( ', ', $data['service_name'] ) . '</b>',
                    '[[CATEGORY_NAME]]'     => '<b>' . implode( ', ', $data['category_name'] ) . '</b>',
                    '[[NUMBER_OF_PERSONS]]' => '<b>' . implode( ', ', $data['number_of_persons'] ) . '</b>',
                    '[[SERVICE_TIME]]'      => '<b>' . implode( ', ', $data['service_time'] ) . '</b>',
                    '[[SERVICE_DATE]]'      => '<b>' . implode( ', ', $data['service_date'] ) . '</b>',
                    '[[SERVICE_PRICE]]'     => '<b>' . implode( ', ', $data['service_price'] ) . '</b>',
                    '[[TOTAL_PRICE]]'       => '<b>' . AB_Utils::formatPrice( $cart_info['total_price'] ) . '</b>',
                    '[[LOGIN_FORM]]'        => ( get_current_user_id() == 0 ) ? $this->render( '_login_form', array(), false ) : '',
                );
            }
        }

        return strtr( nl2br( $text ), $this->info_text_codes );
    }

    /**
     * Check if need show cart button.
     *
     * @param array $cart
     * @return bool
     */
    private function _showCartButton( array $cart )
    {
        if ( (bool) get_option( 'ab_settings_cart_enabled' ) ) {
            $key = ( get_option( 'ab_custom_fields_per_service' ) == 1 ) ? 'custom_fields' : 'appointment_datetime';
            // We need find in cart one item with appointment_datetime or custom_fields
            foreach ( $cart as $item ) {
                if ( isset( $item[ $key ] ) ) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Add new cart item for the skipped Service step.
     *
     * @param AB_UserBookingData $userData
     */
    private function _addCartItemForSkippedServiceStep( AB_UserBookingData $userData )
    {
        $userData->addEmptyCartItem();
        if ( get_option( 'ab_settings_use_client_time_zone' ) ) {
            $time_zone_offset = $this->getParameter( 'time_zone_offset' );
            $userData->fillData( array(
                'time_zone_offset' => $time_zone_offset,
                'date_from' => date( 'Y-m-d', current_time( 'timestamp' ) + AB_Config::getMinimumTimePriorBooking() - ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS + $time_zone_offset * 60 ) )
            ) );
        }
        // Staff ids.
        $attrs = $_SESSION['bookly'][ $this->getParameter( 'form_id' ) ]['attrs'];
        if ( $attrs['staff_member_id'] == 0 ) {
            $staff_ids = array_map( function ( $staff ) { return $staff['id']; }, AB_StaffService::query()
                ->select( 'staff_id AS id' )
                ->where( 'service_id', $attrs['service_id'] )
                ->fetchArray()
            );
        } else {
            $staff_ids = array( $attrs['staff_member_id'] );
        }
        // Days and times.
        $days_times = AB_Config::getDaysAndTimes( $userData->get( 'time_zone_offset' ) );
        $time_from  = key( $days_times['times'] );
        end( $days_times['times'] );

        $data = array(
            'service_id'        => $attrs['service_id'],
            'staff_ids'         => $staff_ids,
            'number_of_persons' => 1,
            'date_from'         => $userData->get( 'date_from' ),
            'days'              => array_keys( $days_times['days'] ),
            'time_from'         => $time_from,
            'time_to'           => key( $days_times['times'] )
        );
        $userData->fillData( $data );
    }

    /**
     * Override parent method to add 'wp_ajax_ab_' prefix
     * so current 'execute*' methods look nicer.
     *
     * @param string $prefix
     */
    protected function registerWpActions( $prefix = '' )
    {
        parent::registerWpActions( 'wp_ajax_ab_' );
        parent::registerWpActions( 'wp_ajax_nopriv_ab_' );
    }

}