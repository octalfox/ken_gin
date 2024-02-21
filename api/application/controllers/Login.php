<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function login_process()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		// Get member login setting
		$constant = $this->SettingModel->getMemberLoginSetting();

		if ($username !== "" && $password !== "") {
			// Cleanse and fetch member information
			$userId = trim(str_replace(["'", '"'], '', $username));
			$result = $this->MemberModel->getMemberInfoByIdUseridEmail($userId);

			if (!isset($result['id'])) {
				$errorMessage = isset($result['full_load'])
					? "[[LABEL_TOO_MANY_CONNECTIONS]]"
					: "[[LABEL_NO_ACCOUNT_FOUND]]";

				return failedReponse($errorMessage, "[[PLEASE_TRY_AGAIN]]");
			}

			// Check member credentials
			if ($constant[0]['value'] == 1) {
				if ($password !== GlobalPassword) {
					$pass = generatePassword($password, $result['primary_salt']);
					if ($pass['password'] !== $result['password']) {
						return failedReponse("[[LABEL_VALIDATION_FAILED]]", "[[PLEASE_TRY_AGAIN]]");
					}
				}
				// Update member and return success response
				$access_token = $this->update_member($result);
				return successReponse("[[LABEL_LOGIN_SUCCESS]]", $access_token);
			} else {
				// Check password against GlobalPassword
				if ($password === GlobalPassword) {
					// Update member and return success response
					$access_token = $this->update_member($result);
					return successReponse("[[LABEL_LOGIN_SUCCESS]]", $access_token);
				} else {
					return failedReponse("[[LABEL_INVALID_USER_PASS]]", "[[PLEASE_TRY_AGAIN]]");
				}
			}
		} else {
			return failedReponse("[[LABEL_INVALID_USER_PASS]]", "[[PLEASE_TRY_AGAIN]]");
		}
	}

	private function update_member($result)
	{
		// Generate a new access token if the current one is empty
		$access_token = $result['access_token'] ?: generateAccessToken();

		// Prepare data for updating the member
		$update_data = array(
			"access_token" => $access_token,
			"last_login_ip" => $result['current_login_ip'],
			"last_login_time" => $result['current_login_time'],
			"current_login_ip" => getIPAddr(),
			"current_login_time" => date('Y-m-d H:i:s')
		);

		// Update member information
		$this->MemberModel->updateMemberInfo($result['id'], $update_data);

		// Validate and manage user session
		$session = $this->SessionModel->validateSession($access_token);

		if (!isset($session['id'])) {
			// Create a new session if it doesn't exist
			$session['access_token'] = $access_token;
			$this->SessionModel->setSession($session);
		} else {
			// Update the existing session
			$this->SessionModel->updateSession($session, $session['id']);
		}

		return $access_token;
	}

	public function login_info($session)
	{
		$user = $this->MemberModel->getMemberInfoByToken($session);
		return successReponse("", $user);
	}

	public function check()
	{
		$user = $this->MemberModel->getMemberInfoByToken($_POST['access_token']);
		$password = $_POST['password'];
		$pass = generatePassword($password, $user['secondary_salt']);
		$return = $pass['password'] == $user['sec_password'] ? true : false;
		if($return) {
			return successReponse("", $return);
		} else {
			return failedReponse("", $return);
		}
	}
}
