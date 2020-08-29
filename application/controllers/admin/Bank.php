<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Bank_model');
	}

	public function index()
	{
		$data['judul'] = 'Pengelola Bank';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();

		// Pencarian
		if($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword');
		} else if(!$this->input->post('submit')) {
			$data['keyword'] = $this->session->unset_userdata('keyword');
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		$this->db->like('no_rek', $data['keyword']);
		$this->db->or_like('nama_rek', $data['keyword']);
		$this->db->from('bank');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];
		// Konfigurasi Pagination
		$config['base_url'] = 'http://localhost/rental-mobil-ci/admin/bank/index';
		// $config['total_rows'] = $this->Bank_model->countAllBank();
		// var_dump($config['total_rows']); die;
		$config['per_page'] = 2;

		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);
		$data['bank'] = $this->Bank_model->getAllBank($config['per_page'], $data['start'], $data['keyword']);
		$this->form_validation->set_rules('nama', 'Nama Bank', 'required|trim', ['required' => 'Nama Bank Wajib Di Isi!']);
		$this->form_validation->set_rules('no', 'No.Rekening', 'required|trim', ['required' => 'No.Rekening Wajib Di Isi!']);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('themeplates_admin/sidebar', $data);
			$this->load->view('admin/bank/index', $data);
			$this->load->view('themeplates_admin/footer');
		} else {
			$this->Bank_model->tambahBank();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Bank Berhasil Di Tambahkan.</div>');
			redirect('admin/bank');
		}
	}

	public function hapus($id)
	{
		$this->db->delete('bank', ['id_bank' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Bank Berhasil Di Hapus.</div>');
		redirect('admin/bank');
	}

	public function getubahbank()
	{
		// echo $_POST['id'];
		echo json_encode($this->Bank_model->getBankById($_POST['id']));
	}

	public function ubahbank()
	{
		$this->Bank_model->aksiUbahBank($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Bank Berhasil Di Ubah.</div>');
		redirect('admin/bank');
	}

}