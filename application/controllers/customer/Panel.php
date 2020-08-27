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
		$data['artikel'] = $this->Panel_model->getAllByUser();
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

}