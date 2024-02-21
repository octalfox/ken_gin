<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Withdrawal extends CI_Controller
{
	public function index()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/withdrawal/get", $req);
		$data['withdrawals'] = $response['data'];
		userTemplate("pages/withdrawal/list", $data);
	}

	public function approve($withdrawal_id = null)
	{
		if ($withdrawal_id == null) {
			redirect("withdrawal");
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$req['withdrawal_id'] = $withdrawal_id;
		$req['action'] = 'approved';
		post_curl("admin/withdrawal/action", $req)['data'];
		redirect(base_url("withdrawal"));
	}

	public function reject($withdrawal_id = null)
	{
		if ($withdrawal_id == null) {
			redirect("withdrawal");
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$req['withdrawal_id'] = $withdrawal_id;
		$req['action'] = 'reject';
		post_curl("admin/withdrawal/action", $req)['data'];
		redirect(base_url("withdrawal"));
	}

	public function hold($withdrawal_id = null)
	{
		if ($withdrawal_id == null) {
			redirect("withdrawal");
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$req['withdrawal_id'] = $withdrawal_id;
		$req['action'] = 'hold';
		post_curl("admin/withdrawal/action", $req)['data'];
		redirect(base_url("withdrawal"));
	}
}
