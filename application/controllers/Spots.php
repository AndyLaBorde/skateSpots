<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spots extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Spot');
	}
	function index()
	{
		$this->load->model('Map');
		$data['maps'] = $this->Map->show();
		$this->load->view('index', $data);
	}
	function create()
	{
		$this->load->model('Map');
		$this->load->model('Review');
		$this->Map->create($this->input->post());
		$this->Spot->create($this->input->post());
		$data = $this->Spot->show_all_spots();
		$this->Review->create($this->input->post(), $data['id'], $this->session->userdata());
	}
	function search()
	{
		$data['spots'] = $this->Spot->search($this->input->post());
		echo json_encode($data);
	}
	function show()
	{
		$this->load->model('Comment');
		$this->load->model('Image');
		$this->load->model('Review');
		$data['review_avg'] = $this->Review->average($this->uri->segment(3));
		$data['images'] = $this->Image->show_by_map_id($this->uri->segment(3));
		$data['comments'] = $this->Comment->show_by_map_id($this->uri->segment(3));
		$data['spot'] = $this->Spot->show($this->uri->segment(3));
		$this->load->view('partials/spot_html', $data);
	}
	function show_map()
	{
		$this->load->model('Map');
		$data['maps'] = $this->Map->show();
		$this->load->view('partials/map.php', $data);
	}
}