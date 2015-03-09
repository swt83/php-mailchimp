<?php

namespace Travis;

class Mailchimp {

    /**
     * Method for handling API calls.
     *
     * @param   string  $method
     * @param   string  $apikey
     * @param   array   $payload
     * @return  object
     */
    public static function run($method, $payload = array())
    {
        // determine apikey
        $apikey = isset($payload['apikey']) ? $payload['apikey'] : null;
        if (!$apikey) trigger_error('No API key provided.');

        // determine endpoint
        list($ignore, $server) = explode('-', $apikey);
        $endpoint = 'https://'.$server.'.api.mailchimp.com/2.0/'.$method.'.json';

        // build payload
        $payload = json_encode($payload);

        // setup curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        $response = curl_exec($ch);

        // catch error...
        if (curl_errno($ch))
        {
            // report
            #$errors = curl_error($ch);

            // close
            curl_close($ch);

            // return false
            return false;
        }

        // close
        curl_close($ch);

        // return array
        return json_decode($response);
    }

}