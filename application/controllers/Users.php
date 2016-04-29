<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('User');
	}

	public function index_html()
	{
		$this->load->view('partials/register_form');
	}
	function login_html()
	{
		$this->load->view('partials/login_html');
	}
	function create()
	{
		if($this->User->create($this->input->post()) === FALSE)
		{
			
			$this->load->view('partials/register_form');
		}
		else
		{
			$this->load->view('partials/login_html');
		}
	}
	function update_html()
	{
		$data['users'] = $this->User->show_by_id($this->session->userdata());
		$this->load->view('partials/profile', $data);
	}
	function update_profile()
	{
		if($this->User->update_profile($this->input->post(), $this->session->userdata()) === FALSE)
		{
			$data['users'] = $this->User->show_by_id($this->session->userdata());
			$this->load->view('partials/profile.php', $data);
		}
		else
		{
			$this->load->view('partials/blank');
		}
	}
	function update_password()
	{
		if($this->User->update_password($this->input->post(), $this->session->userdata()) === FALSE)
		{
			$data['users'] = $this->User->show_by_id($this->session->userdata());
			$this->load->view('partials/profile.php', $data);
		}
		else
		{
			$this->load->view('partials/blank');
		}
	}
	function close_profile()
	{
		$this->load->view('partials/blank');
	}
}