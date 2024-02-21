<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Updated extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function step1()
	{
		set_time_limit(0);
		ini_set('display_errors', 1);
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '1024M');

		$members = $this->db->select("id, join_date")->order_by('id', "desc")->get('member')->result_array();
		$period = date("Y-m");
		foreach ($members as $i => $member) {
			if ($member['join_date'] <= $period . "-t 23:59:59") {
				$this->StarModel->findRankOne($period, $member['id']);
			}
		}
	}

	public function step2()
	{
		set_time_limit(0);
		ini_set('display_errors', 1);
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '1024M');

		$period = date("Y-m");

		$this->db->where('period', $period);
		$this->db->where('lbv >=', 10000);
		$this->db->where('rbv >=', 10000);
		$this->db->update('star_helper', array(
			"rank" => 2
		));
		$this->db->reset_query();

		$this->db->where('period', $period);
		$this->db->where("rank", 2);
		$query = $this->db->get('star_helper');
		$records = $query->result_array();
		foreach ($records as $record) {
			$this->StarModel->findRankThree($record['period'], $record['member_id']);
		}
		$this->db->reset_query();

		$this->db->where('period', $period);
		$this->db->where("rank", 3);
		$query = $this->db->get('star_helper');
		$records = $query->result_array();
		foreach ($records as $record) {
			$this->StarModel->findRankFour($record['period'], $record['member_id']);
		}
		$this->db->reset_query();

		$this->db->where('period', $period);
		$this->db->where("rank", 4);
		$query = $this->db->get('star_helper');
		$records = $query->result_array();
		foreach ($records as $record) {
			$this->StarModel->findRankFive($record['period'], $record['member_id']);
		}
		$this->db->reset_query();

		$this->db->where('period', $period);
		$this->db->where("rank", 5);
		$query = $this->db->get('star_helper');
		$records = $query->result_array();
		foreach ($records as $record) {
			$this->StarModel->findRankSix($record['period'], $record['member_id']);
		}
		$this->db->reset_query();

	}

	public function transfer()
	{
		set_time_limit(0);
		ini_set('display_errors', 1);
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '1024M');

		$q = "SELECT id, f_name, l_name, userid, email from member";
		$result = $this->db->query($q);
		$records = $result->result_array();
		
//      	$period = date("Y-m");
      	
      	$periods = array(
          "2023-02",
          "2023-03",
          "2023-04",
          "2023-05",
          "2023-06",
          "2023-07",
          "2023-08",
          "2023-09"
        );
      
      	foreach ($periods as $period) {
            foreach ($records as $record) {
                    $this->StarModel->transfer($period, $record);
            }
		}
	}


}
