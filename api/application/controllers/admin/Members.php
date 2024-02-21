<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Members extends CI_Controller
{
	public function all()
	{
		$list = $this->MemberModel->getAllMembers($_POST);
		return successReponse("", $list);
	}

	// public function get()
	// {
	// 	$user = $this->MemberModel->getAdminInfoByIdLogin(decode($_POST['access_token']));
	// 	$member = $this->MemberModel->getMemberDetailsByUserid($_POST['userid']);
	// 	return successReponse("", $member);
	// }
	
	public function get()
	{
		$user = $this->MemberModel->getAdminInfoByIdLogin(decode($_POST['access_token']));
		$member = $this->MemberModel->getMemberDetailsByUserid($_POST['userid']);
		$packageDetails = $this->ajaxGetUpgradePackages($_POST['userid']);
		$data = array();
		$data['member'] = $member;
		$data['packageDetails'] = $packageDetails;
		return successReponse("", $data);
	}

	public function balance_adjust()
	{
		$member = $this->MemberModel->getMemberInfoByIdUseridEmail($_POST['userid']);
		$currencies = $this->CurrencyModel->get();

		foreach ($currencies as $currency) {
			$this->LedgerModel->refine_ledger($member['id'], $currency->name);
		}

		return successReponse("", $member);
	}

	public function get_packages(){
		unset($_POST['access_token']);
		$package_id = $_POST['package_id'];
		$product = $this->ProductModel->get($package_id);

		return successReponse("", $product);
	}

	public function ajaxGetPackageTopUpPrice()
    {
		$cid = $_POST['cid'];
        $carray         = explode('_', $cid);
        $pkg            = $this->ProductModel->getProductInfo($carray[0]);
        $usr            = $this->MemberModel->getMemberDetailsByUserid($carray[1]);
		$user_package   = $this->ProductModel->getProductInfo($usr['reports']['MAIN_ACCOUNT']['package_id']);
        $user_pkg_price = $pkg_price = 0;
		
        if (isset($pkg['price']))
            $pkg_price = $pkg['price'];
        if (isset($user_package['price']))
            //$user_pkg_price = $user_package['price'];
			$user_pkg_price = $usr['member_detail']['accu_personal_sales'];
        if (($pkg_price - $user_pkg_price) >= 0)
            $paid_amount = number_format(($pkg_price - $user_pkg_price), 2);
			return successReponse("", $paid_amount);
    }

	public function getMemberInfoFromUserID()
    {
		$id = $_POST['userid']; 
		
		$member = $this->MemberModel->getMember($id);
		return successReponse("", $member);

    }

	public function updateMemberInfo(){
		$data = array();
		$id = $_POST['id'];
		$data = json_decode($_POST['data']);
	

		$member = $this->MemberModel->updateInfo($id, $data);
		return successReponse("", $member);
	}

	public function calculateSponsorBonus(){
		$id = $_POST['id'];
		$sponsorid = $_POST['sponsorid'];
		$userid = $_POST['userid'];
		$topup = $_POST['topup'];
		$insert_time = $_POST['insert_time'];
		$period = $_POST['period'];

		$responce = $this->MemberModel->calculateBonus($id, $sponsorid, $userid, $topup, $insert_time, $period);
		return successReponse("", $responce);
	}

	public function calculateBV(){
		$id = $_POST['member_id'];
		$topup = $_POST['topup'];
		$date = $_POST['date'];

		$responce = $this->MemberModel->calculateBV($id, $topup, $date);
		return successReponse("", $responce);
	}

	public function getBalance(){
		$member_id = $_POST['member_id'];
		$CASH_CREDIT = $_POST['CASH_CREDIT'];

		$responce = $this->MemberModel->getBalance('', $member_id, '');
		return successReponse("", $responce);
	}
	
	public function new_number(){

		$responce = $this->MemberModel->new_number('ledger_trans_no');
		return successReponse("", $responce);
	}

	public function newTransaction(){
		//$this->member_ledger_model->newTransaction("CC", $member['id'], $period, "UPGRADE", $member['id'], $desc, $topup, 0, $insert_time, $trans_no, true, $member['userid']);
		$member_id = $_POST['member_id'];
		$period = $_POST['period'];
		$desc = $_POST['desc'];
		$topup = $_POST['topup'];
		$insert_time = $_POST['insert_time'];
		$trans_no = $_POST['trans_no'];
		$userid = $_POST['userid'];

		$responce = $this->MemberModel->newTransaction("CC", $member_id, $period, "UPGRADE", $member_id, $desc, $topup, 0, $insert_time, $trans_no, true, $member_id);
		return successReponse("", $responce);
	}

	public function newSales(){
		$member_id = $_POST['member_id'];
		$topup = $_POST['topup'];
		$period = $_POST['period'];
		$insert_time = $_POST['insert_time'];
	
		$responce = $this->MemberModel->newSales($member_id,$topup,$period,$insert_time);
		return successReponse("", $responce);
	}

	public function  saveUpgradePackageTransaction(){
		$member_id = $_POST['member_id'];
		$old_package_id = $_POST['current_package'];
		$new_package_id = $_POST['new_package'];
		$gateway = $_POST['upgrade_data'];
		$status = $_POST['PAID'];

		$responce = $this->MemberModel->saveUpgradePackageTransaction($member_id, $old_package_id, $new_package_id, $gateway, $status);
		return successReponse("", $responce);
	}

	public function ajaxGetUpgradePackages($_id)
    {
        $usr = $this->MemberModel->getMemberInfoByUserid($_id);
        if (isset($usr['id'])) {
			//not company account (PAID ACCOUNT), so get package with price > than the package bought, with SAME number of account (nodes)
            //currently only for upgrade of 1 node account to 1 node, or 3 node to 3 node. cannot 1 node to 3 node
            if ($usr['special_account'] == 0) {
				$str         = '<select id="selPackage" name="selPackage" onchange="getPackageCost()"><option value="-1">Please select a package</option>';
                $package = $this->ProductModel->getProductInfo($usr['package_id']);
                $allpackages = $this->ProductModel->getAllProductsPackages($package['price']);										
				
				//echo "<pre>"; print_r($allpackages); die;
                foreach ($allpackages as $p) {
                    if (($p['price'] > $package['price']) && ($p['no_of_accounts'] == $package['no_of_accounts']) && ($p['id'] != $package['id']))
                        $str = $str . '<option value="' . $p['id'] . '">' . $p['name'] . '</option>';
                }
                $str = $str . '</select>';

            } else {
                //company account (FREE ACCOUNT), so get all packages with price > 0, with SAME number of account (nodes)
                //currently only for upgrade of 1 node account to 1 node, or 3 node to 3 node. cannot 1 node to 3 node
                $str         = '<select id="selPackage" name="selPackage" onchange="getPackageCost()"><option value="-1">Please select a package</option>';
                $package = $this->product_model->getProductInfo($usr['package_id']);
                $allpackages = $this->product_model->getAllProductsPackages("",""," WHERE is_active=1 AND type_id=1 AND price > ".$package['price'].' ORDER BY price ASC');
                foreach ($allpackages as $p) {
                    if (($p['price'] > 0) && ($p['no_of_accounts'] == $package['no_of_accounts']) && ($p['id'] != $package['id'])) {
                        $str = $str . '<option value="' . $p['id'] . '">' . $p['name'] . '</option>';
                    }
                }
                $str = $str . '</select>';
            }
        } else {
        	$str = '<select name="selPackage" id="selPackage" onchange="getPackageCost()"><option value="-1">Please select a package</option></select>';
        }
        //$lang   = $this->language_model->setLanguage();
        //$msg = $this->language_model->replaceLanguage($str, $lang);
		//echo $msg; die;
        return $str;
        
    }
	
	public function update($userid)
	{
		$user = $this->MemberModel->getAdminInfoByIdLogin(decode($_POST['access_token']));
		$member = $this->MemberModel->getMemberDetailsByUserid($userid);
		$posts['f_name'] = $_POST['f_name'];
		$posts['l_name'] = $_POST['l_name'];
		$posts['email'] = $_POST['email'];
		$posts['mobile'] = $_POST['mobile'];
		$member = $this->MemberModel->updateMemberInfo($member['member_detail']['id'], $posts);
		return successReponse("", $member);
	}

	public function update_credits($userid)
	{
		$user = $this->MemberModel->getAdminInfoByIdLogin(decode($_POST['access_token']));
		$member = $this->MemberModel->getMemberDetailsByUserid($userid);

		$reports = $member['reports'];
		$details = $member['member_detail'];

		$period = getMonth();
		$trans_id = getTransId();
		$date = getFullDate();

		if ($_POST['rc_amount'] > 0 and $_POST['rc_action'] != "") {
			$rc_trans = $_POST['rc_action'] == "+" ? "ADMIN ADD E-WALLET" : "ADMIN DEDUCT E-WALLET";
			$rc_debit = $_POST['rc_action'] == "+" ? 0 : $_POST['rc_amount'];
			$rc_credit = $_POST['rc_action'] == "-" ? 0 : $_POST['rc_amount'];
			$rc_balance = $reports['RCs']['balance'] + $rc_credit - $rc_debit;
			$ledger = array(
				"currency" => "RC",
				"member_id" => $details['id'],
				"period" => $period,
				"trans_source_type" => $rc_trans,
				"trans_id" => $trans_id,
				"trans_no" => $trans_id,
				"description" => $_POST['rc_description'],
				"debit" => $rc_debit,
				"credit" => $rc_credit,
				"balance" => $rc_balance,
				"insert_time" => $date,
				"insert_by" => "Admin"
			);
			$return = $this->LedgerModel->insertLedger($ledger);
		}

		if ($_POST['cc_amount'] > 0 and $_POST['cc_action'] != "") {
			$cc_trans = $_POST['cc_action'] == "+" ? "ADMIN ADD E-WALLET" : "ADMIN DEDUCT E-WALLET";
			$cc_debit = $_POST['cc_action'] == "+" ? 0 : $_POST['cc_amount'];
			$cc_credit = $_POST['cc_action'] == "-" ? 0 : $_POST['cc_amount'];
			$cc_balance = $reports['CCs']['balance'] + $cc_credit - $cc_debit;
			$ledger = array(
				"currency" => "CC",
				"member_id" => $details['id'],
				"period" => $period,
				"trans_source_type" => $cc_trans,
				"trans_id" => $trans_id,
				"trans_no" => $trans_id,
				"description" => $_POST['cc_description'],
				"debit" => $cc_debit,
				"credit" => $cc_credit,
				"balance" => $cc_balance,
				"insert_time" => $date,
				"insert_by" => "Admin"
			);
			$this->LedgerModel->insertLedger($ledger);
		}

		return successReponse("", $member);
	}

	public function add()
	{
		$admin = $this->MemberModel->getAdminInfoByIdLogin(decode($_POST['access_token']));
		$errors = array();
		$sponsor = $this->MemberModel->getMemberInfoByUserid($_POST['sponsor_id']);
		$matrix = $this->MemberModel->getMemberInfoByUserid($_POST['matrix_id']);

		if (!$sponsor['id']) {
			$errors[] = "[[LABEL_INVALID_SPONSOR]]";
		}
		if (strlen($_POST['f_name']) < 1) {
			$errors[] = "[[LABEL_FIRSTNAME_MIN_LENGTH_1]]";
		}
//		if (strlen($_POST['l_name']) < 2) {
//			$errors[] = "[[LABEL_LASTNAME_MIN_LENGTH_1]]";
//		}
		if (strlen($_POST['mobile']) != 8) {
			$errors[] = "[[LABEL_MOBILE_LENGTH_INVALID]]";
		}
		$_POST['sponsor_id'] = $sponsor['id'];

		if (!$matrix['id']) {
			$errors[] = "[[LABEL_INVALID_MATRIX]]";
		}
		$_POST['matrix_id'] = $matrix['id'];

		$system = $this->SystemModel->getConstants();

      	if ($system['UNIQUE_MOBILE_CHECK'] == 1 and $_POST['downline_type'] == 0) {
			$mobile_exists = $this->MemberModel->mobile_check($_POST['mobile']);
			if ($mobile_exists) {
				$errors[] = "[[LABEL_MOBILE_EXISTS]]";
			}
		}

      	if (count($errors) < 1) {
			$user = $this->SignupModel->createUser($_POST);
			return successReponse("[[SIGNUP_SUCCESSFULLY_WITH_ZERO_PACKAGE]]", $user);
		}
		return failedReponse("[[SIGNUP_FAILED]]", $errors);
	}
}

