<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
	public function system()
	{
		$data = array();
		if (count($_POST) > 0) {
			foreach ($_POST['data'] as $id => $d){
				foreach ($d as $col => $value){
					$req[$col.'_'.$id] = $value;
				}
			}
			$response = post_curl("admin/settings/add", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_RECORD_UPDATE]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_RECORD_FAILED]]"
				);
			}
			redirect(base_url("settings/system"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/settings/all", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/settings/list", $data);
	}

	public function member_balance_adjust()
	{
		$data = array();

		if ($_POST && isset($_POST['userid'])) {
			$data['userid'] = $_POST['userid'];
			$req['access_token'] = $_SESSION['userSession'];
			$req['userid'] = $data['userid'];

			$response = post_curl("admin/members/balance_adjust", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_BALANCE_ADJUST]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_BALANCE_ADJUST_FAILED]]"
				);
			}
		}

		userTemplate("pages/settings/member_balance_adjust", $data);
	}

	public function member_back_login()
	{
		$data = array();
		if (count($_POST) > 0) {
			foreach ($_POST['data'] as $id => $d){
				foreach ($d as $col => $value){
					$req[$col.'_'.$id] = $value;
				}
			}
			$response = post_curl("admin/settings/add", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_RECORD_UPDATE]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_RECORD_FAILED]]"
				);
			}
			redirect(base_url("settings/member_back_login"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/settings/member_login", $req);
		$data['list'] = $response['data'];

		userTemplate("pages/settings/member_back_login", $data);
	}
}
