<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rank extends CI_Controller
{

	public function tally($userid = "")
	{
		$req['access_token'] = $_SESSION['userSession'];
		$req['target'] = ($userid == "" ? "1000000" : $userid);
		if (isset($_POST['txtSearch'])) {
			$req['target'] = $data['txtSearch'] = $_POST['txtSearch'];
		}
		$response = post_curl("admin/rank/tally", $req)['data'];
		userTemplate("pages/rank/tally", $response);
	}
}
