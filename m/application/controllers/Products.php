<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	public function index()
	{
		$_POST['access_token'] = $_SESSION['userSession'];
		$data['reports'] = post_curl("product/index", $_POST)['data'];
		$data['title'] = '[[LABEL_PRODUCTS]]';
		userTemplate("member/products/list", $data);
	}

	public function get($id)
	{
		$_POST['access_token'] = $_SESSION['userSession'];
		$_POST['id'] = $id;
		$data['product'] = post_curl("product/index", $_POST)['data'];
		$data['title'] = '[[LABEL_PRODUCTS]]';
		userTemplate("member/products/single", $data);
	}
}
