<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ranks extends CI_Controller
{
	public function index()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("report/ranks", $req);
		$data = $response['data'];
		$data['title'] = "[[LABEL_RANK_TALLY]]";
		userTemplate("member/ranks", $data);
	}
}
