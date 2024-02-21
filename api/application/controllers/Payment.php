<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
	public function hitpay()
	{
		$system = $this->SystemModel->getConstants();
		$HITPAY_URL = $system['HITPAY_URL'] . "/v1/payment-requests";
		$HITPAY_APIKEY = $system['HITPAY_APIKEY'];
		$order_num = getTransId();
		$user = $this->MemberModel->getMemberInfoByToken($_POST['access_token']);
		$cart_items = $this->CartModel->getUnpaid($user);
		$cart_total = 0;
		foreach ($cart_items as $item) {
			$cart_total += ($item['qty'] * (float)$item['unit_price']);
		}
		$converted_currency = "USD";
		if(isset($_POST['converted_currency'])) {
			$ratex = $this->CurrencyModel->getCurrencyBy($_POST['converted_currency']);
			$cart_total = $ratex['deposit_currency_rate'] * $cart_total;
			$converted_currency = $_POST['converted_currency'];
		}

		$returnURL = MEMBER_URL . 'order/hitpay_response/' . $order_num;
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $HITPAY_URL,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array('email' => $user['userid'] . "@gmail.com", 'currency' => $converted_currency, 'amount' => $cart_total, 'redirect_url' => $returnURL, 'reference_number' => $order_num, 'purpose' => $order_num),
			CURLOPT_HTTPHEADER => array(
				'X-BUSINESS-API-KEY: ' . $HITPAY_APIKEY,
				'X-Requested-With: XMLHttpRequest'
			),
		));
		$return = json_decode(curl_exec($curl), true);
		curl_close($curl);
		$this->db->update('product_cart', array("master_id" => $order_num, "is_processed" => 1, "is_paid" => 0, "payment_mode" => "HITPAY"), array('member_id' => $user['id']));
		return successReponse("", $return);
	}

	public function stripe()
	{
		$user = $this->MemberModel->getMemberInfoByToken($_POST['access_token']);
		$cart_items = $this->CartModel->getUnpaid($user);
		$cart_total = 0;
		foreach ($cart_items as $item) {
			$cart_total += ($item['qty'] * (float)$item['unit_price']);
		}
		$converted_currency = "USD";
		if(isset($_POST['converted_currency'])) {
			$ratex = $this->CurrencyModel->getCurrencyBy($_POST['converted_currency']);
			$cart_total = $ratex['deposit_currency_rate'] * $cart_total;
			$converted_currency = $_POST['converted_currency'];
		}
		$return = $this->stripeSession($cart_total, $user['id'], $_POST);
		return successReponse("", $return);
	}

	public function stripeSession($product_price, $user_id, $post)
	{
		$system = $this->SystemModel->getConstants();
		$order_num = getTransId();
		$gateway = $this->PaymentModel->getGateways("ACTIVE")['STRIPE'];
		$url = "curl " . $gateway['webaddress'] . 'v1/checkout/sessions';
		$url .= ' -H "Authorization: Bearer ' . $gateway['secret_key'] . '"';
		$url .= ' -d payment_method_types[]=card';
		$url .= ' -d line_items[][name]="' . $order_num . '"';
		$url .= ' -d line_items[][description]="' . $order_num . '"';
		$url .= ' -d line_items[][quantity]=1';
		$url .= ' -d line_items[][amount]=' . round($product_price * 100, 0);
		$url .= ' -d line_items[][currency]='. $post['converted_currency'];
		$url .= ' -d success_url="' . MEMBER_URL . 'order/stripe_success/' . $order_num . '"';
		$url .= ' -d cancel_url="' . MEMBER_URL . 'order/payment_cancel/' . $order_num . '"';
		$result = shell_exec($url);
		$this->db->update('product_cart', array("master_id" => $order_num, "is_processed" => 1, "is_paid" => 0, "payment_mode" => "STRIPE"), array('member_id' => $user_id));
		return $result;
	}
}
