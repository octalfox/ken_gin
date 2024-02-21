<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Network extends CI_Controller
{
	public function sponsored()
	{
		$user = $this->MemberModel->getMemberInfoByToken($_POST['access_token']);
		$target = $_POST['target'];
		if ($target != "") {
			$target_user = $this->MemberModel->getMemberInfoByIdUseridEmail($target);
			if (isset($target_user['id'])) {
				if (!$this->DownlineModel->checkDownlineRelationship($user['id'], $target_user['id'])) {
					$_SESSION['warning'] = "[[LABEL_NOT_IN_DOWNLINE]]";
					$target_user = $user;
				}
			} else {
				$target_user = $user;
			}
		} else {
			$target_user = $user;
		}
		$report = $this->NetworkModel->getSponsorNetwork($target_user['id']);
		return successReponse("", $report);
	}

	public function binary()
	{
		$user = $this->MemberModel->getMemberInfoByToken($_POST['access_token']);
		$target = $_POST['target'];
		return $this->NetworkModel->getBinary($user, $target);
	}

	public function admin_binary()
	{
		$user = $this->MemberModel->getMemberInfoByIdUseridEmail($_POST['userid']);
		$target = $_POST['target'];
		return $this->NetworkModel->getBinary($user, $target);
	}

	public function admin_sponsored()
	{
//      dd($_POST);
		$user = $this->MemberModel->getMemberInfoByUserid($_POST['target']);
//      dd($user);
		$target = $_POST['target'];
		return $this->NetworkModel->getSponsoredTree($user, $target);
	}
}
