<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{
	public function index()
	{
		$data = array();
		$data['title'] = "[[LABEL_REPORTS]]";
		userTemplate("member/reports/index", $data);
	}

	public function ledger()
	{
		$_POST['access_token'] = $_SESSION['userSession'];
		if (!isset($_POST['selyrfrom'])) {
			$_POST['currency'] = "CC";
			$_POST['selyrfrom'] = date('Y', strtotime($_SESSION['logged']['join_date']));
			$_POST['selmonfrom'] = date('m', strtotime($_SESSION['logged']['join_date']));
			$_POST['selyrto'] = date('Y');
			$_POST['selmonto'] = date('m');
		}
		$data['reports'] = post_curl("report/ledger", $_POST)['data'];
		$data['currencies'] = post_curl("currencies/get", $_POST)['data'];
		$data['member'] = $_SESSION['logged'];
		$data['title'] = "[[LABEL_MEMBER_LEDGER]]";
		$data['header_back_url'] = "reports";
		userTemplate("member/reports/ledger", $data);
	}

	public function withdrawal()
	{
		$_POST['access_token'] = $_SESSION['userSession'];
		$data['reports'] = post_curl("report/withdrawal", $_POST)['data'];
		$data['member'] = $_SESSION['logged'];
		$data['title'] = "[[LABEL_MEMBER_WITHDRAWALS]]";
		$data['header_back_url'] = "reports";
		userTemplate("member/reports/withdrawal", $data);
	}

	public function commissions()
	{
		$data['title'] = "[[LABEL_MEMBER_COMMISSIONS]]";
		$data['header_back_url'] = "reports";
		$_POST['access_token'] = $_SESSION['userSession'];
		$data['report'] = post_curl("report/commission_summary", $_POST)['data'];
		userTemplate("member/reports/commission/index", $data);
	}

	public function commission($type, $period)
	{
		$data['title'] = "[[LABEL_MEMBER_COMMISSIONS]]";
		$data['header_back_url'] = "reports/commissions";
		$_POST['access_token'] = $_SESSION['userSession'];
		$data['reports'] = post_curl("report/commission/$type/$period", $_POST)['data'];
		$data['comm_type'] = $type;
		userTemplate("member/reports/commission/details", $data);
	}
}
