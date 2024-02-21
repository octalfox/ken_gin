<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Password extends CI_Controller
{
	public function index()
	{
		$data['title'] = "[[LABEL_LOST_PASSWORD]]";
		publicTemplate("guest/password_form", $data);
	}

	public function verify()
	{
		if (isset($_POST['userid'])) {
			$req = $_POST;
			$coded = post_curl("password/send_guest_sms", $req);
			if ($coded['response'] == 'success') {
				$otp['code'] = $coded['data']['code'];
				$otp['userid'] = $_POST['userid'];
				$_SESSION['temp_code'] = $otp;
				$otp['title'] = "[[LABEL_VERIFY_CODE]]";
				$_SESSION['notify_message'] = notify(
					"bg-success",
					"[[LABEL_SUCCESS_OTP_TITLE]]",
					"[[LABEL_SUCCESS_OTP_SUBTITLE]]",
					"[[LABEL_SUCCESS_OTP_SUMMARY]]"
				);
				publicTemplate("guest/verify_password", $otp);
				exit;
			} else {
				$_SESSION['notify_message'] = notify(
					"bg-danger",
					"[[LABEL_FAILED_OTP_TITLE]]",
					"[[LABEL_FAILED_OTP_SUBTITLE]]",
					"[[LABEL_FAILED_OTP_SUMMARY]]"
				);
			}
		}
		redirect(base_url("password"));
	}

	public function reset()
	{
		if (isset($_POST['otp'])) {
			if (trim($_POST['otp']) == trim($_SESSION['temp_code']['code'])) {
				publicTemplate("guest/reset_password", array());
			} else {
				$_SESSION['notify_message'] = notify(
					"bg-danger",
					"[[LABEL_OTP_MISMATCH_TITLE]]",
					"[[LABEL_OTP_MISMATCH_SUBTITLE]]",
					"[[LABEL_OTP_MISMATCH_SUMMARY]]"
				);
			}
		}
		redirect(base_url("password"));
	}

	public function process()
	{
		if (count($_POST) > 0) {
			if ($_POST['password'] == $_POST['conf_password']) {
				$req['password'] = $_POST["password"];
				$req['userid'] = $_SESSION['temp_code']['userid'];
				$response = post_curl("password/guest_reset", $req);
				if ($response['response'] == 'success') {
					$_SESSION['notify_message'] = notify(
						"bg-success",
						"[[LABEL_RESET_SUCCESS_TITLE]]",
						"[[LABEL_RESET_SUCCESS_SUBTITLE]]",
						"[[LABEL_RESET_SUCCESS_SUMMARY]]"
					);
					redirect(base_url("login"));
				} else {
					$_SESSION['notify_message'] = notify(
						"bg-danger",
						"[[LABEL_RESET_FAILED_TITLE]]",
						"[[LABEL_RESET_FAILED_SUBTITLE]]",
						"[[LABEL_RESET_FAILED_SUMMARY]]"
					);
					redirect(base_url("password"));
				}
			} else {
				$_SESSION['notify_message'] = notify(
					"bg-danger",
					"[[LABEL_PASSWORD_MATCH_TITLE]]",
					"[[LABEL_PASSWORD_MATCH_SUBTITLE]]",
					"[[LABEL_PASSWORD_MATCH_SUMMARY]]"
				);
				redirect(base_url("password"));
			}
		}
		redirect(base_url("login"));
	}
}
