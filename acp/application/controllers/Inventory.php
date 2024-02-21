<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{
	public function index()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/inventory/all", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/inventory/index", $data);
	}

	public function view($id)
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/inventory/show/$id", $req);
		$data = $response['data'];
		userTemplate("pages/inventory/show", $data);
	}

	public function stock()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/inventory/stock", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/inventory/stock", $data);
	}

	public function add()
	{
		if (count($_POST) > 0) {
			$post['purchase_date'] = $_POST['purchase_date'];
			$post['description'] = $_POST['description'];
			$post['vendor'] = $_POST['vendor'];
			$post['payment_reference'] = $_POST['payment_reference'];
			$post['payment_mode'] = $_POST['payment_mode'];
			$post['products'] = json_encode($_POST['po']);
			$response = post_curl("admin/inventory/add", $post);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_PO_ADDED]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_PO_FAILED]]"
				);
			}
			redirect(base_url("inventory"));
			exit;
		}
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/inventory/all", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/inventory/add", $data);
	}

}
