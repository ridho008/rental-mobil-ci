<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Artikel_model');
	}

	public function index()
	{
		$data['judul'] = 'Semua Artikel';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->db->get('type')->result_array();
		$this->db->order_by('id_berita', 'DESC');
		$data['berita'] = $this->db->get_where('berita', ['terbit' => '1'])->result_array();
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();
		$this->load->view('themeplates_customers/header', $data);
		$this->load->view('customer/artikel', $data);
		$this->load->view('themeplates_customers/footer');
	}

	public function baca($id)
	{
		$data['judul'] = 'Detail Artikel';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->db->get('type')->result_array();
		$data['berita'] = $this->Artikel_model->joinBeritaCustomer($id);
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();
		$this->load->view('themeplates_customers/header', $data);
		$this->load->view('customer/baca_artikel', $data);
		$this->load->view('themeplates_customers/footer');
	}

}