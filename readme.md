# Mailchimp

A PHP library for working w/ the [Mailchimp API](http://apidocs.mailchimp.com/api/2.0/) (v2.0).

## Install

Normal install via Composer.

## Usage

Call the ``run`` method and pass two params, the first being your desired API method and the second being your payload as a single array.

```php
use Travis\Mailchimp;

$response = Mailchimp::run('lists/subscribe', array(
	'apikey' => 'abcdefg-us2',
    'id' => '123456',
    'email' => array(
    	'email' => 'foobar@gmail.com',
    ),
    'double_optin' => false,
    'update_existing' => true,
    'replace_interests' => false,
    'send_welcome' => false,
));
```

The ``apikey`` value must be included in your payload for each API request.