<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PointsController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Users');
		$this->load->model('Points');
	}

	public function add() {
		$return = array();
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run()) {
			$user = $this->Users->login($this->input->post('username'), $this->input->post('password'));
			if($user['success']) {
				// add points
				$points = array(
					'user_id' => $user['data']->id
				);
				if($this->Points->setPoints($points)) {
					$return = array('success' => true);
				}

			} else {
				$return = array('success' => false, 'msg' => 'invalid request');
			}
		}

		echo json_encode($return);
	}

	public function redeem() {
		$return = array();
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run()) {
			$user = $this->Users->login($this->input->post('username'), $this->input->post('password'));
			if($user['success']) {
				// add points
				$raw = $this->input->post();
				unset($raw['username']);
				unset($raw['password']);

				$request = array(
					'user_id' 	  => $user['data']->id,
					'tracking_id' => 'N-'.rand(0000, 9999),
					'points'  	  => 10,
					'request' 	  => json_encode($raw)
				);

				if($this->Points->redeem($request)) {
					$return = array('success' => true);
				}

			} else {
				$return = array('success' => false, 'msg' => 'invalid request');
			}
		}

		echo json_encode($return);
	}
}