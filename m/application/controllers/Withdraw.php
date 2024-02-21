<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Withdraw extends CI_Controller
{
	public $session_key = "WITHDRAW_VERIFICATION";

	public function index()
	{
		$this->MemberModel->check($this->session_key);
		$_SESSION['withdrawal_process'] = true;
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("withdraw/index", $req);
		$data = $response['data'];
		$data['alert'] = "[[MSG_WITHDRAWAL_RULES]]";
		$data['title'] = '[[LABEL_WITHDRAW]]';
		userTemplate("member/withdraw/index", $data);
	}

	public function confirm()
	{
		$this->MemberModel->check($this->session_key);
		if (!isset($_SESSION['withdrawal_process'])) {
			redirect(base_url("withdraw"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("withdraw/index", $req);
		$data = $response['data'];
		$data['title'] = '[[LABEL_WITHDRAW]]';
		$data['header_back_url'] = "withdraw";
		if (count($_POST) > 0) {
			$data['alert'] = "[[MSG_WITHDRAWAL_RULES]]";
			userTemplate("member/withdraw/confirm", $data);
		} else {
			userTemplate("unknown", $data);
		}
	}

	public function process()
	{
		$this->MemberModel->check($this->session_key);
		if (!isset($_SESSION['withdrawal_process'])) {
			redirect(base_url("withdraw"));
			exit;
		}
		$data['title'] = '[[LABEL_WITHDRAW]]';
		$data['header_back_url'] = "withdraw";
		unset($_SESSION['withdrawal_process']);
		if (count($_POST) > 0) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$data['return'] = post_curl("withdraw/process", $req);
			userTemplate("member/withdraw/response", $data);
		} else {
			userTemplate("unknown", $data);
		}
	}

}
