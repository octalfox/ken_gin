<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SaleModel extends CI_Model
{
	public function getBv($user_id)
	{
		$member = $this->MemberModel->getMemberInfoByIdUseridEmailWithRank($user_id);
		$this->db->where("member_id", $user_id);
		$this->db->order_by("period","DESC");
		$query = $this->db->get('member_commissions');
		$bv = $query->row_array();
		if (!isset($bv['id'])) {
			$data = array(
				"accu_left_node" => "0",
				"accu_right_node" => "0",
				"addition_left_node" => "0",
				"addition_right_node" => "0",
				"deduction_left_node" => "0",
				"deduction_right_node" => "0",
				"bleft_node" => "0",
				"bright_node" => "0",
				"f_name" => isset($member['f_name']) ? $member['f_name'] : 0,
				"l_name" => isset($member['l_name']) ? $member['l_name'] : 0,
				"username" => isset($member['username']) ? $member['username'] : 0,
				"userid" => isset($member['userid']) ? $member['userid'] : 0,
				"rank" => trans(isset($member['rank_name']) ? $member['rank_name'] : 0),
				"package" => isset($member['package']) ? $member['package'] : 'N/A',
				"member_id" => isset($member['id']) ? $member['id'] : 0
			);

		} else {
			$data = array(
				"accu_left_node" => $bv['accu_left_node'],
				"accu_right_node" => $bv['accu_right_node'],
				"addition_left_node" => $bv['addition_left_node'],
				"addition_right_node" => $bv['addition_right_node'],
				"deduction_left_node" => $bv['deduction_left_node'],
				"deduction_right_node" => $bv['deduction_right_node'],
				"bleft_node" => $bv['bleft_node'],
				"bright_node" => $bv['bright_node'],
				"f_name" => isset($member['f_name']) ? $member['f_name'] : 0,
				"l_name" => isset($member['l_name']) ? $member['l_name'] : 0,
				"username" => isset($member['username']) ? $member['username'] : 0,
				"userid" => isset($member['userid']) ? $member['userid'] : 0,
				"rank" => trans(isset($member['rank_name']) ? $member['rank_name'] : 0),
				"package" => isset($member['package']) ? $member['package'] : 'N/A',
				"member_id" => isset($member['id']) ? $member['id'] : 0
			);
		}
		return $data;
	}

	public function getSalesByPeriod($user_id, $period)
	{
		$this->db->where("member_id", $user_id);
		$this->db->where("period", $period);
		$query = $this->db->get('member_sales_period');
		return $query->row_array();
	}

	public function getMemberSales($user_id)
	{
		$this->db->where("member_id", $user_id);
		$query = $this->db->get('member_sales');
		return $query->row_array();
	}

	public function getTotalMemberSales($member_id)
	{

		$this->db->select('member_id, SUM(accu_group_sales) as total_group_sales, SUM(accu_personal_sales) as total_personal_sales, SUM(accu_direct_sales) as total_direct_sales');
		$this->db->from('member_sales');
		$this->db->where('member_id', $member_id);
		$query = $this->db->get();

		$result = $query->row(); // Assuming you expect only one row for the given member_id

		$total_group_sales = $result->total_group_sales;
		$total_personal_sales = $result->total_personal_sales;
		$total_direct_sales = $result->total_direct_sales;

	
		return $total_group_sales + $total_personal_sales + $total_direct_sales;
	}


	public function getMemberSaleDetails($user_id)
	{
		$sales = $this->getMemberSales($user_id);
		$sale['personal_sales'] = isset($sales['accu_personal_sales']) ? $sales['accu_personal_sales'] : 0;
		$sale['direct_sales'] = isset($sales['accu_direct_sales']) ? $sales['accu_direct_sales'] : 0;
		$group_sales = $this->getMemberSalesMatrix($user_id);
		$sale['group_sales'] = ((isset($group_sales['accu_group_sales']))? $group_sales['accu_group_sales'] : 0) - $sale['personal_sales'];
		return $sale;
	}

	public function getMemberSalesMatrix($user_id)
	{
		$this->db->where("member_id", $user_id);
		$query = $this->db->get('member_sales_matrix');
		return $query->row_array();
	}

	public function getMemberSalesMatrixPeriod($user_id, $period)
	{
		$this->db->where("member_id", $user_id);
		$this->db->where("period", $period);
		$query = $this->db->get('member_sales_matrix_period');
		return $query->row_array();
	}

	public function getMemberSaleSummary($period = null)
	{
		$this->db->select("sum(personal_sales) as ps");
		if($period != null) {
			$this->db->where("period", $period);
		}
		$query = $this->db->get('member_sales_period');
		return $query->row_array();
	}

	public function getMemberSaleYearly($year)
	{
		$this->db->select("sum(personal_sales) as ps");
		if($year != null) {
			$this->db->like("period", $year);
		}
		$query = $this->db->get('member_sales_daily');
		return $query->row_array();
	}

	public function getSaleByPeriod($year)
	{
		$this->db->select("member_sales_daily.*, member.userid, member.f_name, member.l_name");
		$this->db->join('member', 'member.id = member_sales_daily.member_id');
		if($year != null) {
			$this->db->like("period", $year);
		}
		$query = $this->db->get('member_sales_daily');
		return $query->result_array();
	}
}
