<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('send_code')) {
	function send_code($member) {
		$number = sms_number($member['mobile']);
		$message_type = "Reset Security Password OTP";
		$verification_code = rand(100000, 999999);
		$message = $message_type . ': ' . $verification_code;
		sms($number, $message);
		return $verification_code;
	}
}

if (!function_exists('send_guest_code')) {
	function send_guest_code($member) {
		$number = sms_number($member['mobile']);
		$message_type = "Reset Login Password OTP";
		$verification_code = rand(100000, 999999);
		$message = $message_type . ': ' . $verification_code;
		sms($number, $message);
		return $verification_code;
	}
}

if (!function_exists('sms_number')) {
	function sms_number($mobile) {
		return ltrim("65" . $mobile, '+');
	}
}

if (!function_exists('sms')) {
	function sms($number, $message) {
		$system = ci()->SystemModel->getConstants();
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_USERPWD => $system['SMS_BRUST'],
			CURLOPT_URL => 'https://api.transmitsms.com/send-sms.xml',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => 'message=' . $message . '&from=6583184431&to=' . $number,
		));
		$response = curl_exec($curl);
		curl_close($curl);

	}
}
