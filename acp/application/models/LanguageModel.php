<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LanguageModel extends CI_Model
{
	public function index()
	{
		$data = array();

		publicTemplate("guest/login", $data);
	}
}
