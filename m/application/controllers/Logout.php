<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
	public function index()
	{
		unset($_SESSION);
		session_destroy();
		redirect(base_url("login"));
		exit;
	}
}
