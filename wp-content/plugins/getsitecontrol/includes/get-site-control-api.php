<?php

require_once('restclient/restclient.php');

class GetSiteControlApi {

    private static $restClient = null;

    /**
     * Get REST client instance
     *
     * @return null|RestClient
     */
    public static function getRestClient() {
        if (is_null(self::$restClient)) {
            self::$restClient = new RestClient(array(
                'base_url' => 'https://app.getsitecontrol.com/api/v1',
                'headers' => array('Content-Type' => 'application/json'),
            ));
        }
        return self::$restClient;
    }
}