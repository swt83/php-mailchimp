<?php

namespace Travis;

class Mailchimp {

    /**
     * Magic method for handling API calls.
     *
     * @param   string  $method
     * @param   array   $args
     * @return  object
     */
    public static function __callStatic($method, $args)
    {
        // capture arguments
        $arguments = isset($args[0]) ? $args[0] : array();

        // catch error...
        if (!isset($arguments['apikey'])) trigger_error('No API key provided.');

        // capture api key
        $api_key = $arguments['apikey'];

        // determine endpoint
        list($ignore, $server) = explode('-', $api_key);
        $endpoint = 'https://'.$server.'.api.mailchimp.com/1.3/?method='.self::camelcase($method);

        // build payload
        $payload = urlencode(json_encode($arguments));

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

        // catch errors
        if (curl_errno($ch))
        {
            #$errors = curl_error($ch);
            curl_close($ch);

            // return false
            return false;
        }
        else
        {
            curl_close($ch);

            // return array
            return json_decode($response);
        }
    }

    /**
     * Return snake case conversion of string.
     *
     * @param   string  $str
     * @return  string
     */
    protected static function camelcase($str)
    {
        return lcfirst(preg_replace('/(^|_)(.)/e', "strtoupper('\\2')", strval($str)));
    }

}