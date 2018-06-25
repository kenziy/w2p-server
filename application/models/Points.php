<?php

class Points extends CI_Model {

	public function setPoints($arr) {
		date_default_timezone_set('Asia/Manila');
		$this->db->select('points');
		$this->db->where('id', $arr['user_id']);
		$get_user_points = $this->db->get('users')->row();
		$points = $get_user_points->points + 1;
		$this->db->where('id', $arr['user_id']);
		$this->db->update('users', array('points' => $points, 'points_update' => date('Y-m-d H:i:s')));
		return $this->db->insert('points', $arr);
	}

	public function redeem($arr) {
		return $this->db->insert('redeem', $arr);
	}

	public function transaction($id) {
		$this->db->limit(20);
		$this->db->order_by('id', 'DESC');
		$this->db->where('user_id', $id);
		return $this->db->get('redeem')->result();
	}

	// admin
	public function showAll($stat) {
		$this->db->where('status', $stat);
		return $this->db->get('redeem')->result();
	}
}