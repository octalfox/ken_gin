<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Updated extends CI_Controller
{
    public function index()
    {
        $this->db->where("is_done", 0);
        $this->db->limit(20);
        $query = $this->db->get('zen_data');
        $records = $query->result_array();
        foreach ($records as $record) {
            $this->StarModel->calculate($record['member_id'], $record['period']);
            $this->updater($record['id']);
        }
    }

    public function updater($id)
    {
        $this->db->where('id', $id);
        $this->db->update('zen_data', array('is_done' => 1));
    }

    public function index_bkp()
    {
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        $period = date("Y-m");
        $members = $this->db->order_by('last_update', "asc")->limit($per_minute)->get('member')->result_array();
        foreach ($members as $member) {
            $this->StarModel->calculate($member['id'], $period);
        }
    }

    public function single($userid, $period)
    {
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        $period = date("Y-m");
        $member = $this->db->where('userid', $userid)->get('member')->row_array();
        $this->StarModel->calculate($member['id'], $period);
    }

    public function special()
    {
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        $periods = array(
			"2019-04",
			"2019-05",
			"2019-06",
			"2019-07",
			"2019-08",
			"2019-09",
			"2019-10",
			"2019-11",
			"2019-12",
			"2020-01",
			"2020-02",
			"2020-03",
			"2020-04",
			"2020-05",
			"2020-06",
			"2020-07",
			"2020-08",
			"2020-09",
			"2020-10",
			"2020-11",
			"2020-12",
            "2021-01",
            "2021-02",
            "2021-03",
            "2021-04",
            "2021-05",
            "2021-06",
            "2021-07",
            "2021-08",
            "2021-09",
            "2021-10",
            "2021-11",
            "2021-12",
            "2022-01",
            "2022-02",
            "2022-03",
            "2022-04",
            "2022-05",
            "2022-06",
            "2022-07",
            "2022-08",
            "2022-09",
            "2022-10",
            "2022-11",
            "2022-12",
            "2023-01",
            "2023-02",
            "2023-03",
            "2023-04",
            "2023-05",
            "2023-06",
        );
        $members = $this->db->select("id, join_date")->order_by('id', "desc")->get('member')->result_array();
        foreach ($periods as $period) {
            foreach ($members as $i => $member) {
                if ($member['join_date'] <= $period . "-t 23:59:59") {
                    $data[$i]['member_id'] = $member['id'];
                    $data[$i]['period'] = $period;
                }
            }
            $this->db->insert_batch('zen_data', $data);
        }
    }

    public function members()
    {
        $this->db->select("m.id, m.email, m.userid, m.f_name, m.l_name, m.rank, m.join_date");
        $query = $this->db->get('member m');
        return $query->result_array();
    }

    public function cronx()
    {
        $this->db->where("is_done", 0);
        $query = $this->db->get('zen_data');
        $records = $query->result_array();

        foreach ($records as $record) {
            dd($record);
        }

    }

}
