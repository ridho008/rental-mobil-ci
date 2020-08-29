<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel_model extends CI_Model {
	public function getBeritaKategori($limit, $start, $keyword = null)
	{
		if($keyword) {
			$this->db->like('judul_berita', $keyword);
		}
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->join('kategori', 'kategori.id_kategori = berita.id_kategori');
		$this->db->order_by('berita.id_berita', 'DESC');
		return $this->db->get('', $limit, $start)->result_array();
	}

	public function getAllBeritaKategori()
	{
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->join('kategori', 'kategori.id_kategori = berita.id_kategori');
		$this->db->order_by('berita.id_berita', 'DESC');
		return $this->db->get()->result_array();
	}

	public function tambahArtikel()
	{
		$fotoBerita = $_FILES['foto']['name'];

		if($fotoBerita) {
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
				'foto_berita' => $fotoBerita
		];

		$this->db->insert('berita', $data);
	}

	public function getArtikelUbah($id)
	{
		return $this->db->get_where('berita', ['id_berita' => $id])->row_array();
	}

	public function ubahDataArtikel($pos)
	{
		$fotoBerita = $_FILES['foto']['name'];

		if($fotoBerita) {
			$config['allowed_types'] = 'gif|png|jpg';
			$config['max_sizes'] = '2048';
			$config['upload_path'] = './assets/berita/';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('foto')) {
				$fotoLama = $pos['inputfoto'];
				// $pecahArr = explode('.', $fotoLama);
				// $stringArr = implode(".",$pecahArr);
				// var_dump($pos); die;
				// var_dump($ektensiFotoLama); die;
				// $ektensiFotoLama = strtolower(end($ektensiFotoLama));
				// if($fotoLama != 'default.jpg') {
				// 	unlink(FCPATH . 'assets/assets/berita/' . $fotoLama);
				// }

				$fotoBaru = $this->upload->data('file_name');
				$this->db->set('foto_berita', $fotoBaru);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$id_berita = $pos['id_berita'];
		$data = [
				'judul_berita' => $pos['judul'],
				'deskripsi' => $pos['deskripsi'],
				'id_kategori' => $pos['kategori']
		];
		

		// var_dump($pos['inputfoto']); die;

		$this->db->where('id_berita', $id_berita);
		$this->db->set($data);
		$this->db->update('berita');
	}

	public function count_all_artikel()
	{
		return $this->db->get('berita')->num_rows();
	}

	public function joinBeritaCustomer($id)
	{
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->join('customer', 'customer.id_customer = berita.updateby');
		$this->db->join('kategori', 'kategori.id_kategori = berita.id_kategori');
		$this->db->where('berita.id_berita', $id);
		return $this->db->get()->row_array();
	}

	public function joinArtikelKategori()
	{
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->join('kategori', 'kategori.id_kategori = berita.id_kategori');
		$this->db->where('berita.id_kategori', 'kategori.id_kategori');
		return $this->db->get()->result_array();
	}

	public function joinBeritaKategoriById($id)
	{
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->join('kategori', 'kategori.id_kategori = berita.id_kategori');
		$this->db->where('berita.id_kategori', $id);
		return $this->db->get()->result_array();
	}

}