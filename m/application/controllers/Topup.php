<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Topup extends CI_Controller
{
	public function index()
	{
		$_SESSION['topup_process'] = true;
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("topup/index", $req);
		$data = $response['data'];
		$data['title'] = '[[LABEL_TOPUP]]';
		userTemplate("member/topup/index", $data);
	}

	public function process()
	{
		if(!isset($_SESSION['topup_process'])){
			redirect(base_url("topup"));
			exit;
		}
		unset($_SESSION['topup_process']);
		$data['title'] = '[[LABEL_TOPUP]]';
		$data['header_back_url'] = "topup";
		if (count($_POST) > 0) {
			$req['deposit_amount'] = $_POST['deposit_amount'];
			$req['transfer_amount'] = $_POST['transfer_amount'];
			$req['counter_currency'] = $_POST['counter_currency'];
			$req['currency_rate'] = $_POST['currency_rate'];
			$req['bank_id'] = $_POST['bank_id'];
			if(isset($_FILES['payment_slip']['tmp_name'])) {
				$req['extension'] = pathinfo($_FILES['payment_slip']['name'], PATHINFO_EXTENSION);
				$req['filedata'] = base64_encode(file_get_contents($_FILES['payment_slip']['tmp_name']));
			}
			$req['access_token'] = $_SESSION['userSession'];
			$data['return'] = post_curl("topup/process", $req);
			userTemplate("member/topup/response", $data);
		} else {
			userTemplate("unknown", $data);
		}
	}

}
