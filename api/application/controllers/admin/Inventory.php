<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{
	public function all()
	{
		$list['products'] = $this->ProductModel->getAllProducts();
		$list['POs'] = $this->InventoryModel->getAllPOs();
		return successReponse("", $list);
	}

	public function stock()
	{
		$list = $this->ProductModel->getAllProductStock();
		return successReponse("", $list);
	}

	public function add()
	{
		$this->InventoryModel->addPO($_POST);
		return successReponse("", '');
	}

	public function show($id)
	{
		$list['POs'] = $this->InventoryModel->getAllPOs($id);
		$list['details'] = $this->InventoryModel->getPosItems($id);
		return successReponse("", $list);
	}

}

