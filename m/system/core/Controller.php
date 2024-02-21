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
		log_message('info', 'Controller Class Initialized');
		$_SESSION['available_tags'] = get_curl("language/get/" . $_SESSION['language'])['data']['lang'];
		$_SESSION['constants'] = get_curl("language/get/" . $_SESSION['language'])['data']['system'];

		$method = $this->router->fetch_class();
      	
//      	if(!in_array($method, array('ranks', 'home', 'network','settings','reset','reports','logout'))  and !in_array($method, PUBLIC_ROUTES)){
//          	redirect(base_url());
//        }
      
      	
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
					redirect(base_url("home"));
					exit;
				}
			}
			if (!isset($_SESSION['userSession']) and !in_array($method, PUBLIC_ROUTES)) {
				redirect(base_url("login"));
				exit;
			}
		}
		if (isset($_SESSION['logged']['id'])) {
			if ($_SESSION['logged']['secondary_salt'] == "") {
				if (count($_POST) > 0) {
					$req = $_POST;
					$req['language'] = $_SESSION['language'];
					$req['access_token'] = $_SESSION['userSession'];
					$response = post_curl("password/update", $req);
					$req['access_token'] = $_SESSION['userSession'];
					if ($response['response'] == "success") {
						$response = post_curl("user/get/" . $_SESSION['logged']['userid'], $req);
						if ($response['response'] == "success") {
							$_SESSION['notify_message'] = notify(
								"bg-success",
								"[[LABEL_PASSWORD_UPDATED]]",
								"[[LABEL_PASSWORD_SUBTITLE]]",
								"[[LABEL_PASSWORD_SUMMARy]]"
							);
							$userid = $_SESSION['logged']['userid'];
							unset($_SESSION['logged']);
							unset($_SESSION['userSession']);
							redirect(base_url("login"));
							exit;
						}
					}
					$_SESSION['notify_message'] = notify(
						$response['data']['notify_bg'],
						$response['data']['notify_title'],
						$response['data']['notify_subtitle'],
						$response['data']['notify_summary']
					);
				}
				$data['title'] = "[[LABEL_FIRSTTIME_LOGIN]]";
				userTemplate("member/first_time_login", $data);
				exit;
			}
		}
	}

	public static function &get_instance()
	{
		return self::$instance;
	}

}
