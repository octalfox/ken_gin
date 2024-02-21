<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ledger extends CI_Controller
{
	public function index($type)
	{
		$_GET["per_page"] = $this->config->item('per_page');
		$_GET["page"] = isset($_GET['page'])? $_GET['page'] : 1;
		$currency = $_GET['currency'] = isset($_GET['currency']) ? $_GET['currency'] : "CC";
		$selyrfrom = $_GET['selyrfrom'] = isset($_GET['selyrfrom']) ? $_GET['selyrfrom'] : date('Y');
		$selmonfrom = $_GET['selmonfrom'] = isset($_GET['selmonfrom']) ? $_GET['selmonfrom'] : date('m');
		$selyrto = $_GET['selyrto'] = isset($_GET['selyrto']) ? $_GET['selyrto'] : date('Y');
		$selmonto = $_GET['selmonto'] = isset($_GET['selmonto']) ? $_GET['selmonto'] : date('m');
		$member_id = $_GET['member_id'] = isset($_GET['member_id']) ? $_GET['member_id'] : "";

		$_GET['type'] = $data['type'] = $type;
		$data = $_GET;
		$response = post_curl("admin/report/ledger", $_GET);
		$data['list'] = $response['data']['result'];
		$data['counter'] = $response['data']['counter'];
		$data['currencies'] = post_curl("currencies/get", $_GET)['data'];
		$data['query'] = "?type=$type&currency=$currency&selyrfrom=$selyrfrom&selmonfrom=$selmonfrom&selyrto=$selyrto&selmonto=$selmonto&member_id=$member_id&";
      	if($type == 'sales'){
			userTemplate("pages/ledgers/sales", $data);
        } else {
			userTemplate("pages/ledgers/list", $data);
        }
	}
}
