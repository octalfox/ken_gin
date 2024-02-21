<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Currencies extends CI_Controller
{
	public function index()
	{
		$data = array();
		if (count($_POST) > 0) {
			foreach ($_POST['data'] as $id => $d){
				foreach ($d as $col => $value){
					$req[$col.'%'.$id] = $value;
				}
			}
			foreach ($_POST['new'] as $d){
				$id++;
				foreach ($d as $col => $value){
					$req[$col.'%'.$id] = $value;
				}
			}
			$response = post_curl("admin/currencies/add", $req);
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
			redirect(base_url("currencies"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/currencies/all", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/currency/list", $data);
	}
}
