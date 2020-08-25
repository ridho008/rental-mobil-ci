<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {
	public function getCustomerById($id)
	{
		return $this->db->get_where('customer', ['id_customer' => $id])->row_array();
	}

	public function aksiTambahCustomer()
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

	public function aksiEditCustomer()
	{
		$id = $this->input->post('id', true);
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

		$this->db->where('id_customer', $id);
		$this->db->update('customer', $data);
	}

	public function getCustomer($limit, $start, $keyword)
	{
		if($keyword)
		{
			$this->db->like('nama', $keyword);
			$this->db->or_like('username', $keyword);
			$this->db->or_like('telepon', $keyword);
			$this->db->or_like('no_ktp', $keyword);
		}
		return $this->db->get('customer', $limit, $start)->result_array();
	}

	public function countCustomer()
	{
		return $this->db->get('customer')->num_rows();
	}

}