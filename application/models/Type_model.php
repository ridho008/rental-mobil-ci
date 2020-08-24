<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_model extends CI_Model {
	public function getAllType()
	{
		return $this->db->get('type')->result_array();
	}

	public function getTypeById($id)
	{
		return $this->db->get_where('type', ['id_type' => $id])->row_array();
	}

	public function aksiTypeTambah()
	{
		$data = [
				'kode_type' => $this->input->post('kode_type'),
				'nama_type' => $this->input->post('nama_type')
		];

		$this->db->insert('type', $data);
	}

	public function aksiTypeEdit()
	{
		$id = $this->input->post('id');
		$data = [
				'kode_type' => $this->input->post('kode_type'),
				'nama_type' => $this->input->post('nama_type')
		];

		$this->db->where('id_type', $id);
		$this->db->update('type', $data);
	}

	public function getAllTypeLimit($limit, $start, $keyword = null)
	{
		if($keyword) {
			$this->db->like('nama_type', $keyword);
		}
		return $this->db->get('type', $limit, $start)->result_array();
	}

	public function countAllType()
	{
		return $this->db->get('type')->num_rows();
	}

}