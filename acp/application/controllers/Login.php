<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
		$data = array();
		if (isset($_SESSION['userSession'])) {
			$this->load->model("MemberModel");
			$user = $this->MemberModel->getLoggedInUser();
			if($user){
				redirect(base_url());
				exit;
			}
		}
		if (count($_POST) > 0) {
			$response = post_curl("admin/login/login_process", $_POST);
			if ($response['response'] == "success") {
				$_SESSION['userSession'] = $response['data'];
				redirect(base_url("login"));
				exit;
			} else {
				$_SESSION['notify_message'] = notify(
					"bg-danger",
					"[[LABEL_ERROR_FOUND]]",
					$response['message'],
					$response['data']
				);
			}
		}
		publicTemplate("guest/login", $data);
	}
}
