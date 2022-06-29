<?php

namespace App\Service;

use App\Entity\Panier;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use App\Service\PanierService;


class StripeService{
    private $privateKey;
    public function __construct($privateKey)
    {
        if($_ENV('APP_ENV') === 'dev'){
            $this->privateKey = $_ENV('STRIPE_PRIVATE_KEY_TEST');
    } else {
        $this->privateKey = $_ENV('STRIPE_PRIVATE_KEY_LIVE');
    }   
}

public function paymentIntent($total){
    Stripe::setApiKey($this->privateKey);

    return PaymentIntent::create([
        'amount' => $total * 100,
        'currency' => 'eur',
        'payment_method_types' => ['card'],
    ]);

}

public function payment($amout, $currency, $desc, array $stripeParameter){
    Stripe::setApiKey($this->privateKey);
$payment_intent = null;

if(isset($stripeParameter['payment_intent_id'])){
    $payment_intent = PaymentIntent::retrieve($stripeParameter['payment_intent_id']);
}

if($stripeParameter['payment_intent_id'] === 'succeeded'){
    //TO DO
} else {
    $payment_intent->cancel();
}
return $payment_intent;

}
 public function stripe(array $stripeParameter, $total, $desc){
    return $this->payment(
        $total,
        'eur',
        $desc,
        $stripeParameter
    );
 }
}