<?php

class sendStripeData {
    //api url
    private $url = 'http://member.musicsupervisorguide.com/';

    //send stripe customer payment information
    function sendCustomerPayment($methodUrl,$param) {

        $url = $this->url.$methodUrl;
        $data_json = json_encode($param);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','X-Token:014a8a7d49734c5fb838b2ca617b0275'));
       // curl_setopt($ch, CURLOPT_HTTPHEADER,array('X-Token:014a8a7d49734c5fb838b2ca617b0275'));
       // curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}