<?php

class Admin extends CI_Model {

	public function login($username, $password) {
		$return = false;
		$this->db->where('username', $username);
		$getUser = $this->db->get('admin')->row();
		if(!is_null($getUser)) {
			if(password_verify($password, $getUser->password)) {
				$this->session->set_userdata('admin', $getUser);
				$return = true;
			}
		}
		return $return;
	}
}