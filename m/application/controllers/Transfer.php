<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transfer extends CI_Controller
{
	public $session_key = "TRANSFER_VERIFICATION";

	public function history()
	{
		$this->MemberModel->check($this->session_key);
		$_SESSION['transfer_process'] = true;
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("transfer/history", $req);
		$data['results'] = $response['data'];
//		dd($data);
		$data['alert'] = "[[MSG_CONVERSION_RULES]]";
		$data['title'] = '[[LABEL_TRANSFER_HISTORY]]';
		userTemplate("member/transfer/history", $data);
	}

	public function index()
	{
		$this->MemberModel->check($this->session_key);
		$_SESSION['transfer_process'] = true;
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("transfer/index", $req);
		$data = $response['data'];
		$data['alert'] = "[[MSG_CONVERSION_RULES]]";
		$data['title'] = '[[LABEL_TRANSFER]]';
		userTemplate("member/transfer/index", $data);
	}

	public function confirm()
	{
		$this->MemberModel->check($this->session_key);
		if (!isset($_SESSION['transfer_process'])) {
			redirect(base_url("transfer"));
			exit;
		}
		if (count($_POST) > 0) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("transfer/index", $req);
			$data = $response['data'];
			$data['title'] = '[[LABEL_TRANSFER]]';
			$data['header_back_url'] = "transfer";
			$_POST['counter_currency'] = "RC";
			$data['post'] = $_POST;
			userTemplate("member/transfer/confirm", $data);
		} else {
			$data['title'] = '[[LABEL_TRANSFER]]';
			$data['header_back_url'] = "transfer";
			userTemplate("unknown", $data);
		}
	}

	public function process()
	{
		$this->MemberModel->check($this->session_key);
		if(!isset($_SESSION['transfer_process'])){
			redirect(base_url("transfer"));
			exit;
		}
		$data['title'] = '[[LABEL_TRANSFER]]';
		$data['header_back_url'] = "transfer";
		unset($_SESSION['transfer_process']);
		if (count($_POST) > 0) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$data['return'] = post_curl("transfer/process", $req);
			userTemplate("member/transfer/response", $data);
		} else {
			userTemplate("unknown", $data);
		}
	}

}
