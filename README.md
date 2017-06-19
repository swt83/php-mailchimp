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

$hash = md5(strtolower($email));

		// make payload
		$payload = [
		    'email_address' => $email,
		    'status_if_new' => 'subscribed',
		    #'ip_opt' => $_SERVER['REMOTE_ADDR'],
		    #'ip_signup' => $_SERVER['REMOTE_ADDR'],
		    'merge_fields' => [
		        'FNAME' => $first,
		        'LNAME' => $last,
		    ],
		];

		// try to subscribe them...
		try
		{
			$payload['status'] = 'subscribed';
			$response = Mailchimp::run('lists/'.$listid.'/members/'.$hash, 'put', $apikey, $payload);
		}

		// if fails...
		catch (\Exception $e)
		{
			// try to pending them...
			try
			{
				$payload['status'] = 'pending';
    			$response = Mailchimp::run('lists/'.$listid.'/members/'.$hash, 'put', $apikey, $payload);
			}

			// if fails...
	        catch (\Exception $e)
	        {
				// send email
				die($e->getMessage());
			}
		}
```

The new ``3.0`` API version they came out with is much more confusing that previous versions.  You will need to check the [API reference](http://developer.mailchimp.com/documentation/mailchimp/reference/overview/) to find out what request types you need to be making (GET, PUT, PATCH, DELETE, EDIT).  It's a mess.

### A note about pending vs. subscribed

The above example is the best way to do a subscribe.  This is to prevent a bunch of confirmation emails being sent to people who you are trying to sync but who are already subscribed to your list.
