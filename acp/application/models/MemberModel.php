<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MemberModel extends CI_Model
{
	public function getLoggedInUser()
	{
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/login/admin_login_info", $req);
		if ($response['response'] == 'success') {
			$_SESSION['logged'] = $response['data'];
			return true;
		}
		return false;
	}

	public function getMemberByUserID($_userid)
    {
        if ($_userid != "public" && $_userid != "favicon.ico") {
			$req['access_token'] = $_SESSION['userSession'];
			$data['user'] = post_curl("admin/admins/get/$_userid", $req)['data'];
        } else {
            return array();
        }
    }

}
