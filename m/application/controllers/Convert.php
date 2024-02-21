<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Convert extends CI_Controller
{
	public $session_key = "CONVERT_VERIFICATION";

	public function index()
	{
		$this->MemberModel->check($this->session_key);
		$_SESSION['convert_process'] = true;
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("convert/index", $req);
		$data = $response['data'];
		$data['alert'] = "[[MSG_CONVERSION_RULES]]";
		$data['title'] = '[[LABEL_CONVERT]]';
		userTemplate("member/convert/index", $data);
	}

	public function confirm()
	{
		$this->MemberModel->check($this->session_key);
		if (!isset($_SESSION['convert_process'])) {
			redirect(base_url("convert"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		if (count($_POST) > 0) {
			$response = post_curl("convert/index", $req);
			$data = $response['data'];
			$data['title'] = '[[LABEL_CONVERT]]';
			$data['header_back_url'] = "convert";
			$_POST['counter_currency'] = "RC";
			$_POST['counter_amount'] = $_POST['base_amount'];
			$data['post'] = $_POST;
			userTemplate("member/convert/confirm", $data);
		} else {
			$data['title'] = '[[LABEL_CONVERT]]';
			$data['header_back_url'] = "convert";
			userTemplate("unknown", $data);
		}
	}

	public function process()
	{
		$this->MemberModel->check($this->session_key);
		if(!isset($_SESSION['convert_process'])){
			redirect(base_url("convert"));
			exit;
		}
		$data['title'] = '[[LABEL_CONVERT]]';
		$data['header_back_url'] = "convert";
		unset($_SESSION['convert_process']);
		if (count($_POST) > 0) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$data['return'] = post_curl("convert/process", $req);
			userTemplate("member/convert/response", $data);
		} else {
			userTemplate("unknown", $data);
		}
	}

}
