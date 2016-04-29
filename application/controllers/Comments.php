<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Comment');
	}
	function create()
	{
		$this->Comment->create($this->input->post(), $this->session->userdata());
		redirect("/Spots/show/" . $this->uri->segment(3));
	}
}
