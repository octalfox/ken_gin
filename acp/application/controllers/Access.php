<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Access extends CI_Controller
{
	public function index()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/groups/all", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/access/list", $data);
	}

	public function change($id)
	{
		if(count($_POST) > 0){
			$req = $_POST;
			post_curl("admin/menu/permission/$id", $req);
			$_SESSION['alert'] = array(
				"class" => "success",
				"content" => "[[LABEL_PERMISSION_UPDATED]]"
			);
			redirect(base_url("access/change/$id"));
			exit;
		}
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$data['group'] = post_curl("admin/groups/get/$id", $req)['data'];
		$response = post_curl("admin/menu/get", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/access/access", $data);
	}
}
