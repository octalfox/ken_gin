<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Packages extends CI_Controller
{
	public function index()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/packages/all", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/packages/list", $data);
	}

	public function add()
	{
		if (isset($_POST['name'])) {
			$req = $_POST;
			if(isset($_FILES['fileimg']['tmp_name'])) {
				$req['extension'] = pathinfo($_FILES['fileimg']['name'], PATHINFO_EXTENSION);
				$req['filedata'] = file_get_contents($_FILES['fileimg']['tmp_name']);
			}
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/packages/add", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_PACKAGE_ADDED]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_PACKAGE_FAILED]]"
				);
			}
			redirect(base_url("packages"));
			exit;
		}
		userTemplate("pages/packages/add", array());
	}

	public function edit($id)
	{
		if (isset($_POST['name'])) {
			$req = $_POST;
			if(isset($_FILES['fileimg']['tmp_name'])) {
				$req['extension'] = pathinfo($_FILES['fileimg']['name'], PATHINFO_EXTENSION);
				$req['filedata'] = file_get_contents($_FILES['fileimg']['tmp_name']);
			}
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/packages/add", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_PACKAGE_ADDED]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_PACKAGE_FAILED]]"
				);
			}
			redirect(base_url("packages"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$data['prod'] = post_curl("admin/packages/get/$id", $req)['data'];
		userTemplate("pages/packages/edit", $data);
	}

	public function delete($id)
	{
		$req = $_POST;
		$req['access_token'] = $_SESSION['userSession'];
		$req['id_to_delete'] = $id;
		$response = post_curl("admin/packages/delete", $req);
		if ($response['response'] == "success") {
			$_SESSION['alert'] = array(
				"class" => "success",
				"content" => "[[LABEL_PACKAGE_DELETE]]"
			);
		} else {
			$_SESSION['alert'] = array(
				"class" => "danger",
				"content" => "[[LABEL_PACKAGE_FAILED]]"
			);
		}
		redirect(base_url("packages"));
		exit;
	}

	public function upgrade_package($userid="")
    {
		$data['title'] = "[[ADM_UPGRADE_PACKAGE]]";
        if ($userid != "") {
        	$data['memberInfo'] = $this->member_model->getMemberByUserID($userid);
        }
        if (isset($_POST['btnSave'])) {
			
            if (isset($_POST['txtUserId'])) {
				$req['access_token'] = $_SESSION['userSession'];
				$req['userid'] = $_POST['txtUserId'];
				$userExist = post_curl("admin/members/get", $req)['data'];
				
                if (empty($userExist)) {
					$_SESSION['alert'] = array(
						"class" => "success",
						"content" => "[[MSG_INVALID_USER_ID]]"
					);
					redirect(base_url("packages/upgrade_package/"));
					exit;
                } else {
                	if (isset($_POST['selPackage']) && $_POST['selPackage'] != -1) {
						$req['access_token'] = $_SESSION['userSession'];
						$req['package_id'] = $_POST['selPackage'];
						$package = post_curl("admin/members/get_packages", $req)['data'];

                		if (isset($package['id'])) {
                			$info = array(
                					"userid" => $_POST['txtUserId'],
                					"new_package" => $package['id'],
                					"payment_mode" => $_POST['payment_mode']
                			);
                			$_SESSION['upgrade_data'] = $info;
							redirect(base_url("packages/upgrade_package_confirm/"));
                		} else {
                			$_SESSION['alert'] = array(
								"class" => "success",
								"content" => "[[MSG_SELECT_PACKAGE]]"
							);
							redirect(base_url("packages/upgrade_package/"));
							exit;
                		}
                	} else {
						$_SESSION['alert'] = array(
							"class" => "success",
							"content" => "[[MSG_SELECT_PACKAGE]]"
						);
						redirect(base_url("packages/upgrade_package/"));
						exit;
                	}
                }
            }
            $_SESSION['alert'] = array(
				"class" => "success",
				"content" => "[[MSG_INVALID_USER_ID]]"
			);
			redirect(base_url("packages/upgrade_package/"));
			exit;
        } else {
			userTemplate("pages/admins/upgrade_package", $data);
        }
	}

	public function upgrade_package_confirm()
    {
		//$data['title'] = "[[ADM_UPGRADE_PACKAGE]]";
		$req['access_token'] = $_SESSION['userSession'];
		$req['userid'] = $_SESSION['upgrade_data']['userid'];
		$member = post_curl("admin/members/getMemberInfoFromUserID", $req)['data'];

        if (!isset($member)) {
        	$this->redirect('admin_member/upgrade_package', 0);
        } else {
        	$data['user'] = $member;		
			$req['package_id'] = $member['package_id'];
	
        	$data['current_package'] = post_curl("admin/members/get_packages", $req)['data'];
			$req['package_id'] = $_SESSION['upgrade_data']['new_package'];
        	$data['new_package'] = post_curl("admin/members/get_packages", $req)['data'];

        	
			$data['new_package']['topup'] = $topup = ($data['new_package']['price'] + $data['new_package']['gst'] - $data['current_package']['price'] - $data['current_package']['gst']);
        	$data['payment_mode'] = $_SESSION['upgrade_data']['payment_mode'];
			
        	if ($data['payment_mode'] == "E-WALLET") {
				$getBal['access_token'] = $_SESSION['userSession'];
				$getBal['CASH_CREDIT'] = 'CASH_CREDIT';
				$getBal['member_id'] = $member['id'];

				$ewallet = post_curl("admin/members/getBalance", $getBal)['data'];
        		$data['ewallet_balance'] = $ewallet['available_balance'];
        		if ($data['ewallet_balance'] < $topup) {
					$_SESSION['alert'] = array(
						"class" => "success",
						"content" => "[[INSUFFICIENT_BALANCE]]"
					);
					redirect(base_url("packages/upgrade_package/"));
					exit;
        		}
        	}
			
        	if (isset($_POST['btnSave']) && ($data['payment_mode'] == "CASH" || ($data['payment_mode'] == "E-WALLET" && $data['ewallet_balance'] >= $topup))) {
	
        		$insert_time = date("Y-m-d H:i:s");
        		$period = date("Y-m");
				
        		if ($data['payment_mode'] == "E-WALLET") {
        			$desc = "[[UPGRADE]] TO ".$data['new_package']['name'];

					$newNumber['access_token'] = $_SESSION['userSession'];
        			$trans_no   = post_curl("admin/members/new_number", $newNumber)['data'];

        			//$this->member_ledger_model->newTransaction("CC", $member['id'], $period, "UPGRADE", $member['id'], $desc, $topup, 0, $insert_time, $trans_no, true, $member['userid']);
					$newTransaction['access_token'] = $_SESSION['userSession'];
		
					$newTransaction['member_id'] = $member['id'];
					$newTransaction['period'] = $period;
					$newTransaction['UPGRADE'] = $UPGRADE;
					$newTransaction['desc'] = $desc;
					$newTransaction['topup'] = $topup;
					$newTransaction['insert_time'] = $insert_time;
					$newTransaction['trans_no'] = $trans_no;
					$newTransaction['userid'] = $member['userid'];

					post_curl("admin/members/newTransaction", $newTransaction)['data'];
        		}
        		$update_data = array(
        				"special_account" => 0,
        				"package_id" => $data['new_package']['id'],
        				"main_package_id" => $data['new_package']['id'],
        				"last_update" => date('Y-m-d H:i:s'),
        		);
				
				$req['access_token'] = $_SESSION['userSession'];
				$req['id'] = $member['id'];
				$req['data'] = json_encode($update_data);
				
				post_curl("admin/members/updateMemberInfo", $req)['data'];

				$reqCumm['access_token'] = $_SESSION['userSession'];
				$reqCumm['id'] = $member['id'];
				$reqCumm['sponsorid'] = $member['sponsorid'];
				$reqCumm['userid'] = $member['userid'];
				$reqCumm['topup'] = $topup;
				$reqCumm['insert_time'] = $insert_time;
				$reqCumm['period'] = $period;

				post_curl("admin/members/calculateSponsorBonus", $reqCumm)['data'];
        		//$this->member_commission_model->calculateSponsorBonus($member['id'], $member['sponsorid'], $member['userid'], $topup, $insert_time, $period);
        		
				$reqCalculateBV['access_token'] = $_SESSION['userSession'];
				$reqCalculateBV['member_id'] = $member['id'];
				$reqCalculateBV['topup'] = $topup;
				$reqCalculateBV['date'] = date('Y-m-d');

				post_curl("admin/members/calculateBV", $reqCalculateBV)['data'];
				//$this->member_commission_model->calculateBV($member['id'], $topup, date('Y-m-d'));
	
				$reqnewSales['access_token'] = $_SESSION['userSession'];
				$reqnewSales['member_id'] = $member['id'];
				$reqnewSales['topup'] = $topup;
				$reqnewSales['period'] = $period;
				$reqnewSales['insert_time'] = $insert_time;

				post_curl("admin/members/newSales", $reqnewSales)['data'];
        		//$this->member_sales_model->newSales($member['id'], $topup, $period, $insert_time);
        	
        		//3)need to add to order master n order details (for DO will just top the difference)
				$saveUpgradePackage['access_token'] = $_SESSION['userSession'];
				$saveUpgradePackage['member_id'] = $member['id'];
				$saveUpgradePackage['current_package'] = $data['current_package']['id'];
				$saveUpgradePackage['new_package'] = $data['new_package']['id'];
				$saveUpgradePackage['upgrade_data'] = $_SESSION['upgrade_data']['payment_mode'];
				$saveUpgradePackage['PAID'] = 'PAID';

				post_curl("admin/members/saveUpgradePackageTransaction", $saveUpgradePackage)['data'];
        		//$this->saveUpgradePackageTransaction($member['id'], $data['current_package']['id'], $data['new_package']['id'], $_SESSION['upgrade_data']['payment_mode'], 'PAID');
        		//$data['msg']                     = $this->createMessage("success", '[[MSG_PACKAGE_UPGRADED]]');
        		$_SESSION['upgrade_data'] = null;

				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[MSG_PACKAGE_UPGRADED]]"
				);
				redirect(base_url("packages/upgrade_package/"));
        		//$this->redirect('admin_member/upgrade_package', 2);
        	} else if (isset($_POST['btnBack'])) {
        		redirect(base_url("packages/upgrade_package/"));
        	}
        	//$this->loadView('admin/upgrade_package_confirm', $data, 'admin');
			//echo "<pre>"; print_r($data); die;
			userTemplate("pages/admins/upgrade_package_confirm", $data);
        }
	}
	public function GetUpgradePackages()
    {
		$_id = $this->input->post('userid');
		$req['access_token'] = $_SESSION['userSession'];
		$data['prod'] = post_curl("admin/packages/get/$_id", $req)['data'];
    }
}
