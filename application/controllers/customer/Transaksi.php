<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Transaksi_model');
	}

	public function index()
	{
		$data['judul'] = 'Transaksi Customer';
		if(!$this->session->userdata('role_id') == 2) {
			redirect('auth');
		}
		// $data['transaksi'] = $this->db->query("SELECT * FROM transaksi tr, mobil mb, customer cs WHERE tr.id_mobil = mb.id_mobil AND tr.id_customer = cs.id_customer")->result_array();
		$id_customer = $this->session->userdata('username');
		$data['transaksi'] = $this->Transaksi_model->getAllCustomerJoin($id_customer);
		// $id = $this->session->userdata('id_customer');
		// $data['transaksi'] = $this->db->query("SELECT * FROM transaksi INNER JOIN mobil ON mobil.id_mobil = transaksi.id_mobil INNER JOIN customer ON customer.id_customer = transaksi.id_customer WHERE customer.username = '$id_customer'")->result_array();
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();
		$data['kategori'] = $this->db->get('type')->result_array();
		$this->load->view('themeplates_customers/header', $data);
		$this->load->view('customer/transaksi', $data);
		$this->load->view('themeplates_customers/footer');
	}

	public function pembayaran($id)
	{
		$data['judul'] = 'Pembayaran Customer';
		if(!$this->session->userdata('role_id') == 2) {
			redirect('auth');
		}
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['transaksi'] = $this->Transaksi_model->getAllCustomerPembayaran($id);
		$data['kategori'] = $this->db->get('type')->result_array();
		$data['bank'] = $this->db->get('bank')->result_array();
		$this->load->view('themeplates_customers/header', $data);
		$this->load->view('customer/pembayaran', $data);
		$this->load->view('themeplates_customers/footer');
	}

	public function uploadbuktii()
	{
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();
		$this->Transaksi_model->uploadBuktiPembayaran();
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Bukti Sudah Terkirim.</div>');
		redirect('customer/transaksi');
	}

	public function cetakInvoice($id)
	{
		$data['transaksi'] = $this->Transaksi_model->getAllCustomerPembayaran($id);
		$this->load->view('customer/cetak_invoice', $data);
	}

	// Fungsi untuk membatalkan pesanan customer
	public function batal($id)
	{
		$data = $this->db->get_where('transaksi', ['id_rental' => $id])->row_array();
		// var_dump($data); die;
		$id_mobil = $data['id_mobil'];
		// var_dump($id_mobil); die;
		$this->db->set('status', '1');
		$this->db->where('id_mobil', $id_mobil);
		$this->db->update('mobil');
		$this->db->delete('transaksi', ['id_rental' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="fa fa-info-circle" aria-hidden="true"></i> Transaksi Berhasil Di Batalkan.</div>');
		redirect('customer/transaksi');
	}

}