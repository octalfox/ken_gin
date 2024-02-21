<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	public function index()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/products/all", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/products/list", $data);
	}

	public function add()
	{
		if (isset($_POST['name'])) {
			$req = $_POST;
			if(isset($_FILES['fileimg']['tmp_name'])) {
				$req['extension'] = pathinfo($_FILES['fileimg']['name'], PATHINFO_EXTENSION);
				$req['filedata'] = file_get_contents($_FILES['fileimg']['tmp_name']);
			}
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/products/add", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_PRODUCT_ADDED]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_PRODUCT_FAILED]]"
				);
			}
			redirect(base_url("products"));
			exit;
		}
		userTemplate("pages/products/add", array());
	}

	public function edit($id)
	{
		if (isset($_POST['name'])) {
			$req = $_POST;
			if(isset($_FILES['fileimg']['tmp_name'])) {
				$req['extension'] = pathinfo($_FILES['fileimg']['name'], PATHINFO_EXTENSION);
				$req['filedata'] = file_get_contents($_FILES['fileimg']['tmp_name']);
			}
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/products/add", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_PRODUCT_ADDED]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_PRODUCT_FAILED]]"
				);
			}
			redirect(base_url("products"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$data['prod'] = post_curl("admin/products/get/$id", $req)['data'];
		userTemplate("pages/products/edit", $data);
	}

	public function delete($id)
	{
		$req = $_POST;
		$req['access_token'] = $_SESSION['userSession'];
		$req['id_to_delete'] = $id;
		$response = post_curl("admin/products/delete", $req);
		if ($response['response'] == "success") {
			$_SESSION['alert'] = array(
				"class" => "success",
				"content" => "[[LABEL_PRODUCT_DELETE]]"
			);
		} else {
			$_SESSION['alert'] = array(
				"class" => "danger",
				"content" => "[[LABEL_PRODUCT_FAILED]]"
			);
		}
		redirect(base_url("products"));
		exit;
	}
}
