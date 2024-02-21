<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StarModel extends CI_Model
{
	public function getStarReport($post)
	{
		if (!empty($post['period'])) {
			$this->db->like('period', $post['period']);
		}

		if (!empty($post['userid'])) {
			$this->db->where('userid', $post['userid']);
		}

		if ($post['fl_rank'] == "any") {
			$this->db->group_start();
			$this->db->where("(rank1 like '%star%' or rank2 like '%star%' or rank3 like '%star%' or rank4 like '%star%' or rank5 like '%star%' or rank6 like '%star%')");
			$this->db->group_end();
		}

		$this->db->from("star_report");
		$tempdb = clone $this->db;
		if (isset($post['per_page'])) {
			$start = ($post['page'] - 1) * $post['per_page'];
			$this->db->limit($post['per_page'], $start);
		}
		$data['counter'] = $tempdb->count_all_results("", false);
		$query = $this->db->get();
		$data['result'] = $query->result_array();
		return $data;
	}

	public function exportStarReport($post)
	{
		if (!empty($post['period'])) {
			$this->db->like('month1', $post['period']);
		}

		if (!empty($post['userid'])) {
			$this->db->where('userid', $post['userid']);
		}

		if ($post['fl_rank'] == "any") {
			$this->db->group_start();
			$this->db->where("(rank1 like '%star%' or rank2 like '%star%' or rank3 like '%star%' or rank4 like '%star%' or rank5 like '%star%' or rank6 like '%star%')");
			$this->db->group_end();
		}

		$this->db->from("star_report");
		$query = $this->db->get();
		return $query->result_array();
	}


	public function calculate($member_id, $period)
	{
		set_time_limit(0);
		ini_set('max_execution_time', 0);
		$member = $this->MemberModel->getMemberInfoById($member_id);

		$m['1'] = $period;
		$m['2'] = date("Y-m", strtotime($period . " -1 months"));
		$m['3'] = date("Y-m", strtotime($period . " -2 months"));
		$m['4'] = date("Y-m", strtotime($period . " -3 months"));
		$m['5'] = date("Y-m", strtotime($period . " -4 months"));
		$m['6'] = date("Y-m", strtotime($period . " -5 months"));
		foreach ($m as $month) {
			$this->refine($month, $member);
		}
		$this->transfer($period, $member);
		$this->remove_duplicate();
	}

	public function transfer($p, $member)
	{
		$period = ($p == '' ? date("Y-m") : $p);
		$m1 = $m['1'] = $period;
		$m2 = $m['2'] = date("Y-m", strtotime($period . " -1 months"));
		$m3 = $m['3'] = date("Y-m", strtotime($period . " -2 months"));
		$m4 = $m['4'] = date("Y-m", strtotime($period . " -3 months"));
		$m5 = $m['5'] = date("Y-m", strtotime($period . " -4 months"));
		$m6 = $m['6'] = date("Y-m", strtotime($period . " -5 months"));

		$results = $this->getStars($m, $member['id']);
		$rnk1 = $rnk2 = $rnk3 = $rnk4 = $rnk5 = $rnk6 = 1;
		$lbv1 = $lbv2 = $lbv3 = $lbv4 = $lbv5 = $lbv6 = 0;
		$rbv1 = $rbv2 = $rbv3 = $rbv4 = $rbv5 = $rbv6 = 0;
		if (count($results) > 0) {
			foreach ($results as $r) {
				if ($r['period'] == $m1) {
					$rnk1 = $r['rank'];
					$lbv1 = $r['lbv'];
					$rbv1 = $r['rbv'];
				}
				if ($r['period'] == $m2) {
					$rnk2 = $r['rank'];
					$lbv2 = $r['lbv'];
					$rbv2 = $r['rbv'];
				}
				if ($r['period'] == $m3) {
					$rnk3 = $r['rank'];
					$lbv3 = $r['lbv'];
					$rbv3 = $r['rbv'];
				}
				if ($r['period'] == $m4) {
					$rnk4 = $r['rank'];
					$lbv4 = $r['lbv'];
					$rbv4 = $r['rbv'];
				}
				if ($r['period'] == $m5) {
					$rnk5 = $r['rank'];
					$lbv5 = $r['lbv'];
					$rbv5 = $r['rbv'];
				}
				if ($r['period'] == $m6) {
					$rnk6 = $r['rank'];
					$lbv6 = $r['lbv'];
					$rbv6 = $r['rbv'];
				}
			}
		}
		$rnk_arr = array(1 => "[[RANK_MEMBER]]", 2 => "[[RANK_1STAR]]", 3 => "[[RANK_2STAR]]", 4 => "[[RANK_3STAR]]", 6 => "[[RANK_SSTAR]]", 5 => "[[RANK_PEACOCK]]", 7 => "[[RANK_PHOENIX]]", 8 => "[[RANK_KIRIN]]", 9 => "[[RANK_UNICORN]]", 10 => "[[RANK_DRAGON]]");
		$final['period'] = $m1;
		$final['member_id'] = $member['id'];
		$final['email'] = $member['email'];
		$final['userid'] = $member['userid'];
		$final['f_name'] = $member['f_name'];
		$final['l_name'] = $member['l_name'];
		$final['rank'] = $rnk1;
		$final['rank1'] = $rnk_arr[$rnk1];
		$final['rank2'] = $rnk_arr[$rnk2];
		$final['rank3'] = $rnk_arr[$rnk3];
		$final['rank4'] = $rnk_arr[$rnk4];
		$final['rank5'] = $rnk_arr[$rnk5];
		$final['rank6'] = $rnk_arr[$rnk6];
		$final['month1'] = $m1 . "__" . $rbv1 . "__" . $lbv1;
		$final['month2'] = $m2 . "__" . $rbv2 . "__" . $lbv2;
		$final['month3'] = $m3 . "__" . $rbv3 . "__" . $lbv3;
		$final['month4'] = $m4 . "__" . $rbv4 . "__" . $lbv4;
		$final['month5'] = $m5 . "__" . $rbv5 . "__" . $lbv5;
		$final['month6'] = $m6 . "__" . $rbv6 . "__" . $lbv6;

		$this->db->where('member_id', $member['id']);
		$this->db->where('period', $period);
		$query = $this->db->get('star_report');
		$star_report = $query->row_array();

		if (isset($star_report['id'])) {
			$this->db->update('star_report', $final, array('id', $star_report['id']));
			$this->db->update('member', array('last_update' => getFullDate()), array('id' => $member['id']));
		} else {
			$this->db->insert('star_report', $final);
			$this->db->update('member', array('last_update' => getFullDate()), array('id' => $member['id']));
		}
	}

	public function getStars($m, $id)
	{
		$this->db->where("member_id", $id);
		$this->db->where_in("period", $m);
		$query = $this->db->get("star_helper");
		return $query->result_array();
	}

	public function refine($period, $member)
	{
		$this->findRankOne($period, $member);
		$this->findRankTwo($period, $member);
		$this->findRankThree($period, $member);
		$this->findRankFour($period, $member);
		$this->findRankFive($period, $member);
		$this->findRankSix($period, $member);
	}

	public function findRankFive($period, $member)
	{
		ini_set('max_execution_time', 0);
		$this->db->where('member_id', $member);
		$this->db->where('period', $period);
		$this->db->where('rank', 4);
		$this->db->where('lbv >=', 120000);
		$this->db->where('rbv >=', 120000);
		$query = $this->db->get('star_helper');
		$result = $query->result_array();
		foreach ($result as $record) {
			$left_team = $record['left_downline'];
			$right_team = $record['right_downline'];
			$left_count = $this->find_target($left_team, 4, $period);
			$right_count = $this->find_target($right_team, 4, $period);
			if ($left_count > 0 and $right_count > 0) {
				$this->updateFive($record);
			}
		}
	}

	public function updateFive($star)
	{
		ini_set('max_execution_time', 0);
		$period = $p[] = $star['period'];
		$p[] = date('Y-m', strtotime("+1 month", strtotime($period)));
		$p[] = date('Y-m', strtotime("+2 month", strtotime($period)));
		$this->db->where('member_id', $star['member_id']);
		$this->db->where_in('period', $p);
		$this->db->where('rank', 4);
		$this->db->where('lbv >=', 120000);
		$this->db->where('rbv >=', 120000);
		$query = $this->db->get('star_helper');
		$result = $query->num_rows();
		if ($result >= 3) {
			$this->updateRank(5, array($star['member_id']));
		}
	}

	public function findRankSix($period, $member)
	{
		ini_set('max_execution_time', 0);
		$this->db->where('member_id', $member);
		$this->db->where('period', $period);
		$this->db->where('rank', 5);
		$this->db->where('(lbv+rbv) >=', 480000);
		$query = $this->db->get('star_helper');
		$result = $query->result_array();
		foreach ($result as $record) {
			$team = $record['left_downline'] . "," . $record['right_downline'];
			$count = $this->find_target($team, 5);
			if ($count > 1) {
				$this->updateSix($record);
			}
		}
	}

	public function updateSix($star)
	{
		ini_set('max_execution_time', 0);
		$period = $p[] = $star['period'];
		$p[] = date('Y-m', strtotime("+1 month", strtotime($period)));
		$p[] = date('Y-m', strtotime("+2 month", strtotime($period)));
		$this->db->where('member_id', $star['member_id']);
		$this->db->where_in('period', $p);
		$this->db->where('rank', 5);
		$this->db->where('(lbv+rbv) >=', 480000);
		$query = $this->db->get('star_helper');
		$result = $query->num_rows();
		if ($result >= 3) {
			$this->updateRank(6, array($star['member_id']));
		}
	}

	public function findRankFour($period, $member)
	{
		ini_set('max_execution_time', 0);
		$this->db->where('member_id', $member);
		$this->db->where('period', $period);
		$this->db->where('rank', 3);
		$this->db->where('lbv >=', 40000);
		$this->db->where('rbv >=', 40000);
		$query = $this->db->get('star_helper');
		$result = $query->result_array();
		$to_update = array();
		foreach ($result as $record) {
			$left_team = $record['left_downline'];
			$right_team = $record['right_downline'];
			$left_count = $this->find_target($left_team, 3, $period);
			$right_count = $this->find_target($right_team, 3, $period);
			if ($left_count > 0 and $right_count > 0) {
				$to_update[] = $record['id'];
			}
		}
		$this->updateRank(4, $to_update);
	}

	public function findRankThree($period, $member)
	{
		ini_set('max_execution_time', 0);
		$this->db->where('member_id', $member);
		$this->db->where('period', $period);
		$this->db->where('rank', 2);
		$this->db->where('lbv >=', 20000);
		$this->db->where('rbv >=', 20000);
		$query = $this->db->get('star_helper');
		$result = $query->result_array();
		$to_update = array();
		foreach ($result as $record) {
			$left_team = $record['left_downline'];
			$right_team = $record['right_downline'];
			$left_count = $this->find_target($left_team, 2, $period);
			$right_count = $this->find_target($right_team, 2, $period);
			if ($left_count >= 1 and $right_count >= 1) {
				$to_update[] = $record['id'];
			}
		}
		$this->updateRank(3, $to_update);
	}

	public function findRankTwo($period, $member)
	{
		$this->db->where('member_id', $member);
		$this->db->where('period', $period);
		$this->db->where('lbv >=', 10000);
		$this->db->where('rbv >=', 10000);
		$query = $this->db->get('star_helper');
		$records = $query->num_rows();
		if($records > 0){
			$this->db->update('star_helper', array(
				"rank" => 2
			));
		}
	}

	public function findRankOne($period, $member)
	{
		$entry_date = date("Y-m-t", strtotime($period)) . " 23:59:59";

		$RightTeam = array();
		$LeftTeam = array();

		$Left = array();
		$Right = array();
		$downlines = $this->getNode($member, $entry_date);
		foreach ($downlines as $downline) {
			if ($downline['matrix_side'] == "L") {
				$Left['id'] = $downline['id'];
			}
			if ($downline['matrix_side'] == "R") {
				$Right['id'] = $downline['id'];
			}
		}

		if (count($downlines) > 0) {
			if (count($Left) > 0) {
				$LeftTeam = $this->getDownlineMemberWithRanks($Left['id'], 'L', $entry_date);
			}
			if (count($Right) > 0) {
				$RightTeam = $this->getDownlineMemberWithRanks($Right['id'], 'R', $entry_date);
			}

			$LeftIds = array_column($LeftTeam, 'id');
			$RightIds = array_column($RightTeam, 'id');

			if (count($Left) > 0) {
				$LeftIds[] = $Left['id'];
			}
			if (count($Right) > 0) {
				$RightIds[] = $Right['id'];
			}

			$lbv = 0;
			$rbv = 0;

			if (count($LeftIds) > 0) {
				$lbv = (float)$this->getSalesofDesiredMonth($period, $LeftIds);
			}

			if (count($RightIds) > 0) {
				$rbv = (float)$this->getSalesofDesiredMonth($period, $RightIds);
			}

			$post['member_id'] = $member;
			$post['rank'] = 1;
			$post['period'] = $period;
			$post['lbv'] = $lbv;
			$post['rbv'] = $rbv;
			$post['left_downline'] = implode(",", $LeftIds);
			$post['right_downline'] = implode(",", $RightIds);

			$this->db->where('member_id', $member);
			$this->db->where('period', $period);
			$query = $this->db->get('star_helper');
			$star_helper = $query->row_array();

			if (isset($star_helper['id'])) {
				$this->db->update('star_helper', $post, array(
					'member_id' => $member,
					'period' => $period
				));
			} else {
				$this->db->insert('star_helper', $post);
			}
		}
	}

	public function getNode($id, $entry_date)
	{
		$this->db->select("id, matrixid, matrix_side");
		$this->db->where("matrixid", $id);
		$this->db->where("join_date <=", $entry_date);
		$this->db->order_by('matrixid', 'asc');
		$query = $this->db->get('member');
		return $query->result_array();
	}

	public function getSalesofDesiredMonth($period, $members)
	{
		$this->db->select("SUM(personal_sales) as BV");
		$this->db->group_start();
		$member_ids_chunk = array_chunk($members, 25);
		foreach ($member_ids_chunk as $member_ids) {
			$this->db->or_where_in("member_id", $member_ids);
		}
		$this->db->group_end();
		$this->db->like("period", $period);
		$query = $this->db->get("member_sales_daily");
		$result = $query->row_array();
		return isset($result['BV']) ? $result['BV'] : 0;
	}

	public function getDownlineMemberWithRanks($matrix_id, $position, $entry_date)
	{
		$groups = array();
		$this->db->select("m.id, m.rank");
		$this->db->where("m.matrixid", $matrix_id);
		$this->db->where("m.join_date <=", $entry_date);
		$query = $this->db->get('member m');
		$members = $query->result_array();
		foreach ($members as $member) {
			$downlines = $this->getDownlineMemberWithRanks($member['id'], $position, $entry_date);
			$groups = array_merge($groups, $downlines);
		}
		return array_merge($members, $groups);
	}

	public function find_target($members, $rank, $period)
	{
		$query = $this->db->query("SELECT * FROM star_helper WHERE rank ='$rank' AND member_id in ($members) AND period = '$period'");
		return $query->num_rows();
	}

	public function updateRank($rank, $to_update)
	{
		if (count($to_update) < 1) {
			return false;
		}
		$this->db->where('id', $to_update[0]);
		$result = $this->db->update('star_helper', array("rank" => $rank));
	}

	public function remove_duplicate()
	{
		$q = "SELECT * FROM (select Max(id) as id from star_helper group by member_id, period ORDER BY member_id DESC) tbl";
		$result = $this->db->query($q);
		$result_arr = $result->result_array();
		$r = array_column($result_arr , 'id');
		if(count($r) > 0){
			$query = "DELETE from star_helper where id not in (" . implode(",",$r) . ")";
			$this->db->query($query);
			$query = "DELETE from star_report where id not in (" . implode(",",$r) . ")";
			$this->db->query($query);
		}
	}


}
