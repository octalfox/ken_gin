<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CI_Controller
{
	private static $instance;
	public $load;

	public function __construct()
	{
		self::$instance =& $this;

		if (!isset($_SESSION)) {
			session_start();
		}

		if (!isset($_SESSION['language'])) {
			$_SESSION['language'] = "en";
		}

		foreach (is_loaded() as $var => $class) {
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();

		$starter = get_curl("language/get/" . $_SESSION['language']);
		log_message('info', 'Controller Class Initialized');
		$_SESSION['available_tags'] = $starter['data']['lang'];
		$_SESSION['constants'] = $starter['data']['system'];


		$method = $this->router->fetch_class();
		if ($method != 'language') {
			if (isset($_SESSION['userSession'])) {
				if (isset($_SESSION['user_last_visted'])) {
					if (time() - $_SESSION['user_last_visted'] > (60 * SESSION_DURATION)) {
						unset($_SESSION);
						session_destroy();
						redirect(base_url("login"));
						exit;
					}
				}
				$_SESSION['user_last_visted'] = time();
			}
			if (isset($_SESSION['userSession']) and in_array($method, PUBLIC_ROUTES)) {
				$this->load->model("MemberModel");
				$user = $this->MemberModel->getLoggedInUser();
				if ($user) {
					redirect(base_url());
					exit;
				}
			}
			if (!isset($_SESSION['userSession']) and !in_array($method, PUBLIC_ROUTES)) {
				redirect(base_url("login"));
				exit;
			}
		}
		if(isset($_SESSION['logged'])){
			$req['access_token'] = isset($_SESSION['userSession']) ? $_SESSION['userSession'] : "";
			$_SESSION['menus'] = post_curl("admin/menu/get", $req)['data'];
		}

	}

	public static function &get_instance()
	{
		return self::$instance;
	}

}
