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

}