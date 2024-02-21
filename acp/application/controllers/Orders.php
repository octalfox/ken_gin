<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
	public function index()
	{
		$data = array();
		$data['access_token'] = $_SESSION['userSession'];
		$data["per_page"] = $this->config->item('per_page');

		$data["page"] = isset($_GET['page']) ? $_GET['page'] : 1;
		$data["userid"] = isset($_GET['userid']) ? $_GET['userid'] : "";
		$data["type"] = isset($_GET['type']) ? $_GET['type'] : "All";

		$response = post_curl("admin/orders/get", $data);
		$data['list'] = $response['data']['result'];
		$data['counter'] = $response['data']['counter'];
		$data['query'] = "?userid=" . $data['userid'] . "&type=" . $data['type'] . "&";
		userTemplate("pages/orders/list", $data);
	}

	public function details($order_master_id = null)
	{
		if ($order_master_id == null) {
			redirect("orders");
			exit;
		}
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$req['order_id'] = $order_master_id;
		$data['order'] = post_curl("admin/orders/details", $req)['data'];
		userTemplate("pages/orders/detail", $data);
	}

	public function approve($order_master_id = null)
	{
		if ($order_master_id == null) {
			redirect("orders");
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$req['order_id'] = $order_master_id;
		$req['action'] = 'approved';
		post_curl("admin/orders/action", $req)['data'];
		redirect(base_url("orders/details/" . $order_master_id));
	}

	public function deliver($order_master_id = null)
	{
		if ($order_master_id == null) {
			redirect("orders");
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$req['order_id'] = $order_master_id;
		$req['action'] = 'received';
		post_curl("admin/orders/action", $req)['data'];
		redirect(base_url("orders/details/" . $order_master_id));
	}

	public function reject($order_master_id = null)
	{
		if ($order_master_id == null) {
			redirect("orders");
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$req['order_id'] = $order_master_id;
		$req['action'] = 'cancelled';
		post_curl("admin/orders/action", $req)['data'];
		redirect(base_url("orders/details/" . $order_master_id));
	}
}
