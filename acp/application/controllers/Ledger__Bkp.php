<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ledger extends CI_Controller
{
	public function index($type)
	{
		$_GET["per_page"] = $this->config->item('per_page');
		$_GET["page"] = isset($_GET['page'])? $_GET['page'] : 1;
		$_GET['currency'] = isset($_GET['currency']) ? $_GET['currency'] : "CC";
		$_GET['selyrfrom'] = isset($_GET['selyrfrom']) ? $_GET['selyrfrom'] : date('Y');
		$_GET['selmonfrom'] = isset($_GET['selmonfrom']) ? $_GET['selmonfrom'] : date('m');
		$_GET['selyrto'] = isset($_GET['selyrto']) ? $_GET['selyrto'] : date('Y');
		$_GET['selmonto'] = isset($_GET['selmonto']) ? $_GET['selmonto'] : date('m');
		$_GET['member_id'] = isset($_GET['member_id']) ? $_GET['member_id'] : "";

		$_GET['type'] = $data['type'] = strtoupper($type);

		$data['reports'] = post_curl("admin/report/ledger", $_GET)['data'];
		$data['currencies'] = post_curl("currencies/get", $_GET)['data'];
		userTemplate("pages/ledgers/list", $data);
	}

	public function sales()
	{
		$_GET["per_page"] = $this->config->item('per_page');
		$_GET["page"] = isset($_GET['page'])? $_GET['page'] : 1;
		$_GET['currency'] = isset($_GET['currency']) ? $_GET['currency'] : "CC";
		$_GET['selyrfrom'] = isset($_GET['selyrfrom']) ? $_GET['selyrfrom'] : date('Y');
		$_GET['selmonfrom'] = isset($_GET['selmonfrom']) ? $_GET['selmonfrom'] : date('m');
		$_GET['selyrto'] = isset($_GET['selyrto']) ? $_GET['selyrto'] : date('Y');
		$_GET['selmonto'] = isset($_GET['selmonto']) ? $_GET['selmonto'] : date('m');
		$_GET['member_id'] = isset($_GET['member_id']) ? $_GET['member_id'] : "";

		$_GET['type'] = "sales";

		$data['reports'] = post_curl("admin/report/ledger", $_GET)['data'];
		$data['currencies'] = post_curl("currencies/get", $_GET)['data'];
		userTemplate("pages/ledgers/sales", $data);
	}

	public function withdrawals()
	{
		$_GET["per_page"] = $this->config->item('per_page');
		$_GET["page"] = isset($_GET['page'])? $_GET['page'] : 1;
		$_GET['currency'] = isset($_GET['currency']) ? $_GET['currency'] : "CC";
		$_GET['selyrfrom'] = isset($_GET['selyrfrom']) ? $_GET['selyrfrom'] : date('Y');
		$_GET['selmonfrom'] = isset($_GET['selmonfrom']) ? $_GET['selmonfrom'] : date('m');
		$_GET['selyrto'] = isset($_GET['selyrto']) ? $_GET['selyrto'] : date('Y');
		$_GET['selmonto'] = isset($_GET['selmonto']) ? $_GET['selmonto'] : date('m');
		$_GET['member_id'] = isset($_GET['member_id']) ? $_GET['member_id'] : "";

		$_GET['type'] = "withdrawals";
		$data['reports'] = post_curl("admin/report/ledger", $_GET)['data'];
		$data['currencies'] = post_curl("currencies/get", $_GET)['data'];
		userTemplate("pages/ledgers/withdrawals", $data);
	}

	public function transfers()
	{
		$_GET["per_page"] = $this->config->item('per_page');
		$_GET["page"] = isset($_GET['page'])? $_GET['page'] : 1;
		$_GET['currency'] = isset($_GET['currency']) ? $_GET['currency'] : "CC";
		$_GET['selyrfrom'] = isset($_GET['selyrfrom']) ? $_GET['selyrfrom'] : date('Y');
		$_GET['selmonfrom'] = isset($_GET['selmonfrom']) ? $_GET['selmonfrom'] : date('m');
		$_GET['selyrto'] = isset($_GET['selyrto']) ? $_GET['selyrto'] : date('Y');
		$_GET['selmonto'] = isset($_GET['selmonto']) ? $_GET['selmonto'] : date('m');
		$_GET['member_id'] = isset($_GET['member_id']) ? $_GET['member_id'] : "";

		$_GET['type'] = "transfers";
		$data['reports'] = post_curl("admin/report/ledger", $_GET)['data'];
		$data['currencies'] = post_curl("currencies/get", $_GET)['data'];
		userTemplate("pages/ledgers/transfers", $data);
	}

	public function converts()
	{
		$_GET["per_page"] = $this->config->item('per_page');
		$_GET["page"] = isset($_GET['page'])? $_GET['page'] : 1;
		$_GET['currency'] = isset($_GET['currency']) ? $_GET['currency'] : "CC";
		$_GET['selyrfrom'] = isset($_GET['selyrfrom']) ? $_GET['selyrfrom'] : date('Y');
		$_GET['selmonfrom'] = isset($_GET['selmonfrom']) ? $_GET['selmonfrom'] : date('m');
		$_GET['selyrto'] = isset($_GET['selyrto']) ? $_GET['selyrto'] : date('Y');
		$_GET['selmonto'] = isset($_GET['selmonto']) ? $_GET['selmonto'] : date('m');
		$_GET['member_id'] = isset($_GET['member_id']) ? $_GET['member_id'] : "";

		$_GET['type'] = "converts";
		$data['reports'] = post_curl("admin/report/ledger", $_GET)['data'];
		$data['currencies'] = post_curl("currencies/get", $_GET)['data'];
		userTemplate("pages/ledgers/converts", $data);
	}

	public function commissions()
	{
		$_GET["per_page"] = $this->config->item('per_page');
		$_GET["page"] = isset($_GET['page'])? $_GET['page'] : 1;
		$_GET['currency'] = isset($_GET['currency']) ? $_GET['currency'] : "CC";
		$_GET['selyrfrom'] = isset($_GET['selyrfrom']) ? $_GET['selyrfrom'] : date('Y');
		$_GET['selmonfrom'] = isset($_GET['selmonfrom']) ? $_GET['selmonfrom'] : date('m');
		$_GET['selyrto'] = isset($_GET['selyrto']) ? $_GET['selyrto'] : date('Y');
		$_GET['selmonto'] = isset($_GET['selmonto']) ? $_GET['selmonto'] : date('m');
		$_GET['member_id'] = isset($_GET['member_id']) ? $_GET['member_id'] : "";

		$_GET['type'] = "commissions";
		$data['reports'] = post_curl("admin/report/ledger", $_GET)['data'];
		$data['currencies'] = post_curl("currencies/get", $_GET)['data'];
		userTemplate("pages/ledgers/commissions", $data);
	}

	public function topups()
	{
		$_GET["per_page"] = $this->config->item('per_page');
		$_GET["page"] = isset($_GET['page'])? $_GET['page'] : 1;
		$_GET['currency'] = isset($_GET['currency']) ? $_GET['currency'] : "CC";
		$_GET['selyrfrom'] = isset($_GET['selyrfrom']) ? $_GET['selyrfrom'] : date('Y');
		$_GET['selmonfrom'] = isset($_GET['selmonfrom']) ? $_GET['selmonfrom'] : date('m');
		$_GET['selyrto'] = isset($_GET['selyrto']) ? $_GET['selyrto'] : date('Y');
		$_GET['selmonto'] = isset($_GET['selmonto']) ? $_GET['selmonto'] : date('m');
		$_GET['member_id'] = isset($_GET['member_id']) ? $_GET['member_id'] : "";

		$_GET['type'] = "topups";
		$data['reports'] = post_curl("admin/report/ledger", $_GET)['data'];
		$data['currencies'] = post_curl("currencies/get", $_GET)['data'];
		userTemplate("pages/ledgers/topups", $data);
	}
}
