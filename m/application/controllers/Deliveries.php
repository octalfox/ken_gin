<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deliveries extends CI_Controller
{
	public function index()
	{
		$_POST['access_token'] = $_SESSION['userSession'];
		if (!isset($_POST['do_status'])) {
			$_POST['do_status'] = 'ALL';
		}
		if (!isset($_POST['txtSearch'])) {
			$_POST['txtSearch'] = "";
		}
		$data['reports'] = post_curl("deliveries/index", $_POST)['data'];
		$data['title'] = '[[LABEL_INVOICES]]';
		userTemplate("member/deliveries", $data);
	}
}
