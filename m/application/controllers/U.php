<?php
defined('BASEPATH') or exit('No direct script access allowed');

class U extends CI_Controller
{

	public function index($userid)
	{
		if (count($_POST) > 0) {
			$_SESSION['TSGUP'] = $_POST;
			redirect(base_url("signup/package"));
		}
		$response = post_curl("signup/getuser/$userid", array());
		if($response['response'] == 'success'){
			publicTemplate("guest/signup/index", $response['data']);
		} else {
			$_SESSION['notify_message'] = notify(
				"bg-danger",
				"[[LABEL_INVALID_SPONSOR_TITLE]]",
				"[[LABEL_INVALID_SPONSOR_SUBTITLE]]",
				"[[LABEL_INVALID_SPONSOR_SUMMARY]]"
			);
			redirect(base_url("login"));
			exit;
		}
	}
}
