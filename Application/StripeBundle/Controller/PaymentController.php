<?php
// src/Application/BlogBundle/Controller/PageController.php

namespace Application\StripeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\StripeBundle\Form\Handler\CardFormHandler;
use Application\StripeBundle\Form\Type\CardFormType;
use Symfony\Component\HttpFoundation\Request;
use Stripe\Charge;
use Stripe;

class PaymentController extends Controller{
    public function newPaymentMethodAction(Request $request)
    {



        return $this->render('ApplicationStripeBundle:Payment:payment.html.twig'
            );
    }
    
    public function validAction(){
        $this->container->get('application_stripe.stripe')->auth();

// Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];

// Create the charge on Stripe's servers - this will charge the user's card
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => 4000, // amount in cents, again
                "currency" => "eur",
                "source" => $token,
                "description" => "Example charge"
            ));

        } catch(\Stripe\Error\Card $e) {
            die('carte non valide');
        }

        return $this->render('ApplicationStripeBundle:Payment:valid.html.twig'
        );
    }


}

