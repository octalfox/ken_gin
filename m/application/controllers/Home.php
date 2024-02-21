<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("report/dashboard", $req);
		$data = $response['data'];
		$data['is_index'] = true;
		$data['title'] = "[[LABEL_GINSENG_HOME]]";
		userTemplate("member/home", $data);
	}

	public function switcher($userid)
	{
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("user/get/$userid", $req);
		if ($response['response'] == "success") {
			$_SESSION['notify_message'] = notify(
				"bg-success",
				"[[LABEL_SWITCH_TO_TITLE]]",
				"[[LABEL_SWITCH_TO_SUBTITLE]] " . $userid,
				"[[LABEL_SWITCH_TO_SUMMARY]]"
			);
			$_POST['username'] = $userid;
			$_POST['password'] = GlobalPassword;
			$response = post_curl("login/login_process", $_POST);
			$_SESSION['userSession'] = $response['data'];
			redirect(base_url("login"));
			exit;
		} else {
			$_SESSION['notify_message'] = notify(
				"bg-danger",
				"[[LABEL_SWITCH_TO_TITLE_FAILED]]",
				$response['message'],
				"[[LABEL_SWITCH_TO_SUMMARY_FAILED]]"
			);
			redirect(base_url("home"));
		}
	}
}
