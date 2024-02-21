<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('publicTemplate')) {
	function publicTemplate($view, $data)
	{
		loadTemplate($view, $data, "public");
	}
}
if (!function_exists('userTemplate')) {
	function userTemplate($view, $data)
	{
		loadTemplate($view, $data, "user");
	}
}
if (!function_exists('generalTemplate')) {
	function generalTemplate($view, $data)
	{
		loadTemplate($view, $data, "general");
	}
}
if (!function_exists('loadTemplate')) {
	function loadTemplate($view, $data, $template)
	{
		$CI = ci();
		$data['view'] = $CI->load->view($view, $data, true);
		$v = $CI->load->view("templates/" . $template, $data, true);
		$languages = $_SESSION['available_tags'];
		foreach($languages as $language)
		{
			$v = str_replace($language['template'], $language[$_SESSION['language']], $v);
		}
		echo $v;
		exit;
	}
}
if (!function_exists('notify')) {
	function notify($class, $title, $subtitle, $summary)
	{
		return array(
			"notify_bg" => $class,
			"notify_title" => $title,
			"notify_time" => getFullDate(),
			"notify_subtitle" => $subtitle,
			"notify_summary" => $summary
		);
	}
}
