<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	public function aksiDaftar()
	{
		$data = [
				'nama' => $this->input->post('nama', true),
				'username' => $this->input->post('username', true),
				'alamat' => $this->input->post('alamat', true),
				'kelamin' => $this->input->post('jk', true),
				'telepon' => $this->input->post('telepon', true),
				'no_ktp' => $this->input->post('ktp', true),
				'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
				'role_id' => '2'
		];

		$this->db->insert('customer', $data);
	}



}