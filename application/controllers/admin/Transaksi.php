<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Transaksi_model');
		cek_login();
	}

	public function index()
	{
		$data['judul'] = 'Data Transaksi';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['transaksi'] = $this->Transaksi_model->getAll3Table();
		$this->load->view('themeplates_admin/header', $data);
		$this->load->view('themeplates_admin/sidebar', $data);
		$this->load->view('admin/transaksi/index', $data);
		$this->load->view('themeplates_admin/footer');
	}

}