<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Currencies extends CI_Controller
{
	public function all()
	{
		$list = $this->CurrencyModel->getAll();
		return successReponse("", $list);
	}

	public function add()
	{
		$list = $this->CurrencyModel->update($_POST);
		return successReponse("", $list);
	}
}

