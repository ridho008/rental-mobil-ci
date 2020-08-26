<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Dashboard_model');
	}

	public function index()
	{
		$data['judul'] = 'Dashboard';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['mobil'] = $this->db->get('mobil')->num_rows();
		$data['customers'] = $this->db->get('customer')->num_rows();
		$data['transaksi'] = $this->db->get('transaksi')->num_rows();
		$data['type'] = $this->db->get('type')->num_rows();
		$dataGrafik = $this->Dashboard_model->getTransaksi();
		$data['grafik'] = json_encode($dataGrafik);
		$this->load->view('themeplates_admin/header', $data);
		$this->load->view('themeplates_admin/sidebar', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('themeplates_admin/footer');
	}




}