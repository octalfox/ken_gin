<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
	public function summary()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$req['period'] = getMonth();
		if (isset($_POST['period'])) {
			$req['period'] = $_POST['period'];
		}
		$response = post_curl("admin/report/summary", $req);
		$data['period'] = $period = $req['period'];
		$data['reports'] = $response['data'];
		$data['query'] = "?period=$period&";
		userTemplate("pages/reports/summary", $data);
	}

	public function yearly()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/report/yearly", $req);
		$data['reports'] = $response['data'];
		userTemplate("pages/reports/yearly", $data);
	}

	public function year($year)
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$req['year'] = $year;
		$response = post_curl("admin/report/year", $req);
		$data['reports'] = $response['data'];
		userTemplate("pages/reports/year", $data);
	}

	public function month($month)
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$req['month'] = $month;
		$response = post_curl("admin/report/month", $req);
		$data['reports'] = $response['data'];
		userTemplate("pages/reports/month", $data);
	}

	public function star()
	{
		set_time_limit(0);
		ini_set('memory_limit', '1024M');
		ini_set('max_execution_time', '-1');
		ini_set('post_max_size ', '-1');
		$data['title'] = "[[ADM_STAR_REPORT]]";
		$data['star_reportx'] = true;

		$data["per_page"] = $this->config->item('per_page');
		$data["page"] = isset($_GET['page']) ? $_GET['page'] : 1;
		$data["userid"] = isset($_GET['userid']) ? $_GET['userid'] : "";
		$data['fl_rank'] = isset($_GET['fl_rank']) ? $_GET['fl_rank'] : 'any';
		$data['period'] = isset($_GET['period']) ? $_GET['period'] : date("Y-m");

		$data['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/report/star", $data);

		$data['list'] = $response['data']['result'];
		$data['counter'] = $response['data']['counter'];
		$data['query'] = "?userid=" . $data['userid'] . "&fl_rank=" . $data['fl_rank'] . "&period=" . $data['period'] . "&";
		userTemplate("pages/reports/star", $data);
	}

	public function commission()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/report/commissions", $req);
		$data['reports'] = $response['data'];
		userTemplate("pages/reports/commission_reporte", $data);
	}
}
