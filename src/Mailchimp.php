<?php

namespace Travis;

class Mailchimp
{
    /**
     * Method for handling API calls.
     *
     * @param   string  $method
     * @param   string  $request
     * @param   array   $payload
     * @param   int     $timeout
     * @return  object
     */
    public static function run($method, $request, $apikey, $payload = [], $timeout=30)
    {
        // make endpoint
        list($ignore, $server) = explode('-', $apikey);
        $endpoint = 'https://'.$server.'.api.mailchimp.com/3.0/'.$method;

        // make headers
        $headers = [
            'content-type:application/json',
        ];

        // make username
        $username = 'apikey:'.$apikey;

        // make payload
        $payload_as_json = json_encode($payload);
        $payload_as_query = http_build_query($payload);

        // setup curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint.'?'.$payload_as_query);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERPWD, $username);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($request));
        #curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_as_json);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); // CURL update caused breaking w/ Mailchimp API
        $response = curl_exec($ch);

        if ($response === false)
        {
            throw new \Exception(curl_error($ch), curl_errno($ch));
        }

        // close
        curl_close($ch);

        // decode response
        $response = json_decode($response);

        // catch error...
        if ((int) ex($response, 'status') >= 400)
        {
            // throw error
            throw new \Exception(ex($response, 'detail'));

            // return false
            return false;
        }

        // return
        return $response;
    }
}