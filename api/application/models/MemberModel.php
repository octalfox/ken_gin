<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MemberModel extends CI_Model
{
	function getAdminInfoByIdLogin($user_key)
	{
		$this->db->select("admin.*, admin_category.access_list");
		$this->db->where("admin.id", $user_key);
		$this->db->or_where("admin.login", $user_key);
		$this->db->join('admin_category', 'admin_category.id = admin.group_id');
		$query = $this->db->get('admin');
		return $query->row_array();
	}

	function getMemberInfoByIdUseridEmail($user_key)
	{
		$this->db->where("id", $user_key);
		$this->db->or_where("userid", $user_key);
//		$this->db->or_where("email", $user_key);
		$query = $this->db->get('member');
		return $query->row_array();
	}

	function getMemberInfoByEmailAndPhone($email, $mobile)
	{
		$this->db->where("mobile", $mobile);
		$this->db->or_where("email", $email);
		$query = $this->db->get('member');
		return $query->row_array();
	}

	function getMember($id){
		
		$by = NULL;
		$nodeid = 1;
        $data = array();

		if ($by != NULL)
            $this->tblId = "userid";

        $this->db->select("a.*, 
            (SELECT userid FROM member WHERE id = a.sponsorid LIMIT 1) AS sponsorId,
            (SELECT userid FROM member WHERE id = a.matrixid LIMIT 1) AS matrixId");
        $this->db->from("member a");
        $this->db->where("a.userid", $id);

        // Add additional condition if $nodeid is not NULL
        if ($nodeid != NULL) {
            $this->db->where("a.nodeid", $nodeid);
        }

        $query = $this->db->get();

        // Return the fetched data
        return $query->row_array();
	}
	
	function getMemberInfoByIdUseridEmailWithRank($user_key)
	{
		$this->db->select('m.*, mr.name as rank_name, p.name as package');
		$this->db->where("m.id", $user_key);
		$this->db->or_where("m.userid", $user_key);
		$this->db->or_where("m.email", $user_key);
		$this->db->join('member_rank mr', 'mr.id = m.rank', 'left');
		$this->db->join('product p', 'p.id = m.package_id', 'left');
		$query = $this->db->get('member m');
		return $query->row_array();
	}

	function getMemberInfoByUserid($userid)
	{
		$this->db->where("userid", $userid);
		$query = $this->db->get('member');
		return $query->row_array();
	}

	function getMemberInfoById($userid)
	{
		$this->db->where("id", $userid);
		$query = $this->db->get('member');
		return $query->row_array();
	}

	function getMemberInfoByToken($access_token)
	{
		$this->db->select("member.* , country_list.full_name, country_list.short_name, country_list.code, 
		country_list.currency, country_list.language_id");
		$this->db->where("member.access_token", $access_token);
		$this->db->join('country_list', 'country_list.id = member.country');
		$query = $this->db->get('member');
		return $query->row_array();
	}

	function updateInfo($id, $data)
	{
		//$query = $this->prepareUpdate($data, 'member', 'id', $id);
        //$this->executeNonQuery($query);
		$this->db->where('id', $id);
        $this->db->update('member', $data);
	}

	function calculateBV($member_id,$pv,$period){
		
		$member = $this->getMemberByMemberID($member_id);
		
        if(isset($member['matrixid']))
        {
			//return $this->updateNode(trim($member['matrix_side']),$pv,$member['matrixid'], $period);
            if($member['matrixid'] > 0)  $this->updateNode(trim($member['matrix_side']),$pv,$member['matrixid'], $period);
			
        }
	}

	public function getSalesPeriodInfo($id="", $by="", $where="", $fields_list="")
	{
		return $this->readRowInfo('member_sales_period', $id, $by, $where, $fields_list);
	}

	public function saveUpgradePackageTransaction($member_id, $old_package_id, $new_package_id, $gateway, $status){

		$new_package = $this->getProductInfo($new_package_id);
        $total_amount = $new_package['price'];
        $unit_price = $new_package['unit_price'];
        $tax_amt = $new_package['gst'];
        $new_pv = $new_package['BV'];
        //1) add to order master table & order detail table
        $salesId = $this->newSalesID();
        //$tax = $this->product_model->getTaxValue();
        $inv_num = $this->newSalesInvoiceNum();
        $old_package = $this->getProductInfo($old_package_id);
        $old_total_amount = $old_package['price'];
        $old_unit_price = $old_package['unit_price'];
        $old_gst = $old_package['gst'];
        $old_pv = $old_package['BV'];
        
        $orderMaster  = array(
            "member_id" => $member_id,
            "description" => "[[DEF_UPGRADE_ACCOUNT]]",
            "total_amount" => ($total_amount - $old_total_amount),
            "subtotal" => ($unit_price - $old_unit_price),
        	"total_pv" => $new_pv - $old_pv,
            "gst" => ($tax_amt - $old_gst),
            "status" => $status,
            "transaction_type" => "UPGRADE",
            "payment_type" => $gateway,
            "order_date" => "NOW()",
            "entry_package" => $new_package_id,
            "invoice_no" => $inv_num
        );
        $updateSalesInfo  = $this->updateSalesInfo($salesId, $orderMaster);
        $order_master_id = $this->getSalesIDByOrderNum($updateSalesInfo['order_num']);
        $prev_product_list = $this->getProductsInPackage($old_package_id);
        $product_list = $this->getProductsInPackage($new_package_id);
        if (count($prev_product_list) > 0 && count($product_list) > 0) {
        	$doid = $this->newDOMaster($inv_num, $member_id, " [[LABEL_PACKAGE_NAME]] " . $new_package['name'] . " [[ADM_UPGRADE_PACKAGE]]");
        	foreach ($product_list as $p) {
        		$qty   = $p['qty'];
        		$found = 0;
        		foreach ($prev_product_list as $ol) {
        			if ($found == 0) {
        				if ($ol['id'] == $p['id']) {
        					//minus away prev quantity, so will left current quantity to be given to member. dont need to care if they collect already a not
        					$qty   = $qty - $ol['qty'];
        					$found = 1;
        					break;
        				}
        			}
        		}
        		$pr = $this->getProductInfo($p['id']);
        		$p_amt = ($pr['member_unit_price'] + $pr['member_gst']);
        		$p_unit_price = $pr['member_unit_price'];
        		$p_tax = $pr['member_gst'];
        		$orderDetails = array(
        				"order_master_id" => $salesId,
        				"product_id" => $p['id'],
        				"name" => $p['name'],
        				"description" => $p['description'],
        				"qty" => $qty, //$p['qty'],
        				"unit_price" => $p_unit_price,
        				"tax" => $p_tax,
        				"amount" => $p_amt,
        				"is_combo" => 1
        		);
        		$this->insertDetail($orderDetails);
        		$this->newDODetail($doid, $p, $member_id, $qty);
        	}
        } else {
        	$orderDetails = array(
        			"order_master_id" => $salesId,
        			"product_id" => $new_package_id,
        			"name" => $new_package['name'],
        			"description" => "UPGRADE TO ".$new_package['description'],
        			"qty" => 1,
        			"unit_price" => $unit_price - $old_unit_price,
        			"tax" => $tax_amt - $old_gst,
        			"amount" => $total_amount - $old_total_amount,
        			"is_combo" => 0
        	);
        	$this->insertDetail($orderDetails);
        }
	}

	public function insertDetail($data)
	{
		$this->db->insert('order_detail', $data);
		return $this->db->insert_id();
	}

	public function newDODetail($do_master_id, $product, $remarks, $qty)
	{
		$datado = array("do_master_id" => $do_master_id,
						"product_id" => $product['id'],
						"name" => $product['name'],
						"remarks" => $remarks,
						"qty" => $qty
						);
		return $this->insertDoDetails($datado);
	}

	public function insertDoDetails($data)
	{
		$this->db->insert('do_detail', $data);
		return $this->db->insert_id();
	}

	public function newDOMaster($invoice_no, $member_id, $remarks)
	{
		$period = date("Y-m");
		$dateNow = date('Y-m-d H:i:s');
		$doNum = substr("0000000" . $this->newDONum(), -7);

		$datado = array(
			"do_num" => $doNum,
			"invoice_no" => $invoice_no,
			"period" => $period,
			"member_id" => $member_id,
			"remarks" => $remarks,
			"status" => 'PENDING',
			"do_date" => $dateNow
		);

		return $this->insertDo($datado);
	}

	public function insertDo($data)
	{
		$this->db->insert('do_master', $data);
		return $this->db->insert_id();
	}


	public function getProductsInPackage($package_id)
	{
		$data = array();
		$combo_products = $this->getAllComboProducts($package_id, "package_id");
		foreach ($combo_products as $row) {
			$product = $this->getProductInfo($row['product_id']);
			$product['qty'] = $row['qty'];
			$data[] = $product;
		}
		return $data;
	}

	public function getAllComboProducts($package_id)
	{
		$this->db->select('*');
		$this->db->from('product_combo_detail');
		$this->db->where('package_id', $package_id);

		$query = $this->db->get();
		return $query->result_array();
	}

	public function getSalesIDByOrderNum($sales_num)
	{
		$id = '';

		$this->db->select('id');
		$this->db->from('order_master');
		$this->db->where('order_num', $sales_num);

		$query = $this->db->get();

		if ($row = $query->row_array()) {
			$id = $row['id'];
		}
		return $id;
	}

	public function updateSalesInfo($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('order_master', $data);

		$this->db->where('id', $id);
    	$query = $this->db->get('order_master');

    	return $query->row_array();
	}

	public function newSalesInvoiceNum()
	{
		$gotNo = false;

		while (!$gotNo) {
			$this->db->trans_start();

			$this->db->select('*');
			$this->db->from('a_number');
			$this->db->where('id', 'invoice_no');
			$query = $this->db->get();
			$data = $query->row_array();

			$this->db->set('no', 'no+1', false);
			$this->db->where('no', $data['no']);
			$this->db->where('id', 'invoice_no');
			$this->db->update('a_number');

			$this->db->trans_complete();

			if ($this->db->trans_status()) {
				$donum = $data['no'] + 1;
				$gotNo = true;
			} else {
				usleep(10000);
			}
		}

		return $donum;
	}


	public function newSalesID()
	{
		$period = date("Y-m");
		$dateNow = date('Y-m-d H:i:s');
		$orderNum = date('YmdHis');

		$data = array(
			'order_num' => $orderNum,
			'invoice_no' => $orderNum,
			'period' => $period,
			'transaction_type' => 'SALES',
			'status' => 'PENDING',
			'order_date' => $dateNow,
		);

		if ($this->db->insert('order_master', $data)) {
			$newID = $this->db->insert_id();
			$orderNum = $this->newOrderNum();
			$invoiceNo = 'PENDING' . substr("0000000" . $newID, -7);

			$data = array(
				'order_num' => $orderNum,
				'invoice_no' => $invoiceNo,
			);

			$this->db->where('id', $newID);
			$this->db->update('order_master', $data);

			return $newID;
		} else {
			return $this->newSalesID();
		}
	}

	public function newOrderNum()
	{
		$gotNo = false;

		while (!$gotNo) {
			$this->db->trans_start();

			$this->db->select('*');
			$this->db->from('a_number');
			$this->db->where('id', 'order_num');
			$query = $this->db->get();
			$data = $query->row_array();

			$this->db->set('no', 'no+1', false);
			$this->db->where('no', $data['no']);
			$this->db->where('id', 'order_num');
			$this->db->update('a_number');

			$this->db->trans_complete();

			if ($this->db->trans_status()) {
				$ordernum = $data['no'] + 1;
				$gotNo = true;
			} else {
				usleep(10000);
			}
		}

		return $ordernum;
	}

	function newSales($member_id="", $amount="", $period="", $insert_time=""){
		$today = substr($insert_time, 0, 10);
		$member = $this->getMemberByMemberID($member_id);
		
		if (isset($member['id'])) {
			if ($period == "") $period = date("Y-m");
			if ($member['rank'] > 0) {
				$period_data = $this->db->get_where('member_sales_period', array('member_id' => $member_id, 'period' => $period))->row_array();
				if (isset($period_data['id'])) {
					$data = array('group_sales' => 'group_sales + ' . $this->db->escape($amount),'personal_sales' => 'personal_sales + ' . $this->db->escape($amount),);
					$this->db->set($data, false);
					$this->db->where('id', $period_data['id']);
					$this->db->update('member_sales_period');
				} else {
					$data = array('member_id' => $member_id,'period' => $period,'group_sales' => $amount,'personal_sales' => $amount,);
					$this->db->insert('member_sales_period', $data);					
				}
				$period_data = $this->db->get_where('member_sales_daily', array('member_id' => $member_id, 'period' => $today))->row_array();
				if (isset($period_data['id'])) {
					$data = array('group_sales' => 'group_sales + ' . $this->db->escape($amount),'personal_sales' => 'personal_sales + ' . $this->db->escape($amount),);
					$this->db->set($data, false);
					$this->db->where('id', $period_data['id']);
					$this->db->update('member_sales_daily');					
				} else {
					$data = array('member_id' => $member_id,'period' => $today,'group_sales' => $amount,'personal_sales' => $amount,);
					$this->db->insert('member_sales_daily', $data);					
				}
				$accu_data = $this->db->get_where('member_sales', array('member_id' => $member_id))->row_array();
				if (isset($accu_data['id'])) {
					$data = array('accu_group_sales' => 'accu_group_sales + ' . $this->db->escape($amount),'accu_personal_sales' => 'accu_personal_sales + ' . $this->db->escape($amount),);
					$this->db->set($data, false);
					$this->db->where('id', $accu_data['id']);
					$this->db->update('member_sales');					
				} else {
					$data = array('member_id' => $member_id,'sponsorid' => $member['sponsorid'],'accu_group_sales' => $amount,'accu_personal_sales' => $amount,);
					$this->db->insert('member_sales', $data);					
				}
				$period_data = $this->db->get_where('member_sales_matrix_period', array('member_id' => $member_id, 'period' => $period))->row_array();
				if (isset($period_data['id'])) {
					$data = array('group_sales' => 'group_sales + ' . $this->db->escape($amount),'personal_sales' => 'personal_sales + ' . $this->db->escape($amount),);
					$this->db->set($data, false);
					$this->db->where('id', $period_data['id']);
					$this->db->update('member_sales_matrix_period');					
				} else {
					$data = array('member_id' => $member_id,'period' => $period,'group_sales' => $amount,'personal_sales' => $amount,);
					$this->db->insert('member_sales_matrix_period', $data);					
				}
				$period_data = $this->db->get_where('member_sales_matrix_daily', array('member_id' => $member_id, 'period' => $today))->row_array();
				if (isset($period_data['id'])) {
					$data = array('group_sales' => 'group_sales + ' . $this->db->escape($amount),'personal_sales' => 'personal_sales + ' . $this->db->escape($amount),);
					$this->db->set($data, false);
					$this->db->where('id', $period_data['id']);
					$this->db->update('member_sales_matrix_daily');					
				} else {
					$data = array('member_id' => $member_id,'period' => $today,'group_sales' => $amount,'personal_sales' => $amount,);
					$this->db->insert('member_sales_matrix_daily', $data);					
				}
				$accu_data = $this->db->get_where('member_sales_matrix', array('member_id' => $member_id))->row_array();
				if (isset($accu_data['id'])) {
				    $data = array('accu_group_sales' => 'accu_group_sales + ' . $this->db->escape($amount),'accu_personal_sales' => 'accu_personal_sales + ' . $this->db->escape($amount),);
					$this->db->set($data, false);
					$this->db->where('id', $accu_data['id']);
					$this->db->update('member_sales_matrix');					
				} else {
				    $data = array('member_id' => $member_id,'upline_id' => $member['matrixid'],'accu_group_sales' => $amount,'accu_personal_sales' => $amount,);
					$this->db->insert('member_sales_matrix', $data);					
				}
			}
			return $this->updateUplineSalesBySponsor($member['sponsorid'], $period, $amount, $today, 0);
			$this->updateUplineSalesByMatrix($member['matrixid'], $period, $amount, $today, 0);
			return true;
		} else {
			return false;
		}
	}
	
	public function updateUplineSalesBySponsor($member_id, $period, $amount, $today, $level)
	{
		$member = $this->getMemberByMemberID($member_id);
		if (isset($member['id'])) {
			if ($member['rank'] > 0) {
				$period_data = $this->db->get_where('member_sales_period', array('member_id' => $member_id, 'period' => $period))->row_array();
				if (isset($period_data['id'])) {
					if ($level == 0){
						$data = array(
							'group_sales' => 'group_sales + ' . $this->db->escape($amount),
							'direct_sales' => 'direct_sales + ' . $this->db->escape($amount),
						);
						
						$this->db->set($data, false);
						$this->db->where('id', $period_data['id']);
						$this->db->update('member_sales_period');
					}else{
						$data = array(
							'group_sales' => 'group_sales + ' . $this->db->escape($amount),
						);
						$this->db->set($data, false);
						$this->db->where('id', $period_data['id']);
						$this->db->update('member_sales_period');						
					}
				} else {
					if ($level == 0){
						$data = array(
							'member_id' => $member_id,
							'period' => $period,
							'group_sales' => $amount,
							'direct_sales' => $amount,
						);
						$this->db->insert($this->tblSalesPeriod, $data);
					}else{
						$data = array(
							'member_id' => $member_id,
							'period' => $period,
							'group_sales' => $amount,
						);
						$this->db->insert($this->tblSalesPeriod, $data);						
					}	
				}
				$period_data = $this->db->get_where('member_sales_daily', array('member_id' => $member_id, 'period' => $today))->row_array();
				if (isset($period_data['id'])) {
					$data = array(
						'group_sales' => 'group_sales + ' . $this->db->escape($amount),
					);
				
					if ($level == 0) {
						$data['direct_sales'] = 'direct_sales + ' . $this->db->escape($amount);
					}
				
					$this->db->set($data, false);
					$this->db->where('id', $period_data['id']);
					$this->db->update('member_sales_daily');
				} else {
					$data = array(
						'member_id' => $member_id,
						'period' => $today,
						'group_sales' => $amount,
					);
				
					if ($level == 0) {
						$data['direct_sales'] = $amount;
					}
				
					$this->db->insert('member_sales_daily', $data);
				}				
				$accu_data = $this->db->get_where('member_sales', array('member_id' => $member_id))->row_array();
				if (isset($accu_data['id'])) {
					$data = array(
						'accu_group_sales' => 'accu_group_sales + ' . $this->db->escape($amount),
					);
				
					if ($level == 0) {
						$data['accu_direct_sales'] = 'accu_direct_sales + ' . $this->db->escape($amount);
					}
				
					$this->db->set($data, false);
					$this->db->where('id', $accu_data['id']);
					$this->db->update('member_sales');
				} else {
					$data = array(
						'member_id' => $member_id,
						'sponsorid' => $member['sponsorid'],
						'accu_group_sales' => $amount,
					);
				
					if ($level == 0) {
						$data['accu_direct_sales'] = $amount;
					}
				
					$this->db->insert('member_sales', $data);
				}				
			}
			$level++;
			$this->updateUplineSalesBySponsor($member['sponsorid'], $period, $amount, $today, $level);
		}
	}

	public function updateUplineSalesByMatrix($member_id, $period, $amount, $today, $level)
	{
	    $member = $this->getMemberByMemberID($member_id);
	    if (isset($member['id'])) {
	        if ($member['rank'] > 0) {
	        	//$period_data = $this->getSalesMatrixPeriodInfo("",""," WHERE member_id='$member_id' AND period='$period'");
				$period_data = $this->db->get_where('member_sales_matrix_period', array('member_id' => $member_id, 'period' => $period))->row_array();
	        	if (isset($period_data['id'])) {
					$data = array(
						'group_sales' => 'group_sales + ' . $this->db->escape($amount),
					);
				
					if ($level == 0) {
						$data['direct_sales'] = 'direct_sales + ' . $this->db->escape($amount);
					}
				
					$this->db->set($data, false);
					$this->db->where('id', $period_data['id']);
					$this->db->update('member_sales_matrix_period');
				} else {
					$data = array(
						'member_id' => $member_id,
						'period' => $period,
						'group_sales' => $amount,
					);
				
					if ($level == 0) {
						$data['direct_sales'] = $amount;
					}
				
					$this->db->insert('member_sales_matrix_period', $data);
				}
				$period_data = $this->db->get_where('member_sales_matrix_daily', array('member_id' => $member_id, 'period' => $today))->row_array();
	        	if (isset($period_data['id'])) {
					$data = array(
						'group_sales' => 'group_sales + ' . $this->db->escape($amount),
					);
				
					if ($level == 0) {
						$data['direct_sales'] = 'direct_sales + ' . $this->db->escape($amount);
					}
				
					$this->db->set($data, false);
					$this->db->where('id', $period_data['id']);
					$this->db->update('member_sales_matrix_daily');
				} else {
					$data = array(
						'member_id' => $member_id,
						'period' => $today,
						'group_sales' => $amount,
					);
				
					if ($level == 0) {
						$data['direct_sales'] = $amount;
					}
					$this->db->insert('member_sales_matrix_daily', $data);
				}				
				$accu_data = $this->db->get_where('member_sales_matrix', array('member_id' => $member_id))->row_array();
	            if (isset($accu_data['id'])) {
					$data = array(
						'accu_group_sales' => 'accu_group_sales + ' . $this->db->escape($amount),
					);
				
					if ($level == 0) {
						$data['accu_direct_sales'] = 'accu_direct_sales + ' . $this->db->escape($amount);
					}
				
					$this->db->set($data, false);
					$this->db->where('id', $accu_data['id']);
					$this->db->update('member_sales_matrix');
				} else {
					$data = array(
						'member_id' => $member_id,
						'upline_id' => $member['matrixid'],
						'accu_group_sales' => $amount,
					);
				
					if ($level == 0) {
						$data['accu_direct_sales'] = $amount;
					}
				
					$this->db->insert('member_sales_matrix', $data);
				}				
	        }
	        $level++;
	        $this->updateUplineSalesByMatrix($member['matrixid'], $period, $amount, $today, $level);
	    }
	}
	function updateNode($matrix_side = "",$volume="", $member_id = "", $period="")
    {
		$comm_config = $this->db->get_where('comm_config', array('type' => 'GIVE_INACTIVE_MEM_PTS'))->row_array();
        $give_inactive_mem_bv = $comm_config['value'];
        $member = $this->getMemberByMemberID($member_id);
        $status = isset($member['account_status']) ? $member['account_status'] : "";
        $package = $this->getProductInfo($member['package_id']);
		
        if (($status == 'INACTIVE' && $give_inactive_mem_bv == 0) || $package['binary_bonus'] == 0 || !in_array($package['id'], array(1, 2, 3, 4))) {
            $give_pts = 0;
        } else {
            $give_pts = 1;
        }
		
        if($give_pts == 1)
        {
			$count_comm = $this->db->from('member_commissions')->where("member_id", $member_id)->where("period", $period)->count_all_results();
			
            if($count_comm > 0)
            {
				$commission = $this->db->from('member_commissions')->where("member_id", $member_id)->where("period", $period)->order_by('id', 'desc')->limit(1)->get()->row_array();
				if ($matrix_side == 'R') {
					// $data = array(
					// 	'right_node' => "right_node + $volume",
					// 	'accu_right_node' => "accu_right_node + $volume",
					// 	'bright_node' => "bright_node + $volume",
					// 	'addition_right_node' => "addition_right_node + $volume"
					// );
					$data = array(
						'left_node' => $commission['right_node'] + $volume,
						'accu_left_node' => $commission['accu_right_node'] + $volume,
						'bleft_node' => $commission['bright_node'] + $volume,
						'addition_left_node' => $commission['addition_right_node'] + $volume
					);
					$this->db->set($data, false)->where('member_id', $member_id)->where('period', $period)->update('member_commissions');
				} elseif ($matrix_side == 'L') {
					// $data = array(
					// 	'left_node' => "left_node + $volume",
					// 	'accu_left_node' => "accu_left_node + $volume",
					// 	'bleft_node' => "bleft_node + $volume",
					// 	'addition_left_node' => "addition_left_node + $volume"
					// );
					$data = array(
						'left_node' => $commission['left_node'] + $volume,
						'accu_left_node' => $commission['accu_left_node'] + $volume,
						'bleft_node' => $commission['bleft_node'] + $volume,
						'addition_left_node' => $commission['addition_left_node'] + $volume
					);
					$this->db->set($data, false)->where('member_id', $member_id)->where('period', $period)->update('member_commissions');
				}
            }
            else
            {
				$this->db->select('*')->from('member_commissions')->where('member_id', $member_id)->order_by('period', 'DESC')->limit(1);
				$row = $this->db->get()->row_array();
				

                $last_balance_amt = $acc_left = $acc_right = $left = $right = $bleft = $bright = $add_right = $add_left = 0;

                //get last entry
                if(!empty($row))
				{
				    $acc_left = $row['accu_left_node'];
                    $acc_right = $row['accu_right_node'];
                    $left = $row['bleft_node'];
                    $right = $row['bright_node'];
                    $bleft = $row['bleft_node'];
                    $bright = $row['bright_node'];
                }

                if($matrix_side == 'R')
                {
                    $right = $right + $volume;
                    $acc_right = $acc_right + $volume;
                    $bright = $bright + $volume;
                    $add_right = $volume;
                }
                else if($matrix_side == 'L')
                {
                    $left = $left + $volume;
                    $acc_left = $acc_left + $volume;
                    $bleft = $bleft + $volume;
                    $add_left = $volume;
                }

                $data = array(
                    "period" => $period,
                    "member_id" => $member_id,
                    "date_created" => date('Y-m-d H:i:s'),
                    "accu_left_node" => $acc_left,
                    "accu_right_node" => $acc_right,
                    "addition_left_node" => $add_left,
                    "addition_right_node" => $add_right,
                    "left_node" => $left,
                    "right_node" => $right,
                    "bleft_node" => $bleft,
                    "bright_node" => $bright
                );
				
				$this->db->insert('member_commissions', $data);
            }
        }

        $member = $this->getMemberInfo($member_id);

        if(isset($member['matrixid']) && $member['matrixid'] > 0)
        {
            $this->updateNode($member['matrix_side'],$volume,$member['matrixid'],$period);
        }
    }

	public function getMemberInfo($id, $by = NULL)
	{
		$data = array();

		if ($by != NULL) {
			$this->tblId = "userid";
		}

		$this->db->select('a.*, (SELECT userid FROM member WHERE id = a.sponsorid limit 1) AS sponsorId, 
			(SELECT userid FROM member WHERE id = a.matrixid limit 1) AS matrixId, 
			(SELECT name FROM member_rank WHERE id = a.rank) AS rank_name');
		$this->db->from('member' . ' a');
		$this->db->where("a.id", $id);

		// execute query
		$query = $this->db->get();
		
		return $query->row_array();
	}

	function calculateBonus($from_member_id, $member_id, $userid, $amount, $insert_time, $period){
	
		if ($period == "") $period = date("Y-m");
        $from_member = $this->getMemberByMemberID($from_member_id);

        if (isset($from_member['id']))
        {
            $member = $this->getMemberByMemberID($member_id);
            if (isset($member['id'])) {
                $member_package = $this->getProductInfo($member['package_id']);
                if (isset($member_package['id']) && $member_package['sponsor_bonus'] > 0)
                {
                    $pct = $member_package['sponsor_bonus'];
					
                    if ($pct > 0) {
                        $bonus = round($pct / 100 * $amount,2);
                        $trans_no = $this->new_number("ledger_trans_no");
						
                        $comm_id = $this->addCommissionLedger($from_member_id, $member_id, $period, "SPONSOR_BONUS", $bonus,
                            $insert_time, $amount, $pct, "[[SPONSOR_BONUS]] [[FROM]] ".$userid, 1);
							
                        $description = "[[SPONSOR_BONUS]] [[FROM MEMBER]] ".$userid;
                        return $this->commToEWallet($member_id, $period, "SPONSOR_BONUS", $comm_id, $trans_no, $description, $bonus, $insert_time);
                    }
                }
            }
        }
	}

	public function commToEWallet($member_id, $period, $trans_type, $trans_id, $trans_no, $description, $amount, $trans_time, $userid="NA")
    {
        $model_bonus_data = $this->getSettingInfo("COMMISSION_SPLIT","name");
        $model_bonus = json_decode($model_bonus_data['value'], true);
        $member = $this->getMemberByMemberID($member_id);
		
        if ($member['main_acct_id'] > 0) {
            $main_account = $this->getMemberByMemberID($member['main_acct_id']);
        }
		
        if ($amount > 0) {
            if (isset($model_bonus['CC'])) {
                $cc = $model_bonus['CC'] / 100 * $amount;
                return $this->newTransaction("CC", $member_id, $period, $trans_type,
                    $trans_id, $description, 0, $cc, $trans_time, $trans_no, true, $userid);
                if (isset($main_account['id'])) {
                    $this->newTransaction("CC", $member_id, $period, "AUTO_TRANSFER",
                        $trans_id, "[[AUTO_TRANSFER]] [[TO]] ".$main_account['userid']." ".$description, $cc, 0, $trans_time, $trans_no, true, $userid);
                    $this->newTransaction("CC", $member['main_acct_id'], $period, "AUTO_TRANSFER",
                        $trans_id, "[[AUTO_TRANSFER]] [[FROM]] ".$member['userid']." ".$description, 0, $cc, $trans_time, $trans_no, true, $userid);
                }
            }
            if (isset($model_bonus['SC'])) {
                $sc = $model_bonus['SC'] / 100 * $amount;
                $this->newTransaction("SC", $member_id, $period, $trans_type,
                    $trans_id, $description, 0, $sc, $trans_time, $trans_no, true, $userid);
                if (isset($main_account['id'])) {
                    $this->newTransaction("SC", $member_id, $period, "AUTO_TRANSFER",
                        $trans_id, "[[AUTO_TRANSFER]] [[TO]] ".$main_account['userid']." ".$description, $sc, 0, $trans_time, $trans_no, true, $userid);
                    $this->newTransaction("SC", $member['main_acct_id'], $period, "AUTO_TRANSFER",
                        $trans_id, "[[AUTO_TRANSFER]] [[FROM]] ".$member['userid']." ".$description, 0, $sc, $trans_time, $trans_no, true, $userid);
                }
            }
        }
    }

	public function newTransaction($currency, $member_id, $period, $trans_type, $trans_id, $description, $debit, $credit, $trans_date, $trans_no, $is_available = true, $user="NA")
	{
		//echo $currency." ".$member_id." ".$period." ".$trans_type." ".$trans_id." ".$description." ".$debit." ".$credit." ".$trans_date." ";
		if ($this->insertDetailOnNewTransaction($currency, $member_id, $period, $trans_type, $trans_id, $description, $debit, $credit, $trans_date, $trans_no, $user)) {
			$this->updateBalanceOnNewTransaction($currency, $member_id, $period, $debit, $credit, $trans_date, $is_available);
			$this->updateBalanceTotalOnNewTransaction($currency, $member_id, $debit, $credit, $trans_date, $is_available);
			return $this->updateBalanceSummaryOnNewTransaction($currency, $member_id, $debit, $credit);
		} else {
			return false;
		}
	}

	public function updateBalanceSummaryOnNewTransaction($currency, $member_id, $debit, $credit)
	{
		$bal_data = $this->getBalanceSummary($member_id); // this getBalance will create new balance record, if it doesn't exist
		
		if (isset($bal_data['id'])) {
			if ($debit > 0 && $credit == 0) {
				$this->db->set($currency, "$currency - " . $this->db->escape($debit), false);
				$this->db->where('id', $bal_data['id']);
				$this->db->update('member_ledger_balance_summary');
				return true;
			} elseif ($credit > 0 && $debit == 0) {
				$this->db->set($currency, "$currency + " . $this->db->escape($credit), false);
				$this->db->where('id', $bal_data['id']);
				$this->db->update('member_ledger_balance_summary');
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getBalanceSummary($member_id)
    {
        if ($member_id == 0) {
            return array();
        }

		$data = $this->db->get_where('member_ledger_balance_summary', array('member_id' => $member_id))->row_array();
        if (!isset($data['id'])) {
            $data = array(
                "member_id" => $member_id,
                "CC" => 0,
                "RC" => 0,
                "SC" => 0
            );
            $data['id'] = $this->insertBalanceSummary($data);
        }
        return $data;
    }
	
    public function insertBalanceSummary($data)
    {
        $this->db->insert('member_ledger_balance_summary', $data);
        return $this->db->insert_id();
    }

	public function updateBalanceTotalOnNewTransaction($currency, $member_id, $debit, $credit, $trans_date, $is_available = true)
	{
		$user = isset($_SESSION['adminInfo']['login']) ? $_SESSION['adminInfo']['login'] : (isset($_SESSION['myAccount']['userid']) ? $_SESSION['myAccount']['userid'] : "NA");
		$bal_data = $this->getBalanceTotal($currency, $member_id); // this getBalance will create new balance record, if it doesn't exist

		if (isset($bal_data['id'])) {
			if ($debit > 0 && $credit == 0) {
				$this->db->set('available_balance', 'available_balance-' . $this->db->escape($debit), false);
				$this->db->set('balance', 'balance-' . $this->db->escape($debit), false);
				$this->db->set('debit', 'debit+' . $this->db->escape($debit), false);
				$this->db->set('edited_by', $this->db->escape($user));
				$this->db->set('date_edited', $this->db->escape($trans_date));
				$this->db->where('id', $bal_data['id']);
				$this->db->update('member_ledger_balance_total');
	
				return true;
			} elseif ($credit > 0 && $debit == 0) {
				if ($is_available) {
					$this->db->set('available_balance', 'available_balance+' . $this->db->escape($credit), false);
					$this->db->set('balance', 'balance+' . $this->db->escape($credit), false);
					$this->db->set('credit', 'credit+' . $this->db->escape($credit), false);
					$this->db->set('edited_by', $this->db->escape($user));
					$this->db->set('date_edited', $this->db->escape($trans_date));
					$this->db->where('id', $bal_data['id']);
				} else {
					$this->db->set('balance', 'balance+' . $this->db->escape($credit), false);
					$this->db->set('credit', 'credit+' . $this->db->escape($credit), false);
					$this->db->set('edited_by', $this->db->escape($user));
					$this->db->set('date_edited', $this->db->escape($trans_date));
					$this->db->where('id', $bal_data['id']);
				}
				$this->db->update('member_ledger_balance_total');
	
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getBalanceTotal ($currency, $member_id)
	{
	
		if ($member_id == 0) {
			return array();
		}
		$user = isset($_SESSION['adminInfo']['login']) ? $_SESSION['adminInfo']['login'] : (isset($_SESSION['myAccount']['userid']) ? $_SESSION['myAccount']['userid'] : "NA");
		
		//$data = $this->readRowbalInfo('member_ledger_balance_total',$member_id,$currency);
		$data = $this->db->get_where('member_ledger_balance_total', array('member_id' => $member_id, 'currency' => $currency))->row_array();
		
		if (!isset($data['id'])) {
			$bal = 0;
			$avail_bal = 0;
			$data = array("currency" => $currency,
					"member_id" => $member_id,
					"balance" => $bal,
					"available_balance" => $avail_bal,
					"debit" => 0,
					"credit" => 0,
					"edited_by" => $user,
					"date_edited" => date("Y-m-d H:i:s"),
					"date_created" => date("Y-m-d H:i:s"));
			$data['id'] = $this->insertBalanceTotal($data);
		}
		return $data;
	}

	public function insertBalanceTotal($data)
	{
		$this->db->insert('member_ledger_balance_total', $data);
        return $this->db->insert_id();
	}

	private function readRowbalInfo($table, $member_id = "", $currency = "")
    {
        $this->db->select('*');
        $this->db->from('tblMemberLedgerBalanceTotal');
        $this->db->where('member_id', $member_id);
        $this->db->where('currency', $currency);

        $query = $this->db->get();
		
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

	public function updateBalanceOnNewTransaction($currency, $member_id, $period, $debit, $credit, $trans_date, $is_available = true)
	{
		$user = isset($_SESSION['adminInfo']['login']) ? $_SESSION['adminInfo']['login'] : (isset($_SESSION['myAccount']['userid']) ? $_SESSION['myAccount']['userid'] : "NA");
		
		$bal_data = $this->getBalance($currency, $member_id, $period); // this getBalance will create new balance record, if it doesn't exist
		
		if (isset($bal_data['id'])) {
			if ($debit > 0 && $credit == 0) {
				$this->db->set('available_balance', 'available_balance-' . $this->db->escape($debit), false);
				$this->db->set('balance', 'balance-' . $this->db->escape($debit), false);
				$this->db->set('debit', 'debit+' . $this->db->escape($debit), false);
				$this->db->set('edited_by', $this->db->escape($user));
				$this->db->set('date_edited', $this->db->escape($trans_date));
				$this->db->where('id', $bal_data['id']);
				$this->db->update('member_ledger_balance');
		
				$this->db->set('available_balance', 'available_balance-' . $this->db->escape($debit), false);
				$this->db->set('balance', 'balance-' . $this->db->escape($debit), false);
				$this->db->set('edited_by', $this->db->escape($user));
				$this->db->set('date_edited', $this->db->escape($trans_date));
				$this->db->where('currency', $this->db->escape($currency));
				$this->db->where('member_id', $this->db->escape($member_id));
				$this->db->where('period >', $this->db->escape($period));
				$this->db->update('member_ledger_balance');
		
				return true;
			} elseif ($credit > 0 && $debit == 0) {
				if ($is_available) {
					$this->db->set('available_balance', 'available_balance+' . $this->db->escape($credit), false);
					$this->db->set('balance', 'balance+' . $this->db->escape($credit), false);
					$this->db->set('credit', 'credit+' . $this->db->escape($credit), false);
					$this->db->set('edited_by', $this->db->escape($user));
					$this->db->set('date_edited', $this->db->escape($trans_date));
					$this->db->where('id', $bal_data['id']);
				} else {
					$this->db->set('balance', 'balance+' . $this->db->escape($credit), false);
					$this->db->set('credit', 'credit+' . $this->db->escape($credit), false);
					$this->db->set('edited_by', $this->db->escape($user));
					$this->db->set('date_edited', $this->db->escape($trans_date));
					$this->db->where('id', $bal_data['id']);
				}
				$this->db->update('member_ledger_balance');
		
				if ($is_available) {
					$this->db->set('available_balance', 'available_balance+' . $this->db->escape($credit), false);
					$this->db->set('balance', 'balance+' . $this->db->escape($credit), false);
					$this->db->set('edited_by', $this->db->escape($user));
					$this->db->set('date_edited', $this->db->escape($trans_date));
					$this->db->where('currency', $this->db->escape($currency));
					$this->db->where('member_id', $this->db->escape($member_id));
					$this->db->where('period >', $this->db->escape($period));
				} else {
					$this->db->set('balance', 'balance+' . $this->db->escape($credit), false);
					$this->db->set('edited_by', $this->db->escape($user));
					$this->db->set('date_edited', $this->db->escape($trans_date));
					$this->db->where('currency', $this->db->escape($currency));
					$this->db->where('member_id', $this->db->escape($member_id));
					$this->db->where('period >', $this->db->escape($period));
				}
				$this->db->update('member_ledger_balance');
		
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function insertDetailOnNewTransaction($currency, $member_id, $period, $trans_type, $trans_id, $description, $debit, $credit, $trans_date, $trans_no, $user="NA")
	{
		if ($user == "NA" || $user == "") {
			$user = isset($_SESSION['adminInfo']['login']) ? $_SESSION['adminInfo']['login'] : $user;
		}
		if (($debit > 0 && $credit > 0) || ($debit == 0 && $credit == 0)) {
			return false;
		} else {
			$ewallet = $this->getBalance($currency, $member_id, $period);
	
			$blnc = isset($ewallet['balance'])? $ewallet['balance'] : $ewallet['available_balance'];
			$data = array("currency" => $currency,
					"member_id" => $member_id,
					"period" => $period,
					"trans_source_type" => $trans_type,
					"trans_id" => $trans_id,
					"trans_no" => $trans_no,
					"description" => $description,
					"debit" => $debit,
					"credit" => $credit,
					"balance" => $blnc + $credit - $debit,
					"insert_time" => $trans_date,
					"insert_by" => $user
			);
			$this->insertLedger($data);
			return true;
		}
	}

	public function insertLedger ($data)
	{
		$this->db->insert('member_ledger', $data);
        return $this->db->insert_id();
	}

	public function getBalance ($currency, $member_id, $period = NULL) {
		$data = array();
        $this->db->select('SUM(debit) as dr, SUM(credit) as cr');
        $this->db->from('member_ledger');
        $this->db->where('member_id', $member_id);
        $this->db->where('currency', $currency);

        $query = $this->db->get();
		
        $data['available_balance'] = 0;

        foreach ($query->result() as $row) {
            $data['available_balance'] = $row->cr - $row->dr;
        }
        return $data;
      }

	  

	public function getSettingInfo($id="", $by="", $where="")
    {
        $this->db->select('*');
        $this->db->from('bonus_setting');
		
        // if ($id != "") {
        //     $this->db->where('id', $id);
        // }

        // if ($by != "") {
        //     $this->db->where('column_name', $by);
        // }

        // if ($where != "") {
        //     $this->db->where($where);
        // }
		
        $query = $this->db->get();
        return $query->row_array();
    }

	public function addCommissionLedger($from_id, $member_id, $period, $comm_type, $amount, $trans_date, $based_on, $percent, $description, $is_push)
    {
        if ($amount > 0 && $member_id > 0 && $period != "") {
            $data = array("period" => $period,
                "member_id" => $member_id,
                "from_member_id" => $from_id,
                "comm_type" => $comm_type,
                "amount" => $amount,
                "date_created" => $trans_date,
                "based_on" => $based_on,
                "percent" => $percent,
                "is_push" => $is_push,
                "description" => $description
            );
            return $this->insertCommissionLedger($data);
        }
    }

	public function insertCommissionLedger($data)
    {
        $this->db->insert('member_commission_ledger', $data);
        return $this->db->insert_id();
    }

	public function new_number($type)
    {
        $new_num = '';
        $gotNo = false;
		
        while (!$gotNo) {
            $data = $this->getNumberInfo($type);
			
            if (isset($data['id'])) {
                $this->db->trans_start();

                $this->db->where('no', $data['no']);
                $this->db->where('id', $type);
                $this->db->set('no', 'no+1', false);
                $this->db->update('a_number');

                $this->db->trans_complete();

                if ($this->db->trans_status()) {
                    $new_num = $data['no'] + 1;
                    $gotNo = true;
                } else {
                    usleep(1000);
                }
            }
        }
        return $new_num;
    }

    public function getNumberInfo($id = "", $by = "", $where = "")
    {
        return $this->readRowInfo('a_number', $id, $by, $where);
    }

    private function readRowInfo($table, $id = "", $by = "", $where = "")
    {
        $this->db->select('*');
        $this->db->from('a_number');

        $query = $this->db->get();
		//return $query;
        return $query->row_array();
    }

	// public function new_number($type)
	// {
	// 	$new_num = '';
	// 	$gotNo = false;
	// 	while (!$gotNo) {
	// 		$data = $this->getNumberInfo($type);
	// 		if (isset($data['id'])) {
	// 			$query = "UPDATE a_number SET no=no+1 WHERE no='".$data['no']."' AND id='$type'";
	// 			$this->executeNonQuery($query);
	// 			if ($this->affectedRows() > 0) {
	// 				$new_num = $data['no'] + 1;
	// 				$gotNo = true;
	// 			} else {
	// 				usleep(1000);
	// 			}
	// 		}
	// 	}
	// 	return $new_num;
	// }

	// public function getNumberInfo($id="", $by="", $where="")
	// {
	// 	return $this->readRowInfo($this->tblNumber, $id, $by, $where);	
	// }

	public function getProductInfo($id)
	{
		$this->db->where("id", $id);
		$query = $this->db->get('product');
		return $query->row_array();
	}

	public function getMemberByMemberID($_id)
    {
		$this->db->where("id", $_id);
		$query = $this->db->get('member');
		return $query->row_array();
    }

	function updateMemberInfo($id, $posts)
	{
		$arr = new stdClass();
		foreach ($posts as $key => $post) {
			$arr->$key = $post;
		}
		return $this->db->update('member', $arr, array('id' => $id));
	}

	function getSubAccounts($user_id)
	{
		$this->db->where("main_acct_id", $user_id);
		$query = $this->db->get('member');
		return $query->result_array();
	}

	function checkSubAccount($user_id)
	{
		$this->db->where("main_acct_id", $user_id);
		$query = $this->db->get('member');
		return $query->result_array();
	}

	function getMemberByMatrixId($user_id)
	{
		$this->db->where("matrixid", $user_id);
		$query = $this->db->get('member');
		return $query->result_array();
	}

	function getMemberByMatrixIdSide($user_id, $side)
	{
		$this->db->where("matrix_side", $side);
		$this->db->where("matrixid", $user_id);
		$query = $this->db->get('member');
		return $query->row_array();
	}

	function getSponsored($user_id)
	{
		$this->db->where("sponsorid", $user_id);
		$query = $this->db->get('member');
		return $query->result_array();
	}

	function getAllMembers($post = null)
	{
		$this->db->select('
			m.id, m.userid, m.special_account, m.f_name, m.l_name, m.mobile, m.email,
			spn.userid as sponsor_name,
			mtr.userid as matrix_name,
			mr.name as rank_name,
			p.name as package_name
		');
		$this->db->join('product p', 'p.id = m.package_id', 'left');
		$this->db->join('member_rank mr', 'mr.id = m.rank', 'left');
		$this->db->join('member mtr', 'mtr.id = m.matrixid', 'left');
		$this->db->join('member spn', 'spn.id = m.sponsorid', 'left');
		if (!empty($post['userid'])) {
			$this->db->like("m.userid", $post['userid']);
			$this->db->or_like("m.mobile", $post['userid']);
			$this->db->or_like("m.username", $post['userid']);
			$this->db->or_like("m.f_name", $post['userid']);
			$this->db->or_like("m.l_name", $post['userid']);
		}

		$this->db->from("member m");
		$tempdb = clone $this->db;
		if (isset($post['per_page'])) {
			$start = ($post['page'] - 1) * $post['per_page'];
			$this->db->limit($post['per_page'], $start);
		}
		$data['counter'] = $tempdb->count_all_results("", false);
		$query = $this->db->get();
		$data['result'] =  $query->result_array();
		return $data;
	}
	function exportAllMembers($post = null)
	{
		$this->db->select('
			m.id, m.userid, m.f_name, m.l_name, m.matrix_side, m.mobile, m.email,
			spn.userid as sponsor_name,
			mtr.userid as matrix_name,
			mr.name as rank_name,
			p.name as package_name
		');
		$this->db->join('product p', 'p.id = m.package_id', 'left');
		$this->db->join('member_rank mr', 'mr.id = m.rank', 'left');
		$this->db->join('member mtr', 'mtr.id = m.matrixid', 'left');
		$this->db->join('member spn', 'spn.id = m.sponsorid', 'left');
		if (!empty($post['userid'])) {
			$this->db->like("m.userid", $post['userid']);
		}
		$this->db->from("member m");
		$query = $this->db->get();
		return $query->result_array();
	}

	function getMemberDetailsByUserid($userid)
	{
		$this->db->select('
			m.id, m.userid, m.f_name, m.l_name, m.mobile, m.email, m.can_withdraw, m.referral_side,
			spn.userid as sponsor_name,
			rfr.userid as rfr_name,
			c.full_name as country_name, c.short_name as country_short_name, c.code as country_code,
			spn.userid as sponsor_name,
			ms.accu_group_sales, ms.accu_personal_sales, ms.accu_direct_sales,
			mtr.userid as matrix_name,
			mr.name as rank_name,
			p.name as package_name
		');
		$this->db->join('product p', 'p.id = m.package_id', 'left');
		$this->db->join('member_rank mr', 'mr.id = m.rank', 'left');
		$this->db->join('member mtr', 'mtr.id = m.matrixid', 'left');
		$this->db->join('member spn', 'spn.id = m.sponsorid', 'left');
		$this->db->join('member rfr', 'rfr.id = m.referral_placement', 'left');
		$this->db->join('member_sales ms', 'ms.member_id = m.id', 'left');
		$this->db->join('country_list c', 'c.id = m.country', 'left');
		$this->db->where('m.userid', $userid);
		$query = $this->db->get('member m');
		$user = $this->getMemberInfoByUserid($userid);
		$data['member_detail'] = $query->row_array();
		$data['reports'] = $this->ReportModel->dashboard($user, getMonth());
		$data['banks'] = $this->BankModel->getMemberBanks($user['id']);
		return $data;
	}

	function searchMemberDetailsByUserid($userid)
	{
		$this->db->select('
			m.id, m.userid, m.f_name, m.l_name, m.mobile, m.email, m.can_withdraw, m.referral_side,
			spn.userid as sponsor_name,
			rfr.userid as rfr_name,
			c.full_name as country_name, c.short_name as country_short_name, c.code as country_code,
			spn.userid as sponsor_name,
			ms.accu_group_sales, ms.accu_personal_sales, ms.accu_direct_sales,
			mtr.userid as matrix_name,
			mr.name as rank_name,
			p.name as package_name
		');
		$this->db->join('product p', 'p.id = m.package_id', 'left');
		$this->db->join('member_rank mr', 'mr.id = m.rank', 'left');
		$this->db->join('member mtr', 'mtr.id = m.matrixid', 'left');
		$this->db->join('member spn', 'spn.id = m.sponsorid', 'left');
		$this->db->join('member rfr', 'rfr.id = m.referral_placement', 'left');
		$this->db->join('member_sales ms', 'ms.member_id = m.id', 'left');
		$this->db->join('country_list c', 'c.id = m.country', 'left');
		$this->db->where('m.userid', $userid);
		$this->db->or_where('m.username', $userid);
		$this->db->or_where('m.email', $userid);
		$this->db->or_where('m.f_name', $userid);
		$this->db->or_where('m.l_name', $userid);
		$query = $this->db->get('member m');
		$user = $this->getMemberInfoByUserid($userid);
		$data['member_detail'] = $query->row_array();
		$data['reports'] = $this->ReportModel->dashboard($user, getMonth());
		$data['banks'] = $this->BankModel->getMemberBanks($user['id']);
		return $data;
	}

	function getMemberWithRankDetail($user_id)
	{
		$this->db->select("member.id, member.userid, member.f_name, member.l_name, member.rank, member_rank.name as rank_name, member.email, member.mobile, member.join_date, member.account_status");
		$this->db->where("sponsorid", $user_id);
		$this->db->join('member_rank', 'member_rank.id = member.rank');
		$query = $this->db->get('member');
		return $query->result_array();
	}

	function getMemberSummary($period, $main = false)
	{
		if ($main == true) {
			$this->db->where("main_acct_id", 0);
		}
		$this->db->like("join_date", $period);
		$query = $this->db->get('member');
		return $query->num_rows();
	}

	public function mobile_check($mobile){
		$this->db->where("main_acct_id", 0);
		$this->db->where("mobile", $mobile);
		$query = $this->db->get('member');
		return $query->row_array();
	}
}
