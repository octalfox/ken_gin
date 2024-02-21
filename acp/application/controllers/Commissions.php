<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Commissions extends CI_Controller
{
	public function get($type, $period)
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$req['period'] = $period;
		$req['type'] = $type;
		$response = post_curl("admin/report/commissions", $req);
		$data['reports'] = $response['data'];
		userTemplate("pages/reports/commissions", $data);
	}
}
