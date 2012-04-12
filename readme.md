# Mailchimp for LaravelPHP #

This package is a simple wrapper for working w/ the [Mailchimp API](http://apidocs.mailchimp.com/api/1.3/).

## Install ##

Copy the config file to your ``application/config/`` folder, and input the proper information.

## Usage ##

Call the desired method and pass the params as a single array:

```php
$params = array(
	'id' => '1234567',
	'email_address' => 'foo@bar.com',
);
$response = Mailchimp::list_subscribe($params);
```

Just make sure you pass all the required fields.