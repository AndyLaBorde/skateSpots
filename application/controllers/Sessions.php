<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Session');
	}
	function index()
	{
		if($this->session->userdata('is_logged_in') === TRUE)
		{
			redirect("/Spots/index");
		}
		else
		{
			$this->load->view('login');
		}
	}
	function create()
	{
		$this->Session->create($this->input->post());
		if($this->session->flashdata('error'))
		{
			redirect("/");
		}
		else
		{
			redirect("/Spots/index");
		}
	}
	function destroy()
	{
		$this->session->sess_destroy();
		redirect("/");
	}
	function facebook()
	{
		$fb = new Facebook\Facebook([/* . . . */]);

		$helper = $fb->getRedirectLoginHelper();
		try {
		  $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		if (isset($accessToken)) {
		  // Logged in!
		  $this->session->set_userdata('FB_id',(string) $accessToken);
		  redirect("/");
		}
	}
}
