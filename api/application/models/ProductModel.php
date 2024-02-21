<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductModel extends CI_Model
{
	private $tblProduct = 'product';

	public function getProduct($post)
	{
		if (isset($post['id'])) {
			$this->db->where("id", $post['id']);
		}
		$this->db->where("type_id", 2);
		$this->db->where("is_active", 1);
		$this->db->where("for_admin", 0);
		$query = $this->db->get('product');
		if (isset($post['id'])) {
			return $query->row_array();
		} else {
			return $query->result_array();
		}
	}

	public function getProductInfo($id)
	{
		$this->db->where("id", $id);
		$query = $this->db->get('product');
		return $query->row_array();
	}

	function getAllProductsPackages($price){
		$this->db->where("is_active", 1);
		$this->db->where("type_id", 1);
		//$this->db->where('price', $price);
		$this->db->order_by('price','ASC');
		$query = $this->db->get('product');
		return $query->result_array();
	}

	function getAllProducts()
	{
		$this->db->where("type_id", 2);
		$query = $this->db->get('product');
		return $query->result_array();
	}

	public function getAllProductStock()
	{
		$this->db->select("id, name");
		$this->db->where("type_id", 2);
		$this->db->where("is_active", 1);
		$this->db->where("for_admin", 0);
		$query = $this->db->get('product');
		$products = $query->result_array();

		$final = array();
		foreach ($products as $product) {
			$product['sold'] = $this->getSold($product['id']);
			$product['total'] = $this->getTotal($product['id']);
			$final[] = $product;
		}
		return $final;
	}

	public function getTotal($pid)
	{
		$this->db->select_sum("quantity");
		$this->db->where("product_id", $pid);
		$query = $this->db->get('inventory_items');
		return (int)$query->row_array()['quantity'];
	}

	public function getSold($pid)
	{
		$this->db->select_sum("qty");
		$this->db->where("product_id", $pid);
		$query = $this->db->get('order_detail');
		return (int)$query->row_array()['qty'];
	}

	public function get($id)
	{
		$this->db->where("id", $id);
		$query = $this->db->get('product');
		return $query->row_array();
	}

	public function getPackages($post)
	{
		if (isset($post['id'])) {
			$this->db->where("id", $post['id']);
		}
		$this->db->where("type_id", 1);
		$this->db->where("is_active", 1);
		$query = $this->db->get('product');
		if (isset($post['id'])) {
			return $query->row_array();
		} else {
			return $query->result_array();
		}
	}

	public function getPkg($post)
	{
		if (isset($post['id'])) {
			$this->db->where("id", $post['id']);
		}
		$query = $this->db->get('product');
		if (isset($post['id'])) {
			return $query->row_array();
		} else {
			return $query->result_array();
		}
	}

	function getAllPackages()
	{
		$this->db->where("type_id", 1);
		$query = $this->db->get('product');
		return $query->result_array();
	}

	function update($post)
	{
		$submit['is_active'] = $post["is_active"];
		$submit['need_delivery'] = $post["need_delivery"];
		$submit['code'] = $post["code"];
		$submit['name'] = $post["name"];
		$submit['description'] = $post["description"];
		$submit['price'] = $post["price"];
		$submit['sponsor_bonus'] = $post["sponsor_bonus"];
		$submit['BV'] = $post["BV"];
		$submit['category_id'] = $post["category_id"];
		$submit['type_id'] = $post["type_id"];
		if (isset($post['extension'])) {
			$submit['img_file'] = uploadFile(array(
				'extension' => $post['extension'],
				'filedata' => $post['filedata']
			), "img_product");
		}
		if (isset($post['id'])) {
			$this->db->update('product', $submit, array('id' => $post['id']));
		} else {
			$this->db->insert('product', $submit);
		}
	}

	function delete($id)
	{
		$this->db->where("id", $id);
		$query = $this->db->delete('product');
	}
}