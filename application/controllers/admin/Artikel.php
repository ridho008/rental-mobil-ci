<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Artikel_model');
	}

	public function index()
	{
		$data['judul'] = 'Data Artikel';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();

		// Jika tombol cari di tekan
		if($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword');
		} else if($this->input->post('submit')) {
			$data['keyword'] = $this->session->unset_userdata('keyword');
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		$this->db->like('judul_berita', $data['keyword']);
		$this->db->from('berita');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];

		// Konfigurasi Pagination
		$config['base_url'] = 'http://localhost/rental-mobil-ci/admin/artikel/index';
		// $config['total_rows'] = $this->Type_model->countAllType();
		// var_dump($config['total_rows']); die;
		$config['per_page'] = 2;
		$config['num_links'] = 2;

		// Konfigurasi Pagination TYPE
		// var_dump($config['total_rows']); die;

		// style
		$config['full_tag_open'] = '<nav class="d-inline-block"><ul class="pagination mb-0">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '<i class="fas fa-chevron-right"></i>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '<i class="fas fa-chevron-left"></i>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');


		// initialize
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);

		$data['artikel'] = $this->Artikel_model->getBeritaKategori($config['per_page'], $data['start'], $data['keyword']);
		$data['kategori'] = $this->db->get('kategori')->result_array();
		$this->aturanForm();
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('themeplates_admin/sidebar', $data);
			$this->load->view('admin/artikel/index', $data);
			$this->load->view('themeplates_admin/footer');
		} else {
			$this->Artikel_model->tambahArtikel();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Artikel Berhasil Di Tambahkan.</div>');
			redirect('admin/artikel');
		}
	}

	// menampilkan berdasarkan id berita
	public function getubah() 
	{
		// echo $_POST['id'];
		echo json_encode($this->Artikel_model->getArtikelUbah($_POST['id']));
	}

	// aksi ubah data artikel
	public function ubahartikel()
	{
		$this->Artikel_model->ubahDataArtikel($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Artikel Berhasil Di Ubah.</div>');
		redirect('admin/artikel');
	}

	public function hapus($id)
	{
		$this->db->where('id_berita', $id);
		$row = $this->db->get('berita')->row_array();
		unlink('./assets/berita/' . $row['foto_berita']);
		$this->db->delete('berita', ['id_berita' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Artikel Berhasil Di Hapus.</div>');
		redirect('admin/artikel');
	}


	public function aturanForm()
	{
		$this->form_validation->set_rules('judul', 'Judul Berita', 'required|trim',
		['required' => 'Judul Berita Wajib Isi!']
		);
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|trim',
		['required' => 'Kategori Wajib Isi!']
		);
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim',
		['required' => 'Deskripsi Wajib Isi!']
		);
	}

	public function review($id)
	{
		$data['judul'] = 'Review Artikel';
		$data['review'] = $this->db->get_where('berita', ['id_berita' => $id])->row_array();

		$this->form_validation->set_rules('terbit', 'Terbit', 'required|trim', ['required' => 'Terbit Wajib Di Isi!']);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('admin/artikel/review', $data);
			$this->load->view('themeplates_admin/footer', $data);
		} else {
			$this->terbit($id);
		}
	}

	public function terbit($id)
	{
		$this->db->set('terbit', '1');
		$this->db->where('id_berita', $id);
		$this->db->update('berita');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Artikel Berhasil Di Publikasikan.</div>');
		redirect('admin/artikel');
	}

	public function ubahdeskripsi()
	{
		$deskripsi = $this->input->post('deskripsi', true);
		$id_berita = $this->input->post('id_berita', true);
		$this->db->set('deskripsi', $deskripsi);
		$this->db->where('id_berita', $id_berita);
		$this->db->update('berita');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Deskripsi Artikel Berhasil Di Ubah.</div>');
		redirect('admin/artikel');
	}

}