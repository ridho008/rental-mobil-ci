<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel_model extends CI_Model {
	public function getAllByUser($limit, $start, $keyword = null)
	{
		if($keyword) {
			$this->db->like('judul_berita', $keyword);
		}
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->join('customer', 'customer.id_customer = berita.updateby');
		$this->db->join('kategori', 'kategori.id_kategori = berita.id_kategori');
		$this->db->where('berita.updateby', $this->session->userdata('id_customer'));
		$this->db->order_by('berita.id_berita', 'DESC');
		return $this->db->get('', $limit, $start)->result_array();
	}

	public function aksiTambahArtikel()
	{
		$foto = $_FILES['foto']['name'];

		if($foto) {
			$config['allowed_types'] = 'gif|png|jpg';
			$config['max_sizes'] = '2048';
			$config['upload_path'] = './assets/berita/';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('foto')) {
				$this->upload->data('file_name');
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = [
				'judul_berita' => $this->input->post('judul'),
				'deskripsi' => $this->input->post('deskripsi'),
				'id_kategori' => $this->input->post('kategori'),
				'tgl_post' => date('Y-m-d'),
				'updateby' => $this->session->userdata('id_customer'),
				'terbit' => '0',
				'foto_berita' => $foto
		];

		$this->db->insert('berita', $data);
	}

	public function aksiUbahArtikel()
	{
		$foto = $_FILES['foto']['name'];

		if($foto) {
			$config['allowed_types'] = 'gif|png|jpg';
			$config['max_sizes'] = '2048';
			$config['upload_path'] = './assets/berita/';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('foto')) {
				$fotoLama = $this->input->post('fotoLama');
				if($fotoLama != 'default.jpg') {
					unlink(FCPATH . 'assets/berita/' . $fotoLama);
				}

				$fotoBaru = $this->upload->data('file_name');
				$this->db->set('foto_berita', $fotoBaru);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$id_berita = $this->input->post('id_berita', true);
		$data = [
				'judul_berita' => $this->input->post('judul'),
				'deskripsi' => $this->input->post('deskripsi'),
				'id_kategori' => $this->input->post('kategori')
		];

		$this->db->where('id_berita', $id_berita);
		$this->db->update('berita', $data);
	}

	public function getArtikelById($id)
	{
		return $this->db->get_where('berita', ['id_berita' => $id])->row_array();
	}

	public function countAllArtikel()
	{
		return $this->db->get_where('berita', ['updateby' => $this->session->userdata('id_customer')])->num_rows();
	}

	public function countAllTransaksi()
	{
		$status_pembayaran = '0';
		return $this->db->get_where('transaksi', ['id_customer' => $this->session->userdata('id_customer'), 'status_pembayaran' => $status_pembayaran])->num_rows();
	}


}