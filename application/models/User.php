<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|alpha|max_length[48]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha|max_length[48]');
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_dash|is_unique[users.username]|max_length[48]');
		$this->form_validation->set_rules('email', 'E-mail', 'required|is_unique[users.email]|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('password_conf', 'Confirm Password', 'required|matches[password]');
	}

	function create($post)
	{	
		$this->form_validate();
		if($this->form_validation->run() == FALSE)
		{
			$errors = array('first_name' => form_error('first_name'),
							'last_name' => form_error('last_name'),
							'username' => form_error('username'),
							'email' => form_error('email'),
							'password' => form_error('password'),
							'password_conf' => form_error('password_conf')
							);
			$this->session->set_flashdata($errors);
			return false;
		}
		else
		{
			$query = "INSERT into users (first_name, last_name, username, email, password, user_level, created_at, updated_at) VALUES (?,?,?,?,?,'user',NOW(),NOW())";
			$values = array(htmlspecialchars($post['first_name']), htmlspecialchars($post['last_name']), htmlspecialchars($post['username']), htmlspecialchars($post['email']), password_hash($post['password'], PASSWORD_DEFAULT));
			$this->db->query($query, $values);
			$this->session->set_flashdata('registration_confirmed', '<p class="success">Registration confirmed.  You may now log in</p>');
		}
	}
	function show_by_email($post)
	{
		return $this->db->query("SELECT * from users where email = ?", array(htmlspecialchars($post['email'])))->row_array();
	}
	function show_by_id($session)
	{
		return $this->db->query("SELECT * FROM users where id = ?", array($session['user_id']))->row_array();
	}
	function update_profile($post, $session)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|alpha|max_length[48]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha|max_length[48]');
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_dash|max_length[48]');
		$username_check = $this->db->query("SELECT * FROM users WHERE username = ?", array($post['username']))->row_array();
		$email_check = $this->db->query("SELECT * FROM users where email = ?", array($post['email']))->row_array();
		if($this->form_validation->run() === FALSE)
		{
			$errors = array('first_name' => form_error('first_name'),
							'last_name' => form_error('last_name'),
							'username' => form_error('username'),
							'email' => form_error('email')
							);
			$this->session->set_flashdata($errors);
			return false;
		}
		else if($email_check['id'] != $session['user_id'])
		{
			$this->session->set_flashdata('email', '<p style="color: red;">A user has already registered with that e-mail address.</p>');
			return false;
		}
		else if($username_check['id'] != $session['user_id'])
		{
			$this->session->set_flashdata('username', '<p style="color: red;">A user has already registered with that username.</p>');
			return false;
		}
		else
		{
			$query = "UPDATE users set first_name = ?, last_name = ?, username = ?, email = ? WHERE id = ?";
			$values = array(htmlspecialchars($post['first_name']), htmlspecialchars($post['last_name']), htmlspecialchars($post['username']), htmlspecialchars($post['email']), $session['user_id']);
			$this->db->query($query, $values);
			$user_info = array('first_name' => $post['first_name'],
								'last_name' => $post['last_name'],
								'username' => $post['username'],
								'email' => $post['email']
								);
			$this->session->set_userdata($user_info);
		}
	}
	function update_password($post, $session)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('password_conf', 'Confirm Password', 'required|matches[password]');
		if($this->form_validation->run() === FALSE)
		{
			$errors = array('password' => form_error('password'),
							'password_conf' => form_error('password_conf')
							);
			$this->session->set_flashdata($errors);
			return false;
		}
		else
		{
			$query = "UPDATE users SET password = ? WHERE id = ?";
			$values = array(password_hash($post['password'], PASSWORD_DEFAULT), $session['user_id']);
			$this->db->query($query, $values);
		}
	}
}