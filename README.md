# stripe

StripeBundle
============

Provides a simple Symfony 2 Bundle to Wrap the Stripe PHP SDK - https://github.com/stripe/stripe-php

## Installation

### composer.json

```json

    {
        "require": {
            "stripe/stripe-php": "^2.0"
        }
    }

```

### app/AppKernel.php
```php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Application\StripeBundle(),
        );
    }

```

## Configuration

Edit your symfony config.yml file and add, at a minimum, the following lines:

    application_stripe:
        api_secret_key:      %your_api_sercret_key%
        api_publishable_key: %your_api_public_key%

## Utilisation

#### To authenticate your server with the stripe secret key

```php

    $this->container->get('application_stripe.stripe')->auth();

```

#### To authenticate your client with the stripe publishable key

    <script type="text/javascript">Stripe.setPublishableKey('{{stripe_publishable_key}}');</script>

```

### Example

form
https://stripe.com/docs/tutorials/forms

#### Charge a client


```php
            \Stripe_Charge::create(array(
                    "amount" => round($price * 100),
                    "currency" => "usd",
                    "customer" => $customerId)
            );
```

##TODO:
- you need to create you entity Order
