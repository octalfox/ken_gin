<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('ci')) {
	function ci()
	{
		$CI =& get_instance();
		return $CI;
	}
}

if (!function_exists('api_url')) {
	function api_url($uri = '')
	{
		return API_URL . $uri;
	}
}

if (!function_exists('assets_url')) {
	function assets_url($uri = '')
	{
		return ASSETS_URL . $uri;
	}
}

if (!function_exists('dd')) {
	function dd($arr)
	{
		echo "<pre>";
		print_r($arr);
		exit;
	}
}

if (!function_exists('ddv')) {
	function ddv($arr)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}


