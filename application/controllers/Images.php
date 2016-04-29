<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Images extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Image');
		$this->load->helper('form');
	}
	function do_upload()
	{
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = '4096';
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$config['remove_spaces'] = TRUE;
		$config['overwrite'] = FALSE;
		$userfile = 'userfile';
		$this->load->library('upload', $config);

		// var_dump($this->upload->do_upload());
		// die();

		if(!$this->upload->do_upload())
		{
			$error = array('image' => $this->upload->display_errors());
			$this->session->set_flashdata($error);
		}
		else
		{
			$image = $this->upload->data();
			$this->Image->upload($image, $this->input->post(), $this->session->userdata());
		}
		$this->load->model('Comment');
		$this->load->model('Spot');
		$this->load->model('Review');
		$data['review_avg'] = $this->Review->average($this->uri->segment(3));
		$data['images'] = $this->Image->show_by_map_id($this->uri->segment(3));
		$data['comments'] = $this->Comment->show_by_map_id($this->uri->segment(3));
		$data['spot'] = $this->Spot->show($this->uri->segment(3));
		$this->load->view('partials/spot_html', $data);
	}

}