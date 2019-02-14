<?php

namespace drupal_ex\stripe_ex;

class stripeClass {

  protected $pub_key, $s_key;

  public function __construct($pub_key, $s_key) {
    $this->pub_key = $pub_key;
    $this->s_key = $s_key;
  }

  public function connectStripe() {
    \Stripe\Stripe::setApiKey($this->s_key);
  }

  public function checkCustomerByEmail($email = '') {
    return \Stripe\Customer::all(["limit" => 1, "email" => $email]);
  }

  public function createCustomer($data) {
    if (count($data) == 0)
      return false;
    $customer = \Stripe\Customer::create($data);
    return $customer;
  }

  public function createCard($cus_id, $data) {
    if (count($data) == 0 || $cus_id == '') {
      return false;
    }
    $card = \Stripe\Token::create(["card" => $data]);
    $customer = \Stripe\Customer::retrieve($cus_id);
    $customer->sources->create(["source" => $card['id']]);
    return $customer;
  }

  public function chargeACustomer($data) {
    if (count($data) == 0)
      return false;
    $charge = \Stripe\Charge::create($data);
    return $charge;
  }

}
