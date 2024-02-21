<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deliveries extends CI_Controller
{
	public function index()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$data['orders'] = post_curl("admin/orders/get", $req)['data'];
		userTemplate("pages/orders/list", $data);
	}
}
