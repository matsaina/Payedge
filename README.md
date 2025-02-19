# Payedge PHP Library

This library provides a simple interface for interacting with the Payedge payment gateway in your PHP applications.

Installation
Using Composer:

```
composer require edgecloud/Payedge
```
## Usage
Instantiate the Payedge class:
```php
require_once 'vendor/autoload.php';

use edgecloud\Payedge\Payedge;

$apiKey = 'YOUR_API_KEY';
$linkId = 'YOUR_LINK_ID';
$Payedge = new Payedge($apiKey, $linkId);

```

Initiate a payment:

```php
$msisdn = '254712345678'; // Phone number without the leading '+'
$amount = 10; // Amount in kes
$callback = 'https://your-website.com/callback'; // Your callback URL

$response = $Payedge->initiate($msisdn, $amount, $callback);

// Handle the response (usually a JSON object containing checkout details)

// {
//   +"MerchantRequestID": "db57-40e1-af85-2424fab5a2e697902622"
//   +"CheckoutRequestID": "ws_CO_21032024215003724757869730"
//   +"ResponseCode": "0"
//   +"ResponseDescription": "Success. Request accepted for processing"
//   +"CustomerMessage": "Success. Request accepted for processing"
// }

// example 

echo $response->ResponseDescription; // Success. Request accepted for processing

```

Query the status of a payment:

```php

$checkoutId = 'CHECKOUT_ID_FROM_INITIATE_RESPONSE';

$response = $Payedge->query($checkoutId);

// Handle the response (usually a JSON object containing payment status)

// {
//   +"ResponseCode": "0"
//   +"ResponseDescription": "The service request has been accepted successsfully"
//   +"MerchantRequestID": "847c-4573-85db-96a68dacad1992169467"
//   +"CheckoutRequestID": "ws_CO_21032024213641597757869730"
//   +"ResultCode": "1037"
//   +"ResultDesc": "DS timeout user cannot be reached"
// }

// example

echo $response->ResultDesc; // DS timeout user cannot be reached


```
### Methods
- initiate($msisdn, $amount, $callback): Initiates a payment.
- query($checkoutId): Queries the status of a payment.

### Examples
Please see the examples directory for more detailed usage examples.

### Contributing
We welcome contributions! Please see the CONTRIBUTING.md file for more information.

### License
This library is licensed under the MIT License. See the LICENSE file for more information.