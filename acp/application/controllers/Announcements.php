<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Announcements extends CI_Controller
{
	public function index()
	{
		$data = array();
		$req['access_token'] = $_SESSION['userSession'];
		$response = post_curl("admin/announcements/all", $req);
		$data['list'] = $response['data'];
		userTemplate("pages/announcements/list", $data);
	}

	public function add()
	{
		if (isset($_POST['title'])) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/announcements/add", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_NEWS_ADDED]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_NEWS_FAILED]]"
				);
			}
			redirect(base_url("announcements"));
			exit;
		}
		userTemplate("pages/announcements/add", array());
	}

	public function edit($id)
	{
		if (isset($_POST['title'])) {
			$req = $_POST;
			$req['access_token'] = $_SESSION['userSession'];
			$response = post_curl("admin/announcements/add", $req);
			if ($response['response'] == "success") {
				$_SESSION['alert'] = array(
					"class" => "success",
					"content" => "[[LABEL_NEWS_ADDED]]"
				);
			} else {
				$_SESSION['alert'] = array(
					"class" => "danger",
					"content" => "[[LABEL_NEWS_FAILED]]"
				);
			}
			redirect(base_url("announcements"));
			exit;
		}
		$req['access_token'] = $_SESSION['userSession'];
		$data['news'] = post_curl("admin/announcements/get/$id", $req)['data'];
		userTemplate("pages/announcements/edit", $data);
	}

	public function delete($id)
	{
		$req = $_POST;
		$req['access_token'] = $_SESSION['userSession'];
		$req['id_to_delete'] = $id;
		$response = post_curl("admin/announcements/delete", $req);
		if ($response['response'] == "success") {
			$_SESSION['alert'] = array(
				"class" => "success",
				"content" => "[[LABEL_NEWS_DELETE]]"
			);
		} else {
			$_SESSION['alert'] = array(
				"class" => "danger",
				"content" => "[[LABEL_NEWS_FAILED]]"
			);
		}
		redirect(base_url("announcements"));
		exit;
	}
}
