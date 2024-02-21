<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MemberModel extends CI_Model
{
	public function getLoggedInUser()
	{
		$response = get_curl("login/login_info/" . $_SESSION['userSession']);
		if ($response['response'] == 'success') {
			$_SESSION['logged'] = $response['data'];
			return true;
		}
		return false;
	}

	public function check($ses)
	{
		if($_SESSION['constants'][$ses] == 0){
			return true;
		}
		if (!isset($_SESSION[$ses])) {
			if (isset($_POST['secpassreqcheck'])) {
              	if($_POST['secpassreqcheck'] == GlobalSecurityPassword){
                	return true;
                }
				$req['access_token'] = $_SESSION['userSession'];
				$req['password'] = $_POST['secpassreqcheck'];
				$response = post_curl("login/check", $req);
				if ($response['response'] == 'success') {
					$_SESSION[$ses] = $response['data'];
				} else {
					$tt['title'] = '[[LABEL_CONFIRM_SECONDARY_PASSWORD]]';
					return userTemplate("member/confirm", $tt);
					exit;
				}
			}
		}
		if (!isset($_SESSION[$ses])) {
			$tt['title'] = '[[LABEL_CONFIRM_SECONDARY_PASSWORD]]';
			return userTemplate("member/confirm", $tt);
			exit;
		}
	}

}
