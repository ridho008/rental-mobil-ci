<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_Artikel_model extends CI_Model {
	public function aksiTambahKategori()
	{
		$data = [
			'nama_kategori' => $this->input->post('kategori', true)
		];

		$this->db->insert('kategori', $data);
	}

	public function aksiUbahKategori($data)
	{
		$id_kategori = $data['id_kategori'];
		$data = [
			'nama_kategori' => $data['kategori']
		];

		$this->db->where('id_kategori', $id_kategori);
		$this->db->set($data);
		$this->db->update('kategori');
	}

	public function getUbahKategori($id)
	{
		return $this->db->get_where('kategori', ['id_kategori' => $id])->row_array();
	}

	public function getAllKategori($limit, $start, $keyword = null)
	{
		if($keyword) {
			$this->db->like('nama_kategori', $keyword);
		}
		$this->db->order_by('id_kategori', 'DESC');
		return $this->db->get('kategori', $limit, $start)->result_array();
	}

	public function countAllKategori()
	{
		return $this->db->get('kategori')->num_rows();
	}

}