<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup extends CI_Controller
{
	public function package()
	{
		if (count($_POST) > 0) {
			$gateway = $_POST['payment_gateway'];
			if ($gateway == "STRIPE") {
				$_SESSION['TSGUP']['package_id'] = $_POST['package_id'];
				$_SESSION['TSGUP']['payment_gateway'] = $_POST['payment_gateway'];
				$req['signup_data'] = json_encode($_SESSION['TSGUP']);
				$stripe = post_curl("signup/stripe", $req);
				$stripe_options = json_decode($stripe['data'], true);
				if (isset($stripe_options['id'])) {
					$_SESSION['stripe_session'] = $stripe_options;
					redirect($stripe_options['url']);
					exit;
				}

			}
			if ($gateway == "HITPAY") {
				$req['access_token'] = json_encode($_SESSION['userSession']);
				$_SESSION['TSGUP']['package_id'] = $_POST['package_id'];
				$_SESSION['TSGUP']['payment_gateway'] = $_POST['payment_gateway'];
				$req['signup_data'] = json_encode($_SESSION['TSGUP']);
				$hitpay = post_curl("signup/hitpay", $req);
				$hitpay_options = $hitpay['data'];
				if (isset($hitpay_options['id'])) {
					$_SESSION['hitpay_session'] = $hitpay;
					redirect($hitpay_options['url']);
					exit;
				}
			}
		}
		$response = post_curl("signup/form", array());
		$data = $response['data'];
		$data['title'] = "[[LABEL_SELECT_PACKAGE]]";
		publicTemplate("guest/signup/package", $data);
	}

	public function stripe_success($order_number)
	{
		if (isset($_SESSION['TSGUP'])) {
			$_POST['signup_data'] = json_encode($_SESSION['TSGUP']);
			$_POST['stripe_session'] = json_encode($_SESSION['stripe_session']);
			$_POST['order_num'] = $order_number;
			$order = post_curl("signup/stripe_success", $_POST);
			$_SESSION['package_response'] = $order;
			unset($_SESSION['TSGUP']);
		}
		$data['return'] = $_SESSION['package_response'];
		publicTemplate("guest/signup/response", $data);
	}
}
