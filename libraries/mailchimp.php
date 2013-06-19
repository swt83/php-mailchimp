<?php

/**
 * A LaravelPHP package for working w/ Mailchimp.
 *
 * @package    Mailchimp
 * @author     Scott Travis <scott.w.travis@gmail.com>
 * @link       http://github.com/swt83/laravel-mailchimp
 * @license    MIT License
 */

class Mailchimp
{
	public static function __callStatic($method, $args)
	{
		// load api key
		$api_key = Config::get('mailchimp::mailchimp.api_key');
		
		// determine endpoint
		list($ignore, $server) = explode('-', $api_key);
		$endpoint = 'https://'.$server.'.api.mailchimp.com/1.3/?method='.self::camelcase($method);
		
		// build payload
		$arguments = isset($args[0]) ? $args[0] : array();
		$payload = urlencode(json_encode(array('apikey'=>$api_key) + $arguments));
		
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
	
	private static function camelcase($str)
	{
		return lcfirst(preg_replace('/(^|_)(.)/e', "strtoupper('\\2')", strval($str)));
	}
}
