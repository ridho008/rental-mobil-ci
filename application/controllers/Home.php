<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mobil_model');
	}

	public function index()
	{
		$data['judul'] = 'Rental Mobil Surya';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['mobil'] = $this->Mobil_model->getAllMobil();
		$data['kategori'] = $this->db->get('type')->result_array();
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();
		// var_dump($this->session->userdata('id_customer')); die;
		$this->load->view('themeplates_customers/header', $data);
		$this->load->view('customer/dashboard', $data);
		$this->load->view('themeplates_customers/footer');
	}

	public function detail($id)
	{
		$data['judul'] = 'Detail Mobil';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['detail'] = $this->Mobil_model->getMobilTypeJoin($id);
		// $data['detail'] = $this->Mobil_model->getAllMobil();
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();
		$data['kategori'] = $this->db->get('type')->result_array();
		$this->load->view('themeplates_customers/header', $data);
		$this->load->view('customer/detail', $data);
		$this->load->view('themeplates_customers/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('id_customer');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Berhasil Logout.</div>');
			redirect('auth');
	}

	public function rupiah($uang)
	{
		$rupiah = "Rp. " . number_format($angka, 0, ',', '.');
		return $rupiah;
	}


}