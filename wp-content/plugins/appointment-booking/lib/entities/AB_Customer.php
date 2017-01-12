<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class AB_Customer
 */
class AB_Customer extends AB_Entity
{
    protected static $table = 'ab_customers';

    protected static $schema = array(
        'id'         => array( 'format' => '%d' ),
        'wp_user_id' => array( 'format' => '%d' ),
        'name'       => array( 'format' => '%s', 'default' => '' ),
        'phone'      => array( 'format' => '%s', 'default' => '' ),
        'email'      => array( 'format' => '%s', 'default' => '' ),
        'notes'      => array( 'format' => '%s', 'default' => '' ),
    );

    /**
     * Delete customer and associated WP user if requested.
     *
     * @param bool $with_wp_user
     * @return false|int
     */
    public function deleteWithWPUser( $with_wp_user )
    {
        if ( $with_wp_user && $this->get( 'wp_user_id' )
             // Can't delete your WP account
             && ( $this->get( 'wp_user_id' ) != get_current_user_id() ) ) {
            wp_delete_user( $this->get( 'wp_user_id' ) );
        }

        return $this->delete();
    }

    /**
     * Get upcoming appointments.
     *
     * @return array
     */
    public function getUpcomingAppointments()
    {
        return $this->_buildQueryForAppointments()
            ->whereGte( 'a.start_date', current_time( 'Y-m-d 00:00:00' ) )
            ->fetchArray();
    }

    /**
     * Get past appointments.
     *
     * @param $page
     * @param $limit
     * @return array
     */
    public function getPastAppointments( $page, $limit )
    {
        $result = array( 'more' => true, 'appointments' => array() );

        $records = $this->_buildQueryForAppointments()
            ->whereLt( 'a.start_date', current_time( 'Y-m-d 00:00:00' ) )
            ->limit( $limit + 1 )
            ->offset( ( $page - 1 ) * $limit )
            ->fetchArray();

        $result['more'] = count( $records ) > $limit;
        if ( $result['more'] ) {
            array_pop( $records );
        }

        $result['appointments'] = $records;

        return $result;
    }

    /**
     * Build query for getUpcomingAppointments and getPastAppointments methods.
     *
     * @return AB_Query
     */
    private function _buildQueryForAppointments()
    {
        $client_diff = get_option( 'gmt_offset' ) * MINUTE_IN_SECONDS;

        return AB_Appointment::query( 'a' )
            ->select( 'c.name AS category,
                    sv.title AS service,
                    s.full_name AS staff,
                    a.staff_id,
                    a.service_id,
                    sv.category_id,
                    COALESCE(p.total, (ss.price * ca.number_of_persons)) AS price,
                    IF( ca.time_zone_offset IS NULL,
                        a.start_date,
                        DATE_SUB(a.start_date, INTERVAL ' . $client_diff . ' + ca.time_zone_offset MINUTE)
                       ) AS start_date,
                    ca.token' )
            ->leftJoin( 'AB_Staff', 's', 's.id = a.staff_id' )
            ->leftJoin( 'AB_Service', 'sv', 'sv.id = a.service_id' )
            ->leftJoin( 'AB_Category', 'c', 'c.id = sv.category_id' )
            ->leftJoin( 'AB_StaffService', 'ss', 'ss.staff_id = a.staff_id AND ss.service_id = a.service_id' )
            ->innerJoin( 'AB_CustomerAppointment', 'ca', 'ca.appointment_id = a.id AND ca.customer_id = ' . $this->get( 'id' ) )
            ->leftJoin( 'AB_Payment', 'p', 'p.customer_appointment_id = ca.id' )
            ->sortBy( 'start_date' )
            ->order( 'DESC' );
    }

    /**
     * Associate WP user with customer.
     *
     * @param int $user_id
     */
    public function setWPUser( $user_id = 0 )
    {
        if ( $user_id == 0 ) {
            $user_id = $this->_createWPUser();
        }

        if ( $user_id ) {
            $this->set( 'wp_user_id', $user_id );
        }
    }

    /**
     * Create new WP user and send email notification.
     *
     * @return bool|int
     */
    private function _createWPUser()
    {
        // Generate unique username.
        $base     = sanitize_user( $this->get( 'name' ), true ) != '' ? sanitize_user( $this->get( 'name' ), true ) : 'client';
        $username = $base;
        $i        = 1;
        while ( username_exists( $username ) ) {
            $username = $base . $i;
            ++ $i;
        }
        // Generate password.
        $password = wp_generate_password( 6, true );
        // Create user.
        $user_id = wp_create_user( $username , $password, $this->get( 'email' ) );
        if ( ! $user_id instanceof WP_Error ) {
            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( 'subscriber' );

            // Send email notification.
            AB_NotificationSender::sendEmailForNewUser( $this, $username, $password );

            return $user_id;
        }

        return false;
    }

}