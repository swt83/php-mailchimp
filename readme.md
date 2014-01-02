# Mailchimp

A PHP library for working w/ the [Mailchimp API](http://apidocs.mailchimp.com/api/1.3/).

## Install

Normal install via Composer.

## Usage

Call the desired method and pass the params as a single array.

```php
$response = Travis\Mailchimp::list_subscribe(array(
    'apikey' => 'YOUR_API_KEY',
    'id' => 'YOUR_LIST_ID',
    'email_address' => 'foo@bar.com',
));
```

Just make sure you pass all the required fields.