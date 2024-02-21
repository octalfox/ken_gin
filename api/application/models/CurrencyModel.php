<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CurrencyModel extends CI_Model
{
	public function get()
	{
		$this->db->where("is_shown", 1);
		$query = $this->db->get('currency_list');
		return $query->result();
	}

	public function getCurrencyBy($curr)
	{
		$this->db->where("counter_currency", $curr);
		$query = $this->db->get('currency_rate');
		return $query->row_array();
	}
	public function getAll()
	{
		$query = $this->db->get('currency_rate');
		return $query->result();
	}

	function update($post)
	{
		$new_array = array();
		$unsets = array();
		foreach ($post as $key => $val){
			$new_key = explode("%", $key);
			if(isset($new_key[1])) {
				$new_array[$new_key[1]][$new_key[0]] = $val;
				if(empty($val)){
					$unsets[$new_key[1]] = $new_key[1];
				}
			}
		}
		foreach ($new_array as $id => $data){
			if(!in_array($id, $unsets)) {
				if (isset($data['base_currency'])) {
					$this->db->insert('currency_rate', $data);
				} else {
					$this->db->update('currency_rate', $data, array('id' => $id));
				}
			}
		}
	}
}
