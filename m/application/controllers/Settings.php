<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
	public function index()
	{
		$data = array();
		$data['title'] = "[[LABEL_SETTINGS]]";
		userTemplate("member/settings/index", $data);
	}

	public function profile()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$data['mem'] = post_curl("user/info", $req)['data'];
		$data['title'] = "[[LABEL_PROFILE]]";
		$data['header_back_url'] = "settings";
		userTemplate("member/settings/profile", $data);
	}

	public function share()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$data['title'] = "[[LABEL_SHARE]]";
		$data['header_back_url'] = "settings";
		userTemplate("member/settings/share", $data);
	}

	public function binary()
	{
		$data = array();
		if (count($_POST) > 0) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("binary/index", $req);
			if($response['response'] == 'success') {
				$_SESSION['notify_message'] = notify(
					"bg-success",
					"[[LABEL_BINARY_Y_TITLE]]",
					"[[LABEL_BINARY_Y_SUBTITLE]]",
					"[[LABEL_BINARY_Y_SUMMARY]]"
				);
			} else {
				$_SESSION['notify_message'] = notify(
					"bg-danger",
					"[[LABEL_BINARY_N_TITLE]]",
					"[[LABEL_BINARY_N_SUBTITLE]]",
					"[[LABEL_BINARY_N_SUMMARY]]"
				);
			}
		}
		$req['access_token'] = $_SESSION['userSession'];
		$data['member'] = post_curl("binary/get", $req)['data'];
		$data['header_back_url'] = "settings";
		userTemplate("member/settings/binary", $data);
	}

	public function banks()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$data['banks'] = post_curl("bank/index", $req)['data'];
		$data['title'] = "[[LABEL_BANK_LIST]]";
		$data['header_back_url'] = "settings";
		userTemplate("member/settings/bank/index", $data);
	}

	public function bank($id = null)
	{
		$_SESSION['bank_process'] = true;
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$req['bankid'] = $data['bankid'] = $id;
		$report = post_curl("bank/form", $req)['data'];
		$data['banks'] = $report['banklist'];
		$data['bank'] = $report['memberBank'];
		$data['mode'] = $id !== null ? "Edit" : "Add";
		$data['title'] = "[[LABEL_MEMBER_BANK_DETAIL]]";
		userTemplate("member/settings/bank/form", $data);
	}

	public function updateBank($id = null)
	{
		$data = array();
		if (count($_POST) > 0 and isset($_SESSION['bank_process'])) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$req['id'] = $id;
			$data['return'] = post_curl("bank/update", $req);
			unset($_SESSION['bank_process']);
			$data['header_back_url'] = "settings/banks";
			userTemplate("member/settings/bank/response", $data);
		} else {
			redirect(base_url("settings/banks"));
			exit;
		}
	}
}
