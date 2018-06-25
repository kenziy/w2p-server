<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Points');
	}

	public function index()	{
		show_404();
	}

	public function dashboard() {

		$this->load->view('welcome_message', array(
			'all' => $this->Points->showAll(0)
		));
	}
}
