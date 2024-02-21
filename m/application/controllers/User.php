<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function package()
	{
		$req['access_token'] = $_SESSION['userSession'];
		if (count($_POST) > 0) {
			$gateway = $_POST['payment_gateway'];
			if ($gateway == "STRIPE") {
				$req['access_token'] = json_encode($_SESSION['userSession']);
				$_SESSION['SGUP']['package_id'] = $_POST['package_id'];
				$_SESSION['SGUP']['payment_gateway'] = $_POST['payment_gateway'];
				$req['signup_data'] = json_encode($_SESSION['SGUP']);
				$stripe = post_curl("member/stripe", $req);
				$stripe_options = json_decode($stripe['data'], true);
				if (isset($stripe_options['id'])) {
					$_SESSION['stripe_session'] = $stripe_options;
					redirect($stripe_options['url']);
					exit;
				}
			}
			if ($gateway == "HITPAY") {
				$req['access_token'] = json_encode($_SESSION['userSession']);
				$_SESSION['SGUP']['package_id'] = $_POST['package_id'];
				$_SESSION['SGUP']['payment_gateway'] = $_POST['payment_gateway'];
				$req['signup_data'] = json_encode($_SESSION['SGUP']);
				$hitpay = post_curl("member/hitpay", $req);
				$hitpay_options = $hitpay['data'];
				if (isset($hitpay_options['id'])) {
					$_SESSION['hitpay_session'] = $hitpay;
					redirect($hitpay_options['url']);
					exit;
				}
			}
			if ($gateway == "E-WALLET") {
				if (isset($_SESSION['SGUP'])) {
					$req['access_token'] = json_encode($_SESSION['userSession']);
					$_SESSION['SGUP']['package_id'] = $_POST['package_id'];
					$_SESSION['SGUP']['payment_gateway'] = $_POST['payment_gateway'];
					$req['signup_data'] = json_encode($_SESSION['SGUP']);
					$order = post_curl("member/ewallet", $req);
					$_SESSION['order_response'] = $order;
					unset($_SESSION['SGUP']);
				}
				$data['return'] = $_SESSION['order_response'];
				userTemplate("member/user/response", $data);
				exit;
			}

			redirect(base_url("user/add/" . $_POST['matrixid'] . "/" . $_POST['side']));
		}
		$response = post_curl("member/signup", $req);
		$data = $response['data'];
		$data['title'] = "[[LABEL_SELECT_PACKAGE]]";
		userTemplate("member/user/package", $data);
	}

	public function downline()
	{
		$req['access_token'] = $_SESSION['userSession'];
		if (count($_POST) > 0) {
			redirect(base_url("user/add/" . $_POST['matrixid'] . "/" . $_POST['side']));
		}
		$response = post_curl("member/downline", $req);
		$data['members'] = $response['data'];
		$data['title'] = "[[LABEL_ADD_SUB_ACCOUNT]]";
		userTemplate("member/user/downline", $data);
	}

	public function add($_matrixid, $_side)
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		if (count($_POST) > 0) {
			$check_user = post_curl("member/check_user_data", $_POST);
			if ($check_user['response'] == 'success' || $_POST['downline_type'] == 1) {
				$_SESSION['SGUP'] = $_POST;
				redirect(base_url("user/package"));
			}

			$data['check_user_data'] = $check_user['data'];
			$data['post_data'] = $_POST;
		}
		$req['matrix'] = $_matrixid;
		$req['side'] = $_side;
		$response = post_curl("member/placement", $req);
		$data['data'] = $response['data'];
		$data['title'] = "[[LABEL_ADD_SUB_ACCOUNT]]";
		userTemplate("member/user/add_form", $data);
	}

	public function stripe_success($order_number)
	{
		if (isset($_SESSION['SGUP'])) {
			$_POST['signup_data'] = json_encode($_SESSION['SGUP']);
			$_POST['stripe_session'] = json_encode($_SESSION['stripe_session']);
			$_POST['access_token'] = $_SESSION['userSession'];
			$_POST['order_num'] = $order_number;
			$order = post_curl("member/stripe_success", $_POST);
			$_SESSION['package_response'] = $order;
			unset($_SESSION['SGUP']);
		}
		$data['return'] = $_SESSION['package_response'];
		userTemplate("member/user/response", $data);
	}

}
