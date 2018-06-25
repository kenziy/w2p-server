<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Users');
		$this->load->model('Points');
	}

	public function register() {
		$return = array();
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]');

		if ($this->form_validation->run()) {
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email'),
				'name' => $this->input->post('name'),
				'contact' => $this->input->post('contact')
			);
			if($this->Users->save($data)) {
				$return = array('success' => true);
			}
		} else {
			$return = array('success' => false, 'msg' => validation_errors('<li>- ', '</li>'));
		}

		echo json_encode($return);
	}

	public function update() {
		$return = array();
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('contact', 'Contact', 'required');

		if($this->input->post('newPassword') != "") {
			$this->form_validation->set_rules('newPassword', 'New Password', 'required');
			$this->form_validation->set_rules('oldPassword', 'Old Password', 'required');
		}

		if ($this->form_validation->run()) {
			$user = $this->Users->login($this->input->post('username'), $this->input->post('password'));
			if($user['success']) {
				$data = array(
					'email' => $this->input->post('email'),
					'name' => $this->input->post('name'),
					'contact' => $this->input->post('contact'),
				);
				// changing password
				if($this->input->post('newPassword') != "") {
					if($this->Users->login($user['data']->username, $this->input->post('oldPassword'))['success']) {
						$data['password'] = $this->input->post('password');
					} else {
						echo json_encode(array('success' => false, 'msg' => '<li>Old password doesn\'t match</li>'));
						die();
					}
				}

				if($this->Users->update($user['data']->id, $data)) {
					$return = array('success' => true);
				}
			} else {
				$return = array('success' => false, 'msg' => 'Auth not found');
			}
		} else {
			$return = array('success' => false, 'msg' => validation_errors('<li>- ', '</li>'));
		}
		echo json_encode($return);
	}

	public function login() {
		$return = array();
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run()) {
			if($this->Users->login($this->input->post('username'), $this->input->post('password'))['success']) {
				$return = array('success' => true);
			} else {
				$return = array('success' => false, 'msg' => 'Incorrect username or password');
			}

		} else {
			$return = array('success' => false, 'msg' => validation_errors('<li>- ', '</li>'));
		}
		echo json_encode($return);
	}

	public function checkuser($user, $pass) {
		$return = array('success' => false);
		$user = $this->Users->login($user, $pass);
		if($user['success']) {
			$toReturn = array(
				'id' 	   	 => $user['data']->id,
				'username' 	 => $user['data']->username,
				'email' 	 => $user['data']->email,
				'name'	   	 => $user['data']->name,
				'contact'  	 => $user['data']->contact,
				'video_time' => date('Y-m-d H:i:s', strtotime($user['data']->points_update. "+15 minutes")),
				'points'   	 => $user['data']->points
			);

			$return = array('success' => true, 'data' => $toReturn);
		}
		echo json_encode($return);
	}

	public function transaction($user, $pass) {
		$return = array('success' => false);
		$user = $this->Users->login($user, $pass);
		if($user['success']) {
			$toReturn = array();
			foreach($this->Points->transaction($user['data']->id) as $t) {
				$request = json_decode($t->request);
				$toReturn[] = array(
					'ref' 		  => $t->tracking_id,
					'description' => $request->redeem,
					'date' 	  	  => $t->date_created,
					'comment' 	  => $t->summary,
					'status' 	  => intval($t->status),
				);
			}

			$return = array('success' => true, 'data' => $toReturn);
		}
		echo json_encode($return);
	}
}
