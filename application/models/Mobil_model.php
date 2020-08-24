<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil_model extends CI_Model {
	public function getAllMobil()
	{
		// return $this->db->get('mobil')->result_array();
		$this->db->select('*');
		$this->db->from('type');
		$this->db->join('mobil', 'mobil.kode_type = type.id_type');
		return $this->db->get()->result_array();
	}

	public function getMobilById($id)
	{
		// $this->db->select('*');
		// $this->db->from('mobil');
		// $this->db->join('type', 'type.id_type = mobil.kode_type');
		// return $this->db->get_where()->row_array();
		return $this->db->get_where('mobil', ['id_mobil' => $id])->row_array();
	}

	public function getMobilTypeJoin($id)
	{
		$this->db->select('*');
		$this->db->from('mobil');
		$this->db->join('type', 'type.id_type = mobil.kode_type');
		$this->db->where('id_mobil', $id);
		return $this->db->get_where()->row_array();
	}

	public function aksi_tambah()
	{
		$gambar = $_FILES['gambar']['name'];
		if($gambar) {
			$config['allowed_types'] = 'gif|png|jpg';
			$config['max_sizes'] = '2048';
			$config['upload_path'] = './assets/assets_stisla/img/mobil/';

			// $gambarError = $_FILES['gambar']['error'];
			// if($gambarError == 4) {
			// 	return "default.png";
			// }

			$this->load->library('upload', $config);

			if($this->upload->do_upload('gambar')) {
				$this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = [
				'kode_type' => $this->input->post('type'),
				'merk' => $this->input->post('merk'),
				'no_plat' => $this->input->post('no_plat'),
				'warna' => $this->input->post('warna'),
				'tahun' => $this->input->post('tahun'),
				'status' => $this->input->post('status'),	
				'harga_mobil' => $this->input->post('harga'),	
				'denda' => $this->input->post('denda'),	
				'ac' => $this->input->post('ac'),	
				'supir' => $this->input->post('supir'),	
				'mp3_player' => $this->input->post('mp3'),	
				'central_lock' => $this->input->post('lock'),	
				'gambar' => $gambar
		];

		$this->db->insert('mobil', $data);
	}

	public function aksi_edit()
	{
		$gambar = $_FILES['gambar']['name'];

		if($gambar) {
			$config['allowed_types'] = 'gif|png|jpg';
			$config['max_sizes'] = '2048';
			$config['upload_path'] = './assets/assets_stisla/img/mobil/';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('gambar')) {
				$gambarLama = $this->input->post('gambarLama');
				if($gambarLama != 'default.png') {
					unlink(FCPATH . 'assets/assets_stisla/img/mobil/' . $gambarLama);
				}

				$gambarBaru = $this->upload->data('file_name');
				$this->db->set('gambar', $gambarBaru);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$id = $this->input->post('id_mobil');
		$data = [
			'kode_type' => $this->input->post('type'),
			'merk' => $this->input->post('merk'),
			'no_plat' => $this->input->post('no_plat'),
			'warna' => $this->input->post('warna'),
			'tahun' => $this->input->post('tahun'),
			'status' => $this->input->post('status'),
			'harga_mobil' => $this->input->post('harga'),	
			'denda' => $this->input->post('denda'),	
			'ac' => $this->input->post('ac'),	
			'supir' => $this->input->post('supir'),	
			'mp3_player' => $this->input->post('mp3'),	
			'central_lock' => $this->input->post('lock')
		];

		$this->db->where('id_mobil', $id);
		$this->db->set($data);
		$this->db->update('mobil');
	}

	public function getMobil($limit, $start, $keyword = null)
	{
		$this->db->select('*');
		$this->db->from('type');
		$this->db->join('mobil', 'mobil.kode_type = type.id_type');
		if($keyword) {
			$this->db->like('merk', $keyword);
			$this->db->or_like('no_plat', $keyword);
			$this->db->or_like('warna', $keyword);
			$this->db->or_like('tahun', $keyword);
		}
		return $this->db->get('', $limit, $start)->result_array();
	}

	public function countAllMobil()
	{
		return $this->db->get('mobil')->num_rows();
	}

}