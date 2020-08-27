<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Type_model');
		$this->load->model('Kategori_model');
	}

	public function index($id)
	{
		$data['judul'] = 'Kategori';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['kateid'] = $this->Type_model->getTypeById($id);
		$data['mobil'] = $this->Kategori_model->getMobilTypeJoin($id);
		$data['kategori'] = $this->db->get('type')->result_array();
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();
		$this->load->view('themeplates_customers/header', $data);
		$this->load->view('customer/kategori', $data);
		$this->load->view('themeplates_customers/footer');	
	}

}