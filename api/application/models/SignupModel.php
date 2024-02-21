<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SignupModel extends CI_Model
{
	public function getMemberFormData()
	{
		$return['gateways'] = $this->PaymentModel->getGateways("ACTIVE");
		$return['packages'] = $this->ProductModel->getPackages("ACTIVE");
		$return['countries'] = $this->CountryModel->getAllCountries();
		return $return;
	}

	public function getMax()
	{
		$this->db->select_max('userid');
		$query = $this->db->get('member');
		return $query->row_array()['userid'] + 1;
	}

	public function createUser($signup_data)
	{
		$max = $this->getMax();
		$signup_data['account_type'] = isset($signup_data['account_type'])? $signup_data['account_type'] : 0;
		$account_type = $signup_data['account_type'] == 0 ? "FREE" : "NORMAL";
		$special_account = $signup_data['account_type'] == 0 ? 1 : 0;
		$user_data = array(
			"sponsorid" => $signup_data['sponsor_id'],
			"matrixid" => $signup_data['matrix_id'],
			"matrix_side" => $signup_data['matrix_side'],
			"userid" => $max,
			"rank" => 1,
			"f_name" => $signup_data['f_name'],
			"l_name" => $signup_data['l_name'],
			"country" => $signup_data['country'],
			"account_type" => $account_type,
			"special_account" => $special_account,
			"mobile" => $signup_data['mobile'],
			"join_date" => date('Y-m-d H:i:s'),
			"package_id" => $signup_data['package_id'],
			"email" => $signup_data['email'],
			"account_status" => "ACTIVE",
		);

		if ($signup_data['downline_type'] == 0) {
			$pass = randomString(8);
			$ps = generatePassword($pass);
			$user_data["main_acct_id"] = 0;
			$user_data["password"] = $ps['password'];
			$user_data["primary_salt"] = $ps['salt'];
			$user_data["sec_password"] = "";
			$user_data["secondary_salt"] = "";
		} else {
			$spnid = isset($signup_data['user']) ? $signup_data['user'] : $signup_data['sponsor_id'];
			$user = $this->MemberModel->getMemberInfoByIdUseridEmail($spnid);
			$user_data["main_acct_id"] = $signup_data['sponsor_id'];
			$user_data["password"] = $user["password"];
			$user_data["primary_salt"] = $user["primary_salt"];
			$user_data["sec_password"] = $user["sec_password"];
			$user_data["secondary_salt"] = $user["secondary_salt"];
		}
            
		$this->db->insert('member', $user_data);
		$id = $this->db->insert_id();
        
      
		$user_data['id'] = $id;
		if($signup_data['package_id'] > 0) {
			$trans_time = getFullDate();
			$order_num = getTransId();
			$period = getMonth();
			$p['id'] = $signup_data['package_id'];
			$product = $this->ProductModel->getPackages($p);
			$system = $this->SystemModel->getConstants();

          	if ($id) {
				$master = array(
					'period' => $period,
					'order_num' => $order_num,
					'invoice_no' => $order_num,
					'customer_type' => "MEMBER",
					'order_type' => "PACKAGE",
					'member_id' => $id,
					'description' => '[[DEF_PACKAGE_PURCHASE]]',
					'currency' => '[[SGD]]',
//					'total_amount' => $product['price'] * $system['USD_SGD_TOPUP'],
//					'subtotal' => $product['price'] * $system['USD_SGD_TOPUP'],
					'total_amount' => $product['price'],
					'subtotal' => $product['price'],
					'discount' => 0,
					'gst' => 0,
					'shipment_cost' => 0,
					'total_pv' => $product['BV'],
					'total_extra_pv' => 0,
					'transaction_type' => "ORDER",
					'payment_type' => "STRIPE",
					'payment_currency' => "SGD",
//					'payment_amount' => $product['price'] * $system['USD_SGD_TOPUP'],
					'payment_amount' => $product['price'],
					'status' => "PAID",
					'order_date' => $trans_time,
					'done_by' => $user_data['sponsorid'],
					'transaction_date' => $trans_time,
					'session_id' => "AdminGenerated",
					'is_bonus_calculated' => 0,
					'smshare_copied' => 0,
					'smshare_response' => "",
				);
				$this->process($master, $product);
			}
		}

		$number = sms_number($user_data['mobile']);
		if ($signup_data['downline_type'] == 0) {
			$message = "User $max has been created and auto generated password by Ginseng is: " . $pass;
		} else {
			$message = "User $max has been created. Please use the password of main account. ";
		}
		sms($number, $message);
		return $user_data;
	}

	public function process($master, $item)
	{
		$master_id = $this->DistributionModel->insert_master($master);
		$order_detail = array();
		$order_detail['order_master_id'] = $master_id;
		$order_detail['product_id'] = $item['id'];
		$order_detail['name'] = $item['name'];
		$order_detail['description'] = $item['description'];
		$order_detail['qty'] = 1;
		$order_detail['unit_price'] = $item['unit_price'];
		$order_detail['fee'] = 0;
		$order_detail['tax'] = 0;
		$order_detail['amount'] = $item['unit_price'];
		$order_detail['is_combo'] = ($item['is_combo'] == "N" ? 0 : 1);
		$order_detail['is_combochild'] = 0;
		$order_detail['is_purchase_once'] = 0;
		$this->db->insert('order_detail', $order_detail);
	}
}
