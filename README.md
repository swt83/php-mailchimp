# Mailchimp

A PHP library for working w/ the [Mailchimp API](http://apidocs.mailchimp.com/api/3.0/) (v3.0).

## Install

Normal install via Composer.

### Tags

- ``1.1`` -- API v2.0
- ``1.2`` -- API v3.0

## Usage

Call the ``run`` method and pass two params, the first being your desired API method and the second being your payload as a single array.

```php
use Travis\Mailchimp;

$response = Mailchimp::run('lists/YOURLISTID/members/'.md5($email), 'put', 'YOURAPIKEY', [
    'email_address' => $email,
    'status' => 'pending',
    'ip_opt' => $ip,
]);
```

The new ``3.0`` API version they came out with is much more confusing that previous versions.  You will need to check the [API reference](http://developer.mailchimp.com/documentation/mailchimp/reference/overview/) to find out what request types you need to be making (GET, PUT, PATCH, DELETE, EDIT).  It's a mess.
