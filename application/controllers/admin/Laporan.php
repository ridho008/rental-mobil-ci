<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Laporan_model');
	}

	public function index()
	{
		$data['judul'] = 'Laporan Transaksi';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('dari', 'Dari Tanggal', 'required|trim',
		['required' => 'Dari Tanggal Harus Di Isi!']
		);
		$this->form_validation->set_rules('sampai', 'Sampai Tanggal', 'required|trim',
		['required' => 'Sampai Tanggal Harus Di Isi!']
		);
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('themeplates_admin/sidebar', $data);
			$this->load->view('admin/laporan/tgllaporan', $data);
			$this->load->view('themeplates_admin/footer');
		} else {
			$data['laporan'] = $this->Laporan_model->tampilLaporanPerTgl();
			// var_dump($data['laporan']); die;
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('themeplates_admin/sidebar', $data);
			$this->load->view('admin/laporan/tampil_laporan', $data);
			$this->load->view('themeplates_admin/footer');
		}
	}

	public function print()
	{
		$data['judul'] = 'Laporan Transaksi';
		$data['laporan'] = $this->Laporan_model->printTransaksi();
		$this->load->view('themeplates_admin/header', $data);
		$this->load->view('admin/laporan/print', $data);
	}

}