<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Language extends CI_Controller
{
	public function change($lang)
	{
		$_SESSION['language'] = $lang;
		redirect($_SERVER['HTTP_REFERER']);
	}
}
