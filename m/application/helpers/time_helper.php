<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('getYear')) {
	function getYear()
	{
		return date("Y");
	}
}

if (!function_exists('getMonth')) {
	function getMonth()
	{
		return date("Y-m");
	}
}

if (!function_exists('getDate')) {
	function getDate()
	{
		return date("Y-m-d");
	}
}

if (!function_exists('getFullDate')) {
	function getFullDate()
	{
		return date("Y-m-d H:i:s");
	}
}

if (!function_exists('calcMonth')) {
	function calcMonth($format, $interval, $month)
	{
		return date($format, strtotime($interval . " month", strtotime($month)));
	}
}

if (!function_exists('formatDate')) {
	function formatDate($date, $time = true)
	{
		$format = $time ? 'd M Y H:i' : 'd M Y';
		$new = date($format, strtotime($date));
		return "<span class='date_display'>$new</span>";
	}
}
