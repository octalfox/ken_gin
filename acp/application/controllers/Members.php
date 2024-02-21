<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Members extends CI_Controller
{
	public function index()
	{
		$data = array();
		$data['access_token'] = $_SESSION['userSession'];
		$data["per_page"] = $this->config->item('per_page');
		$data["page"] = isset($_GET['page']) ? $_GET['page'] : 1;
		$data["userid"] = isset($_GET['userid']) ? $_GET['userid'] : "";
		$response = post_curl("admin/members/all", $data);
		$data['list'] = $response['data']['result'];
		$data['counter'] = $response['data']['counter'];
		$data['query'] = "?userid=" . $data['userid'] . "&";
		userTemplate("pages/members/list", $data);
	}

	public function add($userid = "", $side = '')
	{
		if (isset($_POST['mobile'])) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/members/add", $req);
//			$response = json_decode('{"response":"success","message":"[[SIGNUP_SUCCESSFULLY_WITH_ZERO_PACKAGE]]","data":{"sponsorid":"1","matrixid":"1","matrix_side":"L","userid":1006450,"rank":1,"f_name":"Atif","l_name":"Riaz","country":"194","mobile":"03254262710","package_id":"0","email":"atf@gmail.com","account_status":"ACTIVE","main_acct_id":0,"password":"0dda528f1c65b7d36e1049894b738edaf14e186f56ab163be102f59a63f485c02fb3abf61ce72e055a427ea5b5081e9d67f0253eb07cfed8a0d5380f5a381517","primary_salt":"89c4c9dcbb0e15cfb09a89cda5b4dad650cffb22835f040aa975b9ed0ec87cf86516cf1dc43e91d131dc192579fb82a01fcbd9fe1bef16cce811f2389bb00acf","sec_password":"","secondary_salt":"","id":6451}}');
			if ($response['response'] == 'success') {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_MEMBER_ADDED]]"
				);
				redirect(base_url("members/edit/" . $response['data']['userid']));
			} else {
				$msg = implode("<br>", $response['data']);
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => $msg
				);
				redirect(base_url("members/add"));
			}
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$req['mid'] = $userid;
		$req['side'] = $side;
		$req['packages'] = post_curl("admin/packages/all", $req)['data'];
		userTemplate("pages/members/add", $req);
	}

	public function response()
	{
		unset($_SESSION['temp_sponsor']);
		unset($_SESSION['temp_placement']);
		$data['return'] = $_SESSION['order_response'];
		userTemplate("pages/members/add/response", $data);
	}

	public function edit($userid)
	{
		if (isset($_POST['mobile'])) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			post_curl("admin/members/update/" . $userid, $req);
			$_SESSION['alert'] = array(
				"class" => "success",
				"content" => "[[LABEL_MEMBER_UPDATED]]"
			);
			redirect(base_url("members/edit/" . $userid));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$req['userid'] = $userid;
		$data = post_curl("admin/members/get", $req)['data'];;
		userTemplate("pages/members/edit", $data);
	}

	public function credit($userid)
	{
		if (isset($_POST['rc_amount'])) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			post_curl("admin/members/update_credits/" . $userid, $req);
			$_SESSION['alert'] = array(
				"class" => "success",
				"content" => "[[LABEL_MEMBER_CREDITS_UPDATES]]"
			);
			redirect(base_url("members/credit/" . $userid));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$req['userid'] = $userid;
		$data = post_curl("admin/members/get", $req)['data'];
		userTemplate("pages/members/credits", $data);
	}

}
