<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Customer_model');
		cek_login();
	}

	public function index()
	{
		$data['judul'] = 'Customer';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();

		// Jika tombol cari ditekan
		if($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword');
		} else if(!$this->input->post('submit')) {
			$data['keyword'] = $this->session->unset_userdata('keyword');
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		$this->db->like('nama', $data['keyword']);
		$this->db->from('customer');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];

		// Konfigurasi Pagination
		$config['base_url'] = 'http://localhost/rental-mobil-ci/admin/customer/index';
		// $config['total_rows'] = $this->Customer_model->countCustomer();
		// var_dump($config['total_rows']); die;
		$config['per_page'] = 2;
		$config['num_links'] = 2;

		// Konfigurasi Pagination CUSTOMER
		// var_dump($config['total_rows']); die;

		// Style
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

		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);
		$data['customers'] = $this->Customer_model->getCustomer($config['per_page'], $data['start'], $data['keyword']);
		$this->load->view('themeplates_admin/header', $data);
		$this->load->view('themeplates_admin/sidebar', $data);
		$this->load->view('admin/customer/index', $data);
		$this->load->view('themeplates_admin/footer');
	}

	public function tambahCustomer()
	{
		$data['judul'] = 'Tambah Customer';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', 
		['required' => 'Nama Harus Di Isi!']
		);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[6]|max_length[8]', 
		['required' => 'Username Harus Di Isi!'],
		['min_length' => 'Minimal Panjang 6 Huruf'],
		['max_length' => 'Maxsimal Panjang 8 Huruf']
		);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', 
		['required' => 'Password Harus Di Isi!']
		);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', 
		['required' => 'Alamat Harus Di Isi!']
		);
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim', 
		['required' => 'Jenis Harus Di Pilih!']
		);
		$this->form_validation->set_rules('telepon', 'Telepon', 'required|trim', 
		['required' => 'Telepon Harus Di Isi!']
		);
		$this->form_validation->set_rules('ktp', 'No.KTP', 'required|trim', 
		['required' => 'No.KTP Harus Di Isi!']
		);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('themeplates_admin/sidebar', $data);
			$this->load->view('admin/customer/tambah');
			$this->load->view('themeplates_admin/footer');
		} else {
			$this->Customer_model->aksiTambahCustomer();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Customer Berhasil Di Tambahkan.</div>');
			redirect('admin/customer');
		}
	}

	public function editCustomer($id)
	{
		$data['judul'] = 'Edit Customer';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['customer'] = $this->Customer_model->getCustomerById($id);
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', 
		['required' => 'Nama Harus Di Isi!']
		);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[6]|max_length[8]', 
		['required' => 'Username Harus Di Isi!'],
		['min_length' => 'Minimal Panjang 6 Huruf'],
		['max_length' => 'Maxsimal Panjang 8 Huruf']
		);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', 
		['required' => 'Password Harus Di Isi!']
		);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', 
		['required' => 'Alamat Harus Di Isi!']
		);
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim', 
		['required' => 'Jenis Harus Di Pilih!']
		);
		$this->form_validation->set_rules('telepon', 'Telepon', 'required|trim', 
		['required' => 'Telepon Harus Di Isi!']
		);
		$this->form_validation->set_rules('ktp', 'No.KTP', 'required|trim', 
		['required' => 'No.KTP Harus Di Isi!']
		);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('themeplates_admin/sidebar', $data);
			$this->load->view('admin/customer/edit');
			$this->load->view('themeplates_admin/footer');
		} else {
			$this->Customer_model->aksiEditCustomer();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Customer Berhasil Di Edit.</div>');
			redirect('admin/customer');
		}
	}

	public function hapusCustomer($id)
	{
		$this->db->delete('customer', ['id_customer' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Customer Berhasil Di Hapus.</div>');
			redirect('admin/customer');
	}



}