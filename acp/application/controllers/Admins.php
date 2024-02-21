<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admins extends CI_Controller
{
	public function index()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/admins/all", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/admins/list", $data);
	}

	public function add()
	{
		if (isset($_POST['group_id'])) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/admins/add", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_ADMIN_ADDED]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_ADMIN_FAILED]]"
				);
			}
			redirect(base_url("admins"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$data['list'] = post_curl("admin/admins/groups", $req)['data'];
		userTemplate("pages/admins/add", $data);
	}

	public function edit($userid)
	{
		if (isset($_POST['group_id'])) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/admins/add", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_ADMIN_ADDED]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_ADMIN_FAILED]]"
				);
			}
			redirect(base_url("admins"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$data['user'] = post_curl("admin/admins/get/$userid", $req)['data'];
		$data['list'] = post_curl("admin/admins/groups", $req)['data'];
		userTemplate("pages/admins/edit", $data);
	}

	public function delete($id)
	{
		$req = $_POST;
		$req['access_token'] = $_SESSION['userSession'];
		$req['id_to_delete'] = $id;
		$response = post_curl("admin/admins/delete", $req);
		if ($response['response'] == "success") {
			$_SESSION['alert'] = array(
				"class" => "success",
				"content" => "[[LABEL_ADMIN_DELETE]]"
			);
		} else {
			$_SESSION['alert'] = array(
				"class" => "danger",
				"content" => "[[LABEL_ADMIN_FAILED]]"
			);
		}
		redirect(base_url("admins"));
		exit;
	}
}
