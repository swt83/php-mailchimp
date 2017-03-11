# Mailchimp

A PHP library for working w/ the [Mailchimp API](http://apidocs.mailchimp.com/api/3.0/) (v3.0).

## Install

Normal install via Composer.

## Usage

Call the ``run`` method and pass four params:

* the URI
* the method
* the api key
* the payload

```php
use Travis\Mailchimp;

$response = Mailchimp::run('lists/'.$listid.'/members/'.$hash, 'put', $apikey, [
    'email_address' => $email,
    'status' => 'pending',
    'status_if_new' => 'subscribed',
    'ip_opt' => $_SERVER['REMOTE_ADDR'],
    'ip_signup' => $_SERVER['REMOTE_ADDR'],
    'merge_vars' => [
        'FNAME' => $first,
        'LNAME' => $last,
    ],
]);
```

The new ``3.0`` API version they came out with is much more confusing that previous versions.  You will need to check the [API reference](http://developer.mailchimp.com/documentation/mailchimp/reference/overview/) to find out what request types you need to be making (GET, PUT, PATCH, DELETE, EDIT).  It's a mess.

### A note about pending vs. subscribed

Notice the params ``status`` and ``status_if_new``.  Mailchimp no longer allows you to add someone to your list if they at any time had unsubscribed.  By marking ``status`` as ``pending`` and ``status_if_new`` as ``subscribed`` you can make it work as best you will be able.  People who had unsubscribed will get a double-optin from Mailchimp, but new people will not.