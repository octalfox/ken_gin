<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reset extends CI_Controller
{

	public function primary_password()
	{
		$data = array();
		if (count($_POST) > 0) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("password/primary", $req);
			if($response['response'] == 'success') {
				$_SESSION['notify_message'] = notify(
					"bg-success",
					"[[LABEL_PASS_Y_SUCCESS_TITLE]]",
					$response['message'],
					"[[LABEL_PASS_Y_SUCCESS_SUMMARY]]"
				);
			} else {
				$_SESSION['notify_message'] = notify(
					"bg-danger",
					"[[LABEL_PASS_N_FAILED_TITLE]]",
					$response['message'],
					"[[LABEL_PASS_N_FAILED_SUMMARY]]"
				);
			}
		}
		$data['title'] = "[[LABEL_RESET_PRIMARY_PASSWORD]]";
		$data['header_back_url'] = "settings";
		userTemplate("member/password/primary_password", $data);
	}

	public function secondary_password()
	{
		$data = array();
		if (count($_POST) > 0) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("password/s_primary", $req);
			if($response['response'] == 'success') {
				$_SESSION['notify_message'] = notify(
					"bg-success",
					"[[LABEL_PASS_Y_SUCCESS_TITLE]]",
					$response['message'],
					"[[LABEL_PASS_Y_SUCCESS_SUMMARY]]"
				);

			} else {
				$_SESSION['notify_message'] = notify(
					"bg-danger",
					"[[LABEL_PASS_N_FAILED_TITLE]]",
					$response['message'],
					"[[LABEL_PASS_N_FAILED_SUMMARY]]"
				);
			}
		}
		$data['title'] = "[[LABEL_RESET_SECURITY_PASSWORD]]";
		$data['header_back_url'] = "settings";
		userTemplate("member/password/secondary_password", $data);
	}

	public function reset_secondary_password()
	{
		$data = array();
		if(count($_POST)>0) {
			if (isset($_POST['conf_sec_password'])) {
				$req = $_POST;
				$req['access_token'] = $_SESSION['userSession'];
				$coded = post_curl("password/send_sms", $req);
				if ($coded['response'] == 'success') {
					$otp['code'] = $coded['data']['code'];
					$otp['sec_password'] = $coded['data']['sec_password'];
					$otp['conf_sec_password'] = $coded['data']['conf_sec_password'];
					$_SESSION['temp_code'] = $otp;
					$otp['title'] = "[[LABEL_VERIFY_CODE]]";
					$otp['header_back_url'] = "settings/secondary_password";
					userTemplate("member/password/reset_secondary_password_otp", $otp);
					exit;
				}
			}
			if (isset($_POST['sec_password_otp'])) {
				if (trim($_POST['sec_password_otp']) == trim($_SESSION['temp_code']['code'])) {
					$req = $_SESSION['temp_code'];
					$req['access_token'] = $_SESSION['userSession'];
					$response = post_curl("password/verify", $req);
					if ($response['response'] == 'success') {
						$_SESSION['notify_message'] = notify(
							"bg-success",
							"[[LABEL_PASS_Y_OTP_TITLE]]",
							$response['message'],
							"[[LABEL_PASS_Y_OTP_SUMMARY]]"
						);
					} else {
						$_SESSION['notify_message'] = notify(
							"bg-danger",
							"[[LABEL_PASS_N_OTP_TITLE]]",
							$response['message'],
							"[[LABEL_PASS_N_OTP_SUMMARY]]"
						);
					}
				} else {
					$_SESSION['notify_message'] = notify(
						"bg-danger",
						"[[LABEL_PASS_N_OTP_TITLE]]",
						"[[LABEL_VERIFICATION_FAILED]]",
						"[[LABEL_PASS_N_OTP_SUMMARY]]"
					);
				}
				unset($_SESSION['temp_code']);
				redirect(base_url("reset/reset_secondary_password"));
				exit;
			}
		}
		$data['title'] = "[[LABEL_RESET_SECURITY_PASSWORD]]";
		$data['header_back_url'] = "settings/secondary_password";
		userTemplate("member/password/reset_secondary_password", $data);
	}
}
