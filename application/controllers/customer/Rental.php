<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mobil_model');
		$this->load->model('Rental_model');
	}

	public function tambahRental($id)
	{
		if(!$this->session->userdata('role_id') == 2) {
			redirect('auth');
		}
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['judul'] = 'Pesan Mobil';
		$data['kategori'] = $this->db->get('type')->result_array();
		$data['mobil'] = $this->Mobil_model->getMobilById($id);
		$data['notif'] = $this->db->get_where('transaksi', ['status_pembayaran' => '0', 'status_rental' => 'Belum Selesai', 'id_customer' => $this->session->userdata('id_customer')])->num_rows();

		$this->form_validation->set_rules('harga', 'Harga Sewa', 'required|trim',
		[
		'required' => 'Harga Sewa Harus Di Isi'
		]
		);
		$this->form_validation->set_rules('denda', 'Denda', 'required|trim',
		[
		'required' => 'Denda Harus Di Isi'
		]
		);
		$this->form_validation->set_rules('tgl_rental', 'Tanggal Rental', 'required|trim',
		[
		'required' => 'Tanggal Rental Harus Di Isi'
		]
		);
		$this->form_validation->set_rules('tgl_kembali', 'Tanggal Kembali', 'required|trim',
		[
		'required' => 'Tanggal Kembali Harus Di Isi'
		]
		);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_customers/header', $data);
			$this->load->view('customer/tambahRental', $data);
			$this->load->view('themeplates_customers/footer');
		} else {
			$this->Rental_model->aksiTambahRental($id);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success mt-1"><i class="fa fa-check-circle" aria-hidden="true"></i> Anda Berhasil Merental Mobil!.</div>');
				redirect('home');
		}
	}
}