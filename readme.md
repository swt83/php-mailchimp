# Mailchimp for LaravelPHP #

This package is a simple wrapper for working w/ the [Mailchimp API](http://apidocs.mailchimp.com/api/1.3/).

## Install ##

In ``application/bundles.php`` add:

```php
'mailchimp' => array('auto' => true),
```

## Config ##

Copy the config file to ``application/config/mailchimp.php`` and input the proper information.

## Usage ##

Call the desired method and pass the params as a single array.  Don't worry about passing the API key.

```php
$response = Mailchimp::list_subscribe(array(
	'id' => '1234567',
	'email_address' => 'foo@bar.com',
));
```

Just make sure you pass all the required fields.