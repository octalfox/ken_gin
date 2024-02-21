<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{
	public function get($period)
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$req['period'] = $period;
		$response = post_curl("admin/report/sales", $req);
		$data['reports'] = $response['data'];
		userTemplate("pages/reports/sales", $data);
	}
}
