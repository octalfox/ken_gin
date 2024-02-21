<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Announcements extends CI_Controller
{
	public function index()
	{
		$_POST['access_token'] = $_SESSION['userSession'];
		$data['reports'] = post_curl("announcement/index", $_POST)['data'];
		$data['title'] = '[[LABEL_INVOICES]]';
		userTemplate("member/announcements/list", $data);
	}
	public function get($id)
	{
		$_POST['access_token'] = $_SESSION['userSession'];
		$_POST['id'] = $id;
		$data['report'] = post_curl("announcement/index", $_POST)['data'];
		$data['title'] = '[[LABEL_INVOICES]]';
		userTemplate("member/announcements/single", $data);
	}
}
