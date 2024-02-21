<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoices extends CI_Controller
{
	public function index()
	{
		$_POST['access_token'] = $_SESSION['userSession'];
		if (!isset($_POST['selyrfrom'])) {
			$_POST['selyrfrom'] = date('Y', strtotime($_SESSION['logged']['join_date']));
			$_POST['selmonfrom'] = date('m', strtotime($_SESSION['logged']['join_date']));
			$_POST['selyrto'] = date('Y');
			$_POST['selmonto'] = date('m');
		}
		$data['member'] = $_SESSION['logged'];
		$data['reports'] = post_curl("invoice/index", $_POST)['data'];
		$data['title'] = '[[LABEL_INVOICES]]';
		userTemplate("member/invoices", $data);
	}
}
