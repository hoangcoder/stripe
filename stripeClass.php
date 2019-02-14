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
    echo 1;
  }

  public function checkCustomerByEmail($email = '') {
    return \Stripe\Customer::all(["limit" => 1, "email" => $email]);
  }

  public static function createCustomer($data = []) {
    if (count($data) == 0)
      return false;
  }

}
