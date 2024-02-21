<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Banks extends CI_Controller
{
	public function index()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/banks/all", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/banks/list", $data);
	}

	public function add()
	{
		if (count($_POST)>0) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/banks/update", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_BANK_ADDED]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_BANK_FAILED]]"
				);
			}
			redirect(base_url("banks"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$data['banklist'] = post_curl("admin/banks/getBankList", $req)['data'];
		userTemplate("pages/banks/add", $data);
	}

	public function edit($id)
	{
		if (count($_POST)>0) {
			$_POST['id'] = $id;
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/banks/update", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_BANK_ADDED]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_BANK_FAILED]]"
				);
			}
			redirect(base_url("banks"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$data['bank'] = post_curl("admin/banks/get/$id", $req)['data'];
		$data['banklist'] = post_curl("admin/banks/getBankList", $req)['data'];
		userTemplate("pages/banks/add", $data);
	}

	public function delete($id)
	{
		$req = $_POST;
		$req['access_token'] = $_SESSION['userSession'];
		$req['id_to_delete'] = $id;
		$response = post_curl("admin/banks/delete", $req);
		if ($response['response'] == "success") {
			$_SESSION['alert'] = array(
				"class" => "success",
				"content" => "[[LABEL_BANK_DELETE]]"
			);
		} else {
			$_SESSION['alert'] = array(
				"class" => "danger",
				"content" => "[[LABEL_BANK_FAILED]]"
			);
		}
		redirect(base_url("banks"));
		exit;
	}
}
