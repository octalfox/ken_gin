<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
	public function signup()
	{
		$return = $this->SignupModel->getMemberFormData();
		return successReponse("", $return);
	}

	public function check_user_data()
	{
		$return = $this->MemberModel->getMemberInfoByEmailAndPhone($_POST['email'], $_POST['mobile']);
		if ($return) {
			return failedReponse("", $return);
		}
		return successReponse("", $return);
	}

	public function downline()
	{
		$user = $this->MemberModel->getMemberInfoByToken($_POST['access_token']);
		$downline = $this->DownlineModel->getAllDownlinesRank($user['id']);
		return successReponse("", $downline);
	}

	public function placement()
	{
		$user = $this->MemberModel->getMemberInfoByToken($_POST['access_token']);
		$return = $this->DownlineModel->getPlacement($_POST);
		$return['sponsor'] = $user;
		$return['countries'] = $this->CountryModel->getAllCountries();
		return successReponse("", $return);
	}

	public function payment_link()
	{
		$user = $this->MemberModel->getMemberInfoByToken($_POST['access_token']);
		$return = $this->DownlineModel->getPlacement($_POST);
		$return['sponsor'] = $user;
		$return['countries'] = $this->CountryModel->getAllCountries();
		return successReponse("", $return);
	}

	public function ewallet()
	{
		return $this->PackagePurchaseWalletModel->purchaseProduct($_POST);
	}

	public function stripe()
	{
		$signup_data = json_decode($_POST['signup_data'], true);
		$p['id'] = $signup_data['package_id'];
		$product = $this->ProductModel->getPackages($p);
		$return = $this->stripeSession($product['price']);
		return successReponse("", $return);
	}

	public function hitpay()
	{
		$signup_data = json_decode($_POST['signup_data'], true);
//		$system = $this->SystemModel->getConstants();
//		$HITPAY_URL = $system['HITPAY_URL'] . "/v1/payment-requests";
//		$HITPAY_APIKEY = $system['HITPAY_APIKEY'];
//		$order_num = getTransId();
//		$p['id'] = $signup_data['package_id'];
//		$product = $this->ProductModel->getPackages($p);
//		$returnURL = MEMBER_URL . 'user/hitpay_response/' . $order_num;
//		$curl = curl_init();
//		curl_setopt_array($curl, array(
//			CURLOPT_URL => $HITPAY_URL,
//			CURLOPT_RETURNTRANSFER => true,
//			CURLOPT_ENCODING => '',
//			CURLOPT_MAXREDIRS => 10,
//			CURLOPT_TIMEOUT => 0,
//			CURLOPT_FOLLOWLOCATION => true,
//			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//			CURLOPT_CUSTOMREQUEST => 'POST',
//			CURLOPT_POSTFIELDS => array('email' => $signup_data['user'] . "@gmail.com", 'currency' => 'SGD', 'amount' => $product['price'] * (isset($system['USD_SGD_TOPUP']) ? $system['USD_SGD_TOPUP'] : 1), 'redirect_url' => $returnURL, 'reference_number' => $order_num, 'purpose' => $order_num),
//			CURLOPT_HTTPHEADER => array(
//				'X-BUSINESS-API-KEY: ' . $HITPAY_APIKEY,
//				'X-Requested-With: XMLHttpRequest'
//			),
//		));
//		$return = json_decode(curl_exec($curl), true);
//		curl_close($curl);
//		return successReponse("", $return);

		// Retrieve system constants and configuration
		$system = $this->SystemModel->getConstants();

		// HitPay API URL and API key
		$HITPAY_URL = $system['HITPAY_URL'] . "/v1/payment-requests";
		$HITPAY_APIKEY = $system['HITPAY_APIKEY'];

		// Generate order/reference number
		$order_num = getTransId();

		// Fetch package information
		$p['id'] = $signup_data['package_id'];
		$product = $this->ProductModel->getPackages($p);

		// Construct the return URL
		$returnURL = MEMBER_URL . 'user/hitpay_response/' . $order_num;

		// Prepare payload for cURL request
		$payload = array(
			'email' => $signup_data['user'] . "@gmail.com",
			'currency' => 'SGD',
			'amount' => $product['price'] * (isset($system['USD_SGD_TOPUP']) ? $system['USD_SGD_TOPUP'] : 1),
			'redirect_url' => $returnURL,
			'reference_number' => $order_num,
			'purpose' => $order_num,
		);

		// Initialize cURL session
		$curl = curl_init();

		// Set cURL options
		curl_setopt_array($curl, array(
			CURLOPT_URL => $HITPAY_URL,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $payload,
			CURLOPT_HTTPHEADER => array(
				'X-BUSINESS-API-KEY: ' . $HITPAY_APIKEY,
				'X-Requested-With: XMLHttpRequest',
			),
		));

		// Execute cURL request
		$response = curl_exec($curl);

		// Check for cURL errors
		if (curl_errno($curl)) {
			// Handle cURL error
			$result = 'Curl error: ' . curl_error($curl);
		} else {
			// Decode the JSON response
			$result = json_decode($response, true);

			// Close cURL session
			curl_close($curl);
		}

		// Return the result
		return successReponse("", $result);
	}


	public function stripeSession($product_price)
	{
//		$order_num = getTransId();
//		$gateway = $this->PaymentModel->getGateways("ACTIVE")['STRIPE'];
//		$url = "curl " . $gateway['webaddress'] . 'v1/checkout/sessions';
//		$url .= ' -H "Authorization: Bearer ' . $gateway['secret_key'] . '"';
//		$url .= ' -d payment_method_types[]=card';
//		$url .= ' -d line_items[][name]="' . $order_num . '"';
//		$url .= ' -d line_items[][description]="' . $order_num . '"';
//		$url .= ' -d line_items[][quantity]=1';
//		$url .= ' -d line_items[][amount]=' . round($product_price * 100, 0);
//		$url .= ' -d line_items[][currency]=' . strtolower(SYSTEM_CURRENCY);
//		$url .= ' -d success_url="' . MEMBER_URL . 'user/stripe_success/' . $order_num . '"';
//		$url .= ' -d cancel_url="' . MEMBER_URL . 'user/payment_cancel/' . $order_num . '"';
//		$result = shell_exec($url);
//		return $result;

		$order_num = getTransId();
		$gateway = $this->PaymentModel->getGateways("ACTIVE")['STRIPE'];

		// Build the payload
		$payload = array(
			'payment_method_types' => array('card'), // Wrap 'card' in an array
			'line_items[][name]' => $order_num,
			'line_items[][description]' => $order_num,
			'line_items[][quantity]' => 1,
			'line_items[][amount]' => round($product_price * 100, 0),
			'line_items[][currency]' => strtolower(SYSTEM_CURRENCY),
			'success_url' => MEMBER_URL . 'user/stripe_success/' . $order_num,
			'cancel_url' => MEMBER_URL . 'user/payment_cancel/' . $order_num,
		);

		// Initialize cURL session
		$ch = curl_init($gateway['webaddress'] . 'v1/checkout/sessions');

		// Set cURL options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer ' . $gateway['secret_key'],
			'Content-Type: application/x-www-form-urlencoded',
		));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));

		// Execute cURL session
		$result = curl_exec($ch);

		// Check for cURL errors
		if (curl_errno($ch)) {
			// Handle error
			echo 'Curl error: ' . curl_error($ch);
		}

		// Close cURL session
		curl_close($ch);

		return $result;
	}

	public function stripe_success()
	{
		return $this->PackagePurchaseStripeModel->purchaseProduct($_POST);
	}

}
