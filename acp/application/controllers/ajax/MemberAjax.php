<?php

class MemberAjax extends CI_Controller
{
	public function details($userid)
	{
//		var_dump($userid);
		$req['access_token'] = $_SESSION['userSession'];
		$req['userid'] = $userid;
		$response = post_curl("admin/members/get", $req);
		$data['modal_body'] = $this->load->view("contents/user_details", $response, true);
//		$this->load->view("modals/general", $data);
		$v = $this->load->view("modals/general", $data, true);
		$languages = $_SESSION['available_tags'];
		foreach ($languages as $language) {
			if (!empty($language[$_SESSION['language']])) {
				$v = str_replace($language['template'], $language[$_SESSION['language']], $v);
			}
		}
		echo $v;
	}
}
