<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_curl')) {
	function get_curl($uri)
	{
		$url = api_url($uri);
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($curl);
		curl_close($curl);
		return json_decode($data, true);
	}
}

if (!function_exists('tget_curl')) {
	function tget_curl($uri)
	{
		$url = api_url($uri);
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($curl);
		curl_close($curl);
		dd($data);
		return json_decode($data, true);
	}
}

if (!function_exists('post_curl')) {
	function post_curl($uri, $post)
	{
		$url = api_url($uri);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, "");
		header('Content-Type: text/html');
		$data = curl_exec($ch);
		return json_decode($data, true);
	}
}


function tpost_curl($uri, $post)
{
	$url = api_url($uri);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_ENCODING, "");
	header('Content-Type: text/html');
	$data = curl_exec($ch);
	dd($data);
	return json_decode($data, true);
}
