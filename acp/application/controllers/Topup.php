<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Topup extends CI_Controller
{
	public function index()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/topup/get", $req);
		$data['topups'] = $response['data'];
		userTemplate("pages/topup/list", $data);
	}

	public function approve($topup_id = null)
	{
		if ($topup_id == null) {
			redirect("topups");
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$req['topup_id'] = $topup_id;
		$req['action'] = 'APPROVED';
		post_curl("admin/topup/action", $req)['data'];
		redirect(base_url("topup"));
	}

	public function reject($topup_id = null)
	{
		if ($topup_id == null) {
			redirect("topups");
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$req['topup_id'] = $topup_id;
		$req['action'] = 'REJECTED';
		post_curl("admin/topup/action", $req)['data'];
		redirect(base_url("topup"));
	}
}
