<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductPurchaseHitpayModel extends CI_Model
{
	public function purchaseProduct($post)
	{
		$errors = array();
		$result = $this->PaymentModel->getHitpaySession($post['reference']);
		$system = $this->SystemModel->getConstants();
		if (isset($result['status']) and $result['status'] == 'completed') {
			$user = $this->MemberModel->getMemberInfoByToken($post['access_token']);
			$cart_items = $this->CartModel->getCartByMasterId($post['order_num']);
			$cart_bv = 0;
			$cart_total = 0;
			foreach ($cart_items as $item) {
				$cart_total += ($item['qty'] * (float)$item['unit_price']);
				$cart_bv += ($item['qty'] * (float)$item['BV']);
			}
			if ($cart_total <= 0) {
				$errors[] = "[[LABEL_ORDER_DETAILS]]";
			}
			$trans_time = getFullDate();
			$period = getMonth();
			if (count($errors) < 1) {
				$master = array(
					'period' => $period,
					'order_num' => $post['order_num'],
					'invoice_no' => $post['order_num'],
					'customer_type' => "MEMBER",
					'order_type' => "PRODUCT",
					'member_id' => $user['id'],
					'description' => '[[DEF_PURCHASE_ITEMS]]',
					'currency' => '[[SGD]]',
					'total_amount' => $cart_total * $system['USD_SGD_TOPUP'],
					'subtotal' => $cart_total * $system['USD_SGD_TOPUP'],
					'discount' => 0,
					'gst' => 0,
					'shipment_cost' => 0,
					'total_pv' => $cart_bv,
					'total_extra_pv' => 0,
					'transaction_type' => "ORDER",
					'payment_type' => "HITPAY",
					'payment_currency' => "SGD",
					'payment_amount' => $cart_total * $system['USD_SGD_TOPUP'],
					'status' => "PAID",
					'order_date' => $trans_time,
					'done_by' => $user['id'],
					'transaction_date' => $trans_time,
					'session_id' => $result['id'],
					'is_bonus_calculated' => 0,
					'smshare_copied' => 0,
					'smshare_response' => "",
				);
				$this->process($master, $cart_items);

				$return['order_num'] = $post['order_num'];
				$return['trans_time'] = $trans_time;
				$return['status'] = "[[PAID]]";
				$return['payment_mode'] = "[[HITPAY]]";
				$return['amount'] = "SGD " . $cart_total * $system['USD_SGD_TOPUP'];
				$return['total_bv'] = $cart_bv;
				return successReponse("[[ORDER_PLACED_SUCCESSFULLY_WITH_HITPAY]]", $return);
			}
			return failedReponse("[[ORDER_PLACEMENT_FAILED]]", $errors);
		}
	}

	public function process($master, $order)
	{
		$master_id = $this->DistributionModel->insert_master($master);
		$order_detail = array();
		foreach ($order as $key => $item) {
			$order_detail[$key]['order_master_id'] = $master_id;
			$order_detail[$key]['product_id'] = $item['id'];
			$order_detail[$key]['name'] = $item['name'];
			$order_detail[$key]['description'] = $item['description'];
			$order_detail[$key]['qty'] = $item['qty'];
			$order_detail[$key]['unit_price'] = $item['unit_price'];
			$order_detail[$key]['fee'] = 0;
			$order_detail[$key]['tax'] = 0;
			$order_detail[$key]['amount'] = ($item['qty'] * (float)$item['unit_price']);
			$order_detail[$key]['is_combo'] = ($item['is_combo'] == "N" ? 0 : 1);
			$order_detail[$key]['is_combochild'] = 0;
			$order_detail[$key]['is_purchase_once'] = 0;
		}
		$this->db->insert_batch('order_detail', $order_detail);
		$this->updateCartDetails($master['member_id'], $master['order_num']);
	}

	public function updateCartDetails($user_id, $order_num)
	{
		$this->db->update('product_cart', array("master_id" => $order_num, "is_processed" => 1, "is_paid" => 1, "payment_mode" => "HITPAY"), array('member_id' => $user_id));
	}
}
