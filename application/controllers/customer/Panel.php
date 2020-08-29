<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Panel_model');
	}

	public function index()
	{
		$data['judul'] = 'Dashboard Customer';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();
		$data['artikel'] = $this->Panel_model->countAllArtikel();
		$data['transaksi'] = $this->Panel_model->countAllTransaksi();
		$this->load->view('themeplates_customers/header', $data);
		$this->load->view('customer/panel/index', $data);
		$this->load->view('themeplates_customers/footer');
	}

	public function artikel()
	{
		$data['judul'] = 'Artikel';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();

		// Pencarian
		if($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else if(!$this->input->post('submit')) {
			$data['keyword'] = $this->session->unset_userdata('keyword');
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		// Konfigurasi Pagination
		$config['base_url'] = 'http://localhost/rental-mobil-ci/customer/panel/artikel/index';
		$config['total_rows'] = $this->Panel_model->countAllArtikel();
		// var_dump($config['total_rows']); die;
		$config['per_page'] = 2;
		$config['num_links'] = 2;

		// STYLE
		$config['full_tag_open'] = '<nav><ul class="pagination ok">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(5);
		$data['artikel'] = $this->Panel_model->getAllByUser($config['per_page'], $data['start'], $data['keyword']);
		$this->load->view('themeplates_customers/header', $data);
		$this->load->view('customer/panel/artikel', $data);
		$this->load->view('themeplates_customers/footer');
	}

	public function tambahartikel()
	{
		$data['judul'] = 'Tambah Artikel';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();
		$data['kategori'] = $this->db->get('kategori')->result_array();

		$this->form_validation->set_rules('judul', 'Judul Artikel', 'required|trim', ['required' => 'Judul Artikel Wajib Di Isi!']);
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|trim', ['required' => 'Judul Kategori Wajib Di Isi!']);
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ['required' => 'Deskripsi Wajib Di Isi!']);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_customers/header', $data);
			$this->load->view('customer/panel/tambahartikel', $data);
			$this->load->view('themeplates_customers/footer');
		} else {
			$this->Panel_model->aksiTambahArtikel();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success mt-1"><i class="fa fa-check-circle" aria-hidden="true"></i> Artikel Berhasil Di Tambahkan, Silahkan Tunggu Persetujuan Admin.</div>');
			redirect('customer/panel/artikel');
		}
	}

	public function ubahartikel($id)
	{
		$data['judul'] = 'Ubah Artikel';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();
		$data['berita'] = $this->Panel_model->getArtikelById($id);
		$data['kategori'] = $this->db->get('kategori')->result_array();

		$this->form_validation->set_rules('judul', 'Judul Artikel', 'required|trim', ['required' => 'Judul Artikel Wajib Di Isi!']);
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|trim', ['required' => 'Judul Kategori Wajib Di Isi!']);
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', ['required' => 'Deskripsi Wajib Di Isi!']);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_customers/header', $data);
			$this->load->view('customer/panel/ubahartikel', $data);
			$this->load->view('themeplates_customers/footer');
		} else {
			$this->Panel_model->aksiUbahArtikel();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success mt-1"><i class="fa fa-check-circle" aria-hidden="true"></i> Artikel Berhasil Di Ubah, Silahkan Tunggu Persetujuan Admin.</div>');
			redirect('customer/panel/artikel');
		}
	}

	public function hapusartikel($id)
	{
		$this->db->delete('berita', ['id_berita' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success mt-1"><i class="fa fa-check-circle" aria-hidden="true"></i> Artikel Berhasil Di Hapus.</div>');
		redirect('customer/panel/artikel');
	}

	public function lihat($id)
	{
		$data['judul'] = 'Lihat Artikel';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();
		$data['berita'] = $this->Panel_model->getArtikelById($id);
		$this->load->view('themeplates_customers/header', $data);
		$this->load->view('customer/panel/lihat', $data);
		$this->load->view('themeplates_customers/footer');
	}

}