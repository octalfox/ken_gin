<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SystemModel extends CI_Model
{
	public function getConstants()
	{
		$query = $this->db->get('constants');
		$constants = $query->result_array();
		$return = array();
		foreach ($constants as $constant){
			$return[$constant['item']] = $constant['value'];
		}

		$this->db->where('is_active', 1);
		$query = $this->db->get('currency_rate');
		$return['CURR_RATES'] = $query->result_array();

		return $return;
	}
}
