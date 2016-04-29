<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Map');
	}

	function create()
	{
		$this->Map->create($this->input->post());
		redirect("/");
	}

} 