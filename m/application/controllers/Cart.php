<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
	public function index()
	{
		if(isset($_SESSION['order_response'])){
			unset($_SESSION['order_response']);
		}
		$_POST['access_token'] = $_SESSION['userSession'];
		$data = post_curl("cart/get", $_POST)['data'];
		$data['title'] = '[[LABEL_PRODUCTS]]';
		userTemplate("member/products/cart", $data);
	}
}
