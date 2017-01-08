<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class AB_2CheckoutController
 */
class AB_2CheckoutController extends AB_Controller
{
    const SIGNUP = 'https://www.2checkout.com/signup/';
    const HOME   = 'https://www.2checkout.com/';

    protected function getPermissions()
    {
        return array( '_this' => 'anonymous' );
    }

    public function approved()
    {
        $userData = new AB_UserBookingData( $this->getParameter( 'ab_fid' ) );

        if ( $userData->load() ) {
            $cart_info = $userData->getCartInfo();
            $total = number_format( $cart_info['total_price'], 2, '.', '' );
            $StringToHash = strtoupper( md5( get_option( 'ab_2checkout_api_secret_word' ) . get_option( 'ab_2checkout_api_seller_id' ) . $this->getParameter( 'order_number' ) . $total ) );
            if ( $StringToHash != $this->getParameter( 'key' ) ) {
                header( 'Location: ' . wp_sanitize_redirect( add_query_arg( array(
                        'action'    => 'ab-2checkout-error',
                        'ab_fid'    => $this->getParameter( 'ab_fid' ),
                        'error_msg' => str_replace( ' ', '%20', __( 'Invalid token provided', 'bookly' ) )
                    ), AB_Utils::getCurrentPageURL()
                ) ) );
                exit;
            } else {
                $transaction_id = $this->getParameter( 'order_number' );
                $payment = AB_Payment::query( 'p' )
                    ->select( 'p.id' )
                    ->where( 'p.type', AB_Payment::TYPE_2CHECKOUT )
                    ->where( 'transaction_id', $transaction_id )
                    ->findOne();
                if ( empty ( $payment ) ) {
                    $token = $this->getParameter( 'invoice_id' );
                    $userData->foreachCartItem( function ( AB_UserBookingData $userData, $cart_key ) use ( $cart_info, $transaction_id, $token ) {
                        $customer_appointment = $userData->save();
                        $payment = new AB_Payment();
                        $payment->set( 'customer_appointment_id', $customer_appointment->get( 'id' ) );
                        $payment->set( 'transaction_id', $transaction_id );
                        $payment->set( 'total',   $cart_info['items'][ $cart_key ]['total_price'] );
                        $payment->set( 'token',   $token );
                        $payment->set( 'created', current_time( 'mysql' ) );
                        $payment->set( 'type',    AB_Payment::TYPE_2CHECKOUT );
                        $payment->set( 'status',  AB_Payment::STATUS_COMPLETED );
                        $payment->save();
                    } );
                }

                $userData->setPaymentStatus( 'success' );

                // Clean GET parameters from 2Checkout.
                @wp_redirect( remove_query_arg( AB_2Checkout::$remove_parameters, AB_Utils::getCurrentPageURL() ) );
                exit;
            }
        } else {
            header( 'Location: ' . wp_sanitize_redirect( add_query_arg( array(
                    'action'    => 'ab-2checkout-error',
                    'ab_fid'    => $this->getParameter( 'ab_fid' ),
                    'error_msg' => str_replace( ' ', '%20', __( 'Invalid session', 'bookly' ) )
                ), AB_Utils::getCurrentPageURL()
            ) ) );
            exit;
        }
    }

    public function error()
    {
        $userData = new AB_UserBookingData( $this->getParameter( 'ab_fid' ) );
        $userData->load();
        $userData->setPaymentStatus( 'error', $this->getParameter( 'error_msg' ), AB_Payment::TYPE_2CHECKOUT );
        @wp_redirect( remove_query_arg( AB_2Checkout::$remove_parameters, AB_Utils::getCurrentPageURL() ) );
        exit;
    }

}