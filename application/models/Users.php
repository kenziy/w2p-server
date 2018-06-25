<?php

class Users extends CI_Model {

	public function login($username, $password) {
		$return = array('success' => false);
		$this->db->where('username', $username);
		$getUser = $this->db->get('users')->row();
		if(!is_null($getUser)) {
			if(password_verify($password, $getUser->password)) {
				$return = array('success' => true, 'data' => $getUser);
			}
		}
		return $return;
	}

	public function save($arr) {
		$arr['password'] = password_hash($arr['password'], 1);
		return $this->db->insert('users', $arr);
	}

	public function update($id, $data) {
		if(isset($data['password'])) {
			$data['password'] = password_hash($data['password'], 1);
		}
		$this->db->where('id', $id);
		return $this->db->update('users', $data);
	}

}