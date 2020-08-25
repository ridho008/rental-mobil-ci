<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Type_model');
		cek_login();
	}

	public function index()
	{
		$data['judul'] = 'Halaman Data Type';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();

		// Jika tombol cari di tekan
		if($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword');
		} else if($this->input->post('submit')) {
			$data['keyword'] = $this->session->unset_userdata('keyword');
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		$this->db->like('nama_type', $data['keyword']);
		$this->db->from('type');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];

		// Konfigurasi Pagination
		$config['base_url'] = 'http://localhost/rental-mobil-ci/admin/type/index';
		// $config['total_rows'] = $this->Type_model->countAllType();
		// var_dump($config['total_rows']); die;
		$config['per_page'] = 2;
		$config['num_links'] = 2;

		// Konfigurasi Pagination TYPE
		// var_dump($config['total_rows']); die;

		// style
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


		// initialize
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(4);
		$data['type'] = $this->Type_model->getAllTypeLimit($config['per_page'], $data['start'], $data['keyword']);
		$this->load->view('themeplates_admin/header', $data);
		$this->load->view('themeplates_admin/sidebar', $data);
		$this->load->view('admin/type/index', $data);
		$this->load->view('themeplates_admin/footer');
	}

	public function tambahType()
	{
		$data['judul'] = 'Tambah Data Type';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$this->form_validation->set_rules('kode_type', 'Kode Type', 'required|trim|max_length[4]',
		[
		'required' => 'Kode Type Harus Di Isi!',
		'max_length' => 'Kode Type Maxsimal 4 Huruf!'
		]
		);
		$this->form_validation->set_rules('nama_type', 'Nama Type', 'required|trim',
		['required' => 'Nama Type Harus Di Isi!']
		);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('themeplates_admin/sidebar', $data);
			$this->load->view('admin/type/tambahType', $data);
			$this->load->view('themeplates_admin/footer');
		} else {
			$this->Type_model->aksiTypeTambah();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Type Berhasil Di Tambahkan.</div>');
			redirect('admin/type');
		}
	}

	public function editType($id)
	{
		$data['judul'] = 'Edit Data Type';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['type'] = $this->Type_model->getTypeById($id);
		$this->form_validation->set_rules('kode_type', 'Kode Type', 'required|trim',
		[
		'required' => 'Kode Type Harus Di Isi!'
		]
		);
		$this->form_validation->set_rules('nama_type', 'Nama Type', 'required|trim',
		['required' => 'Nama Type Harus Di Isi!']
		);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('themeplates_admin/sidebar', $data);
			$this->load->view('admin/type/editType', $data);
			$this->load->view('themeplates_admin/footer');
		} else {
			$this->Type_model->aksiTypeEdit();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Type Berhasil Di Edit.</div>');
			redirect('admin/type');
		}
	}

	public function hapusType($id)
	{
		$this->db->delete('type', ['id_type' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Type Berhasil Di Hapus.</div>');
			redirect('admin/type');
	}

}