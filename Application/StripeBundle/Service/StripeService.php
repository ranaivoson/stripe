<?php

namespace Application\StripeBundle\Service;

use Stripe\Stripe;
use Stripe\Charge;

class StripeService extends Stripe
{
    protected $secretKey;

    function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
        self::setApiKey($secretKey);

        return $this;
    }

    public function auth()
    {
        self::setApiKey($this->secretKey);
    }
    
    public function charge($id)
    {
        Charge::create(array(
            "amount" => round(100 * 100),
            "currency" => "usd",
            "customer" => 'moi')
        );
    }
}
