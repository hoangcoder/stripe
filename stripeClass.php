<?php

namespace drupal_ex\stripe_ex;

class stripeClass {

  protected $pub_key, $s_key;

  public function __construct($pub_key, $s_key) {
    $this->pub_key = $pub_key;
    $this->s_key = $s_key;
  }

  public function connectStripe() {
    try {
      return \Stripe\Stripe::setApiKey($this->s_key);
    } catch (\Stripe\Error\Base $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    } catch (Exception $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    }
  }

  public function checkCustomerByEmail($email = '') {
    try {
      return \Stripe\Customer::all(["limit" => 1, "email" => $email]);
    } catch (\Stripe\Error\Base $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    } catch (Exception $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    }
  }

  public function createCustomer($data) {
    if (count($data) == 0)
      return false;
    try {
      $customer = \Stripe\Customer::create($data);
      return $customer;
    } catch (\Stripe\Error\Base $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    } catch (Exception $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    }
  }

  public function createCard($cus_id, $data) {
    if (count($data) == 0 || $cus_id == '') {
      return false;
    }
    try {
      $card = \Stripe\Token::create(["card" => $data]);
      $customer = \Stripe\Customer::retrieve($cus_id);
      $customer->sources->create(["source" => $card['id']]);
      return $customer;
    } catch (\Stripe\Error\Base $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    } catch (Exception $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    }
  }

  public function chargeACustomer($data) {
    if (count($data) == 0)
      return false;
    try {
      $charge = \Stripe\Charge::create($data);
      return $charge;
    } catch (\Stripe\Error\Base $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    } catch (Exception $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    }
  }

  public function listUpcomingInvoice($cus_id) {
    try {
      return \Stripe\Invoice::upcoming(["customer" => $cus_id]);
    } catch (\Stripe\Error\Base $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    } catch (Exception $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    }
  }

  public function createInvoiceItem($data) {
    try {
      return \Stripe\InvoiceItem::create($data);
    } catch (\Stripe\Error\Base $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    } catch (Exception $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    }
  }

  public function createInvoice($data) {
    try {
      return \Stripe\Invoice::create($data);
    } catch (\Stripe\Error\Base $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    } catch (Exception $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    }
  }

  public function sendAnInvoice($in_id) {
    try {
      $invoice = \Stripe\Invoice::retrieve($in_id);
      $invoice->sendInvoice();
      return $invoice;
    } catch (\Stripe\Error\Base $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    } catch (Exception $e) {
      return [
          'status' => false,
          'message' => $e->getMessage()
      ];
    }
  }

}
