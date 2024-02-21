<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Groups extends CI_Controller
{
	public function index()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/groups/all", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/groups/list", $data);
	}

	public function add()
	{
		if (isset($_POST['name'])) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/groups/add", $req);
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
			redirect(base_url("groups"));
			exit;
		}
		userTemplate("pages/groups/add", array());
	}

	public function edit($userid)
	{
		if (isset($_POST['name'])) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/groups/add", $req);
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
			redirect(base_url("groups"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$data['group'] = post_curl("admin/groups/get/$userid", $req)['data'];
//		$data['list'] = post_curl("admin/groups/groups", $req)['data'];
		userTemplate("pages/groups/edit", $data);
	}

	public function delete($id)
	{
		$req = $_POST;
		$req['access_token'] = $_SESSION['userSession'];
		$req['id_to_delete'] = $id;
		$response = post_curl("admin/groups/delete", $req);
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
		redirect(base_url("groups"));
		exit;
	}
}
