<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InventoryModel extends CI_Model
{
	public function getAllPOs($id = null)
	{
		if ($id) {
			$this->db->where("id", $id);
		}
		$query = $this->db->get('inventory');
		if ($id) {
			return $query->row_array();
		} else {
			return $query->result_array();
		}
	}
	public function getPosItems($id)
	{
		$this->db->select("product.name, inventory_items.*");
		$this->db->join('product', 'product.id = inventory_items.product_id');
		$this->db->where("inventory_id", $id);
		$query = $this->db->get('inventory_items');
		return $query->result_array();
	}
	public function addPO($post)
	{
		$product = json_decode($post['products'], true);
		unset($post['products']);
		$post['po_number'] = "PO" . time();
		$this->db->insert("inventory", $post);
		$po_id = $this->db->insert_id();

		foreach ($product['product_id'] as $key => $value){
			$detail['inventory_id'] = $po_id;
			$detail['product_id'] = $product['product_id'][$key];
			$detail['quantity'] = $product['quantity'][$key];
			$detail['unit_price'] = $product['unit_price'][$key];
			$detail['fee'] = $product['fee'][$key];
			$detail['tax'] = $product['tax'][$key];
			$po_id = $this->db->insert("inventory_items", $detail);
		}
	}

}
