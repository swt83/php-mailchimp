# Mailchimp for LaravelPHP #

This package is a simple wrapper for working w/ the Mailchimp API.

## Usage ##

Call the desired method and pass the params as a single array:

```php
$params = array(
	'id' => '1234567',
	'email_address' => 'babyboomer@aol.com',
);
$response = Mailchimp::listSubscribe($params);
```

Just make sure you pass all the required fields.