<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Review');
	}

	public function create()
	{
		$spot_id = $this->input->post('spot_id');
		$this->Review->create($this->input->post(), $spot_id, $this->session->userdata());
		$this->load->model('Comment');
		$this->load->model('Image');
		$this->load->model('Spot');
		$data['review_avg'] = $this->Review->average($this->uri->segment(3));
		$data['images'] = $this->Image->show_by_map_id($this->uri->segment(3));
		$data['comments'] = $this->Comment->show_by_map_id($this->uri->segment(3));
		$data['spot'] = $this->Spot->show($this->uri->segment(3));
		$this->load->view('partials/spot_html', $data);
	}
}