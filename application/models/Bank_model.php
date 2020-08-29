<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_model extends CI_Model {
	public function getAllBank($limit, $start, $keyword) 
	{
		if($keyword) {
			$this->db->like('nama_rek', $keyword);
			$this->db->or_like('no_rek', $keyword);
		}
		return $this->db->get('bank', $limit, $start)->result_array();
	}

	public function countAllBank()
	{
		return $this->db->get('bank')->num_rows();
	}

	public function tambahBank()
	{
		$data = [
				'no_rek' => $this->input->post('no'),
				'nama_rek' => $this->input->post('nama')
		];

		$this->db->insert('bank', $data);
	}

	public function getBankById($id)
	{
		return $this->db->get_where('bank', ['id_bank' => $id])->row_array();
	}

	public function aksiUbahBank($data)
	{
		$id_bank = $data['id_bank'];
		$arr = [
				'no_rek' => $data['no'],
				'nama_rek' => $data['nama']
		];
		// var_dump($data); die;
		$this->db->set($arr);
		$this->db->where('id_bank', $id_bank);
		$this->db->update('bank');
	}

}