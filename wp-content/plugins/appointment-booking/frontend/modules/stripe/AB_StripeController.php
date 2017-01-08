<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class AB_StripeController
 */
class AB_StripeController extends AB_Controller
{
    const SIGNUP = 'https://dashboard.stripe.com/register';
    const HOME   = 'https://stripe.com/';

    protected function getPermissions()
    {
        return array( '_this' => 'anonymous' );
    }

    public function executeStripe()
    {
        $response = null;
        $userData = new AB_UserBookingData( $this->getParameter( 'form_id' ) );

        if ( $userData->load() ) {
            $failed_cart_key = $userData->getFailedCartKey();
            if ( $failed_cart_key === null ) {
                \Stripe\Stripe::setApiKey( get_option( 'ab_stripe_secret_key' ) );
                \Stripe\Stripe::setApiVersion( '2015-08-19' );

                $cart_info = $userData->getCartInfo();
                try {
                    $charge = \Stripe\Charge::create( array(
                        'amount'      => intval( $cart_info['total_price'] * 100 ), // amount in cents
                        'currency'    => get_option( 'ab_currency' ),
                        'source'      => $this->getParameter( 'card' ), // contain token or card data
                        'description' => 'Charge for ' . $userData->get( 'email' )
                    ) );

                    if ( $charge->paid ) {
                        $payment = AB_Payment::query( 'p' )
                            ->select( 'p.id' )
                            ->where( 'p.type', AB_Payment::TYPE_STRIPE )
                            ->where( 'p.transaction_id', $charge->id )
                            ->findOne();
                        if ( empty ( $payment ) ) {
                            $userData->foreachCartItem( function ( AB_UserBookingData $userData, $cart_key ) use ( $cart_info, $charge ) {
                                $customer_appointment = $userData->save();
                                $payment = new AB_Payment();
                                $payment->set( 'customer_appointment_id', $customer_appointment->get( 'id' ) );
                                $payment->set( 'transaction_id', $charge->id );
                                $payment->set( 'total',   $cart_info['items'][ $cart_key ]['total_price'] );
                                $payment->set( 'created', current_time( 'mysql' ) );
                                $payment->set( 'type',    AB_Payment::TYPE_STRIPE );
                                $payment->set( 'status',  AB_Payment::STATUS_COMPLETED );
                                $payment->save();
                            } );
                        }

                        $response = array( 'success' => true );
                    } else {
                        $response = array( 'success' => false, 'error' => __( 'Error', 'bookly' ) );
                    }
                } catch ( Exception $e ) {
                    $response = array( 'success' => false, 'error' => $e->getMessage() );
                }
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

        // Output JSON response.
        wp_send_json( $response );
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