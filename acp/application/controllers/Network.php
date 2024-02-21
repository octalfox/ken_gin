<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Network extends CI_Controller
{
	public function binary($userid = "")
	{
		$data = array();

		if (isset($_POST['txtSearch'])) {
			$data['txtSearch'] = $_POST['txtSearch'];
		} elseif($userid == "") {
			$data['txtSearch'] = "1000000";
		} else {
			$data['txtSearch'] = $userid;
		}
		userTemplate("pages/network/binary", $data);
	}

	public function sponsored($userid = "")
	{
		$req['access_token'] = $_SESSION['userSession'];
		if (isset($_POST['txtSearch'])) {
			$data['txtSearch'] = $_POST['txtSearch'];
		} else {
			$data['txtSearch'] = ($userid == "" ? "1000000" : $userid);
        }
//		$response = post_curl("network/admin_sponsored", $req);
//		$data['members'] = $response['data'];
		userTemplate("pages/network/sponsored", $data);
	}

	public function get_sponsored($userid)
	{
		$req['access_token'] = $_SESSION['userSession'];
		$req['target'] = $userid;
		$response = post_curl("network/admin_sponsored", $req);
		$data['members'] = $response['data'];
		return $this->load->view("pages/network/spon_tree", $data);
	}
}
