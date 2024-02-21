<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BackupStar extends CI_Controller
{
	public function trigger()
	{
		set_time_limit(0);
		ini_set('max_execution_time', 0);
		$array = array(
//			"2019-03",
//			"2019-04",
//			"2019-05",
//			"2019-06",
//			"2019-07",
//			"2019-08",
//			"2019-09",
//			"2019-10",
//			"2019-11",
//			"2019-12",
//			"2020-01",
//			"2020-02",
//			"2020-03",
//			"2020-04",
//			"2020-05",
//			"2020-06",
//			"2020-07",
//			"2020-08",
//			"2020-09",
//			"2020-10",
//			"2020-11",
//			"2020-12",
//			"2020-01",
//			"2021-02",
//			"2021-03",
//			"2021-04",
//			"2021-05",
//			"2021-06",
//			"2021-07",
//			"2021-08",
//			"2021-09",
//			"2021-10",
//			"2021-11",
//			"2021-12",
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
		);
		foreach ($array as $date) {
			$this->get_helpers($date);
		}
	}

	public function get_helpers($prd = "")
	{
		$period = $prd == "" ? date("Y-m") : $prd;
		$entry_date = date("Y-m-t", strtotime($period)) . " 23:59:59";
		$members = $this->members();


		foreach ($members as $member) {
			$RightTeam = array();
			$LeftTeam = array();

			$Left = array();
			$Right = array();
			$downlines = $this->getNode($member['id']);
			foreach ($downlines as $downline) {
				if ($downline['matrix_side'] == "L") {
					$Left['id'] = $downline['id'];
				}
				if ($downline['matrix_side'] == "R") {
					$Right['id'] = $downline['id'];
				}
			}

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

			$post['member_id'] = $member['id'];
			$post['period'] = $period;
			$post['lbv'] = $lbv;
			$post['rbv'] = $rbv;
			$post['left_downline'] = implode(",", $LeftIds);
			$post['right_downline'] = implode(",", $RightIds);

			$this->db->where('member_id', $member['id']);
			$this->db->where('period', $period);
			$query = $this->db->get('star_helper');
			$star_helper = $query->row_array();

			if (isset($star_helper['id'])) {
				$this->db->update('star_helper', $post, array(
					'member_id' => $member['id'],
					'period' => $period
				));
			} else {
				$this->db->insert('star_helper', $post);
			}

		}
	}

	public function index()
	{
		ini_set('max_execution_time', 0);
		ini_set("memory_limit", "-1");
		set_time_limit(0);

		// Create an array from the user-provided month to the last month
		$array = array();

//		$array = array(
//			"2023-01",
//		);

//		// first month
//		$userFirstMonth = "2023-10";
//
		// Get the current year and month
		$currentYear = date('Y');
		$currentMonth = date('m');
//		$currentDate = $userFirstMonth;
//		while ($currentDate < "$currentYear-$currentMonth") {
//			$array[] = $currentDate;
//			$currentDate = date('Y-m', strtotime("+1 month", strtotime($currentDate)));
//		}

		// Calculate the last month before the current month
		$lastMonth = date('Y-m', strtotime('-1 month', strtotime("$currentYear-$currentMonth-01")));

		// Create an array with the last month
		$array[] = $lastMonth;

		foreach ($array as $date) {
			$this->insertToStar($date);
		}
	}

	private function insertToStar($period)
	{
		$m1 = $m['1'] = $period;
		$m2 = $m['2'] = date("Y-m", strtotime($period . " -1 months"));
		$m3 = $m['3'] = date("Y-m", strtotime($period . " -2 months"));
		$m4 = $m['4'] = date("Y-m", strtotime($period . " -3 months"));
		$m5 = $m['5'] = date("Y-m", strtotime($period . " -4 months"));
		$m6 = $m['6'] = date("Y-m", strtotime($period . " -5 months"));
		$this->truncateStarReport($period);
		$entry_date = date("Y-m-t", strtotime($period)) . " 23:59:59";
		$members = $this->members($entry_date);

		foreach ($members as $key => $member) {
			$results = $this->getStars($m, $member['id']);
			$rnk1 = $rnk2 = $rnk3 = $rnk4 = $rnk5 = $rnk6 = 1;
			$lbv1 = $lbv2 = $lbv3 = $lbv4 = $lbv5 = $lbv6 = 0;
			$rbv1 = $rbv2 = $rbv3 = $rbv4 = $rbv5 = $rbv6 = 0;
			if (count($results) > 0) {
				foreach ($results as $r) {
					if($r['period'] == $m1){ $rnk1 = $r['rank']; $lbv1 = $r['lbv']; $rbv1 = $r['rbv']; }
					if($r['period'] == $m2){ $rnk2 = $r['rank']; $lbv2 = $r['lbv']; $rbv2 = $r['rbv']; }
					if($r['period'] == $m3){ $rnk3 = $r['rank']; $lbv3 = $r['lbv']; $rbv3 = $r['rbv']; }
					if($r['period'] == $m4){ $rnk4 = $r['rank']; $lbv4 = $r['lbv']; $rbv4 = $r['rbv']; }
					if($r['period'] == $m5){ $rnk5 = $r['rank']; $lbv5 = $r['lbv']; $rbv5 = $r['rbv']; }
					if($r['period'] == $m6){ $rnk6 = $r['rank']; $lbv6 = $r['lbv']; $rbv6 = $r['rbv']; }
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
			$this->db->insert("star_report", $final);
		}
	}

	public function getRank($M1LBV, $M2LBV, $M3LBV, $M1RBV, $M2RBV, $M3RBV)
	{
		$rank = "[[RANK_MEMBER]]";
		if ($M1LBV > 10000 and $M1RBV > 10000) {
			$rank = "[[RANK_1STAR]]";
		}
		if ($M1LBV > 20000 and $M1RBV > 20000) {
			$rank = "[[RANK_2STAR]]";
		}
		if ($M1LBV > 40000 and $M1RBV > 40000) {
			$rank = "[[RANK_3STAR]]";
		}

		$Target = 120000;
		if ($M1LBV > $Target and $M1RBV > $Target and $M2LBV > $Target and $M2RBV > $Target and $M3LBV > $Target and $M3RBV > $Target) {
			$rank = "[[RANK_SSTAR]]";
		}

		$Target = 480000;
		if (($M1LBV + $M1RBV) > $Target and ($M2LBV + $M2RBV) > $Target and ($M3LBV + $M3RBV) > $Target) {
			$rank = "[[RANK_PEACOCK]]";
		}

		$Target = 960000;
		if (($M1LBV + $M1RBV) > $Target and ($M2LBV + $M2RBV) > $Target and ($M3LBV + $M3RBV) > $Target) {
			$rank = "[[RANK_PHOENIX]]";
		}

		$Target = 1440000;
		if (($M1LBV + $M1RBV) > $Target and ($M2LBV + $M2RBV) > $Target and ($M3LBV + $M3RBV) > $Target) {
			$rank = "[[RANK_KIRIN]]";
		}

		$Target = 2160000;
		if (($M1LBV + $M1RBV) > $Target and ($M2LBV + $M2RBV) > $Target and ($M3LBV + $M3RBV) > $Target) {
			$rank = "[[RANK_UNICORN]]";
		}

		$Target = 2880000;
		if (($M1LBV + $M1RBV) > $Target and ($M2LBV + $M2RBV) > $Target and ($M3LBV + $M3RBV) > $Target) {
			$rank = "[[RANK_DRAGON]]";
		}
		return $rank;
	}

	public function getStars($m, $id)
	{
		$this->db->where("member_id", $id);
		$this->db->where_in("period", $m);
		$query = $this->db->get("star_helper");
		return $query->result_array();
	}

	public function truncateStarReport($month)
	{
		$this->db->where('period', $month);
		$this->db->delete('star_report');
	}

	public function members($entry_date)
	{
		$this->db->select("m.id, m.email, m.userid, m.f_name, m.l_name, m.rank, m.join_date");
		$this->db->where("m.join_date <=", $entry_date);
		$query = $this->db->get('member m');
		return $query->result_array();
	}

	public function getNode($id)
	{
		$this->db->select("id, matrixid, matrix_side");
		$this->db->where("matrixid", $id);
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

}
