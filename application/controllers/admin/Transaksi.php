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

		// Kolom Pencarian
		if($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else if(!$this->input->post('submit')) {
			$data['keyword'] = $this->session->unset_userdata('keyword');
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		// $this->db->like('merk', $data['keyword']);
		$this->db->from('transaksi');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];

		// KOnfigurasi Pagination
		$config['base_url'] = 'http://localhost/rental-mobil-ci/admin/transaksi/index';
		// $config['total_rows'] = $this->Transaksi_model->countAllTransaksi();
		// var_dump($config['total_rows']); die;
		$config['per_page'] = 2;

		// STYLE
		$config['full_tag_open'] = '<nav class="d-inline-block"><ul class="pagination mb-0">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '<i class="fas fa-chevron-right"></i>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '<i class="fas fa-chevron-left"></i>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		// Initialize
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);
		$data['transaksi'] = $this->Transaksi_model->getAll3Table($config['per_page'], $data['start'], $data['keyword']);
		$this->load->view('themeplates_admin/header', $data);
		$this->load->view('themeplates_admin/sidebar', $data);
		$this->load->view('admin/transaksi/index', $data);
		$this->load->view('themeplates_admin/footer');
	}

	public function pembayaran($id)
	{
		$data['judul'] = 'Konfirmasi Pembayaran';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['pembayaran'] = $this->Transaksi_model->getTransaksiById($id);
		$this->load->view('themeplates_admin/header', $data);
		$this->load->view('themeplates_admin/sidebar', $data);
		$this->load->view('admin/transaksi/konfirmasi_pembayaran', $data);
		$this->load->view('themeplates_admin/footer');
	}

	public function cek_pembayaran()
	{
		$id_rental = $this->input->post('id_rental', true);
		$statusPembayaran = $this->input->post('status_pembayaran', true);

		$this->db->set('status_pembayaran', $statusPembayaran);
		$this->db->where('id_rental', $id_rental);
		$this->db->update('transaksi');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Konfirmasi Bukti Pembayaran Berhasil.</div>');
		redirect('admin/transaksi');
	}

	public function download($id)
	{
		$this->load->helper('download');
		$filePembayaran = $this->Transaksi_model->downloadPembayaran($id);
		$file = 'assets/bukti/' . $filePembayaran['bukti_pembayaran'];
		force_download($file, NULL);
	}

	public function transaksiSelesai($id)
	{
		$data['judul'] = 'Transaksi Selesai';
		$data['transaksi'] = $this->db->get_where('transaksi', ['id_rental' => $id])->result_array();
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('tgl_penggembalian', 'Tanggal Penggembalian', 'required|trim',
		['required' => 'Tanggal Penggembalian Harus Di Isi!']
		);
		$this->form_validation->set_rules('status_penggembalian', 'Status Penggembalian', 'required|trim',
		['required' => 'Status Penggembalian Harus Di Isi!']
		);
		$this->form_validation->set_rules('status_rental', 'Status Rental', 'required|trim',
		['required' => 'Status Rental Harus Di Isi!']
		);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('themeplates_admin/sidebar', $data);
			$this->load->view('admin/transaksi/transaksi_selesai', $data);
			$this->load->view('themeplates_admin/footer');
		} else {
			$this->Transaksi_model->updateTransaksiSelesai();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Transaksi Selesai Berhasil Di Ubah.</div>');
			redirect('admin/transaksi');
		}
	}

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
		redirect('admin/transaksi');
	}


}