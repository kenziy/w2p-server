<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('Users', 'Admin', 'Points'));
		$this->load->library('form_validation');
	}

	public function login_form() {
		$this->load->view('login_form', array('error' => ''));
	}

	public function login() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$error = '';
		if ($this->form_validation->run()) {
			if($this->Admin->login($this->input->post('username'), $this->input->post('password'))) {
				return redirect('admin/dashboard');
			} else {
				$error = "Invalid username or password";
			}
		}
		$this->load->view('login_form', array('error' => $error));
	}

	public function logout() {
		$this->session->sess_destroy();
		return redirect('admin/login');
	}

	public function dashboard() {
		$this->load->view('dashboard', array(
			'all' => $this->Points->showAll(0)
		));
	}

	public function approve() {
		
	}
}