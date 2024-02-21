<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
	public function cod()
	{
		if (!isset($_SESSION['order_response'])) {
			$curr = base64_decode($_GET['sq']);
			$curr = explode("__", $curr);
			$_POST['access_token'] = $_SESSION['userSession'];
			$_POST['converted_amount'] = $curr[0];
			$_POST['converted_currency'] = $curr[1];
			$order = post_curl("order/cod", $_POST);
			$_SESSION['order_response'] = $order;
		}
		$data['return'] = $_SESSION['order_response'];
		userTemplate("member/products/response", $data);
	}

	public function ewallet()
	{
		if (!isset($_SESSION['order_response'])) {
			$_POST['access_token'] = $_SESSION['userSession'];
			$order = post_curl("order/ewallet", $_POST);
			$_SESSION['order_response'] = $order;
		}
		$data['return'] = $_SESSION['order_response'];
		userTemplate("member/products/response", $data);
	}

	public function stripe()
	{
		if (!isset($_SESSION['order_response'])) {
			$curr = base64_decode($_GET['sq']);
			$curr = explode("__", $curr);
			$_POST['access_token'] = $_SESSION['userSession'];
			$_POST['converted_amount'] = $curr[0];
			$_POST['converted_currency'] = $curr[1];
			$stripe = post_curl("payment/stripe", $_POST);
			$stripe_options = json_decode($stripe['data'], true);
			if (isset($stripe_options['id'])) {
				$_SESSION['stripe_session'] = $stripe_options;
				redirect($stripe_options['url']);
				exit;
			}
		}
		redirect(base_url("products"));
	}

	public function stripe_success($order_number)
	{
		if (!isset($_SESSION['order_response'])) {
			$_POST['stripe_session'] = json_encode($_SESSION['stripe_session']);
			$_POST['access_token'] = $_SESSION['userSession'];
			$_POST['order_num'] = $order_number;
			$order = post_curl("order/stripe", $_POST);
			$_SESSION['order_response'] = $order;
			unset($_SESSION['stripe_session']);
		}
		$data['return'] = $_SESSION['order_response'];
		userTemplate("member/products/response", $data);
	}

	public function hitpay()
	{
		if (!isset($_SESSION['order_response'])) {
			$curr = base64_decode($_GET['sq']);
			$curr = explode("__", $curr);
			$_POST['access_token'] = $_SESSION['userSession'];
			$_POST['converted_amount'] = $curr[0];
			$_POST['converted_currency'] = $curr[1];
			$hitpay = post_curl("payment/hitpay", $_POST);
			$hitpay_options = $hitpay['data'];
			if (isset($hitpay_options['id'])) {
				$_SESSION['hitpay_session'] = $hitpay;
				redirect($hitpay_options['url']);
				exit;
			}
		}
		redirect(base_url("products"));
	}

	public function hitpay_response($order_number)
	{
		if (!isset($_SESSION['order_response'])) {
			$_POST['reference'] = $_GET['reference'];
			$_POST['access_token'] = $_SESSION['userSession'];
			$_POST['order_num'] = $order_number;
			$order = post_curl("order/hitpay", $_POST);
			$_SESSION['order_response'] = $order;
			unset($_SESSION['hitpay_session']);
		}
		$data['return'] = $_SESSION['order_response'];
		userTemplate("member/products/response", $data);
	}

	public function cart()
	{
		$_POST['access_token'] = $_SESSION['userSession'];
		return post_curl("cart/get", $_POST)['data'];
	}

	public function payment_cancel()
	{
		redirect(base_url("products"));
	}
}
