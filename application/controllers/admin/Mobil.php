<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mobil_model');
		cek_login();
	}

	public function index()
	{
		$data['judul'] = 'Halaman Data Mobil';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();

		// Ambil keyword
		// jika tombol cari ditekan
		if($this->input->post('submit')) {
			$data['keyword'] =  $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else if(!$this->input->post('submit')) {
			$data['keyword'] = $this->session->unset_userdata('keyword');
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		// Konfigurasi Pagination
		// $config['total_rows'] = $this->Mobil_model->countAllMobil();
		$this->db->like('merk', $data['keyword']);
		$this->db->from('mobil');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];
		// var_dump($config['total_rows']); die;
		$config['per_page'] = 2;

		// initialize
		$this->pagination->initialize($config);



		$data['start'] = $this->uri->segment(4);
		$data['mobil'] = $this->Mobil_model->getMobil($config['per_page'], $data['start'], $data['keyword']);

		$this->load->view('themeplates_admin/header', $data);
		$this->load->view('themeplates_admin/sidebar', $data);
		$this->load->view('admin/mobil/index', $data);
		$this->load->view('themeplates_admin/footer');
	}

	public function tambahMobil()
	{
		$data['judul'] = 'Tambah Data Mobil';
		$data['type'] = $this->db->get('type')->result_array();
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('type', 'Type', 'required|trim', 
		['required' => 'Type Harus Dipilih!']
		);
		$this->form_validation->set_rules('merk', 'Merk', 'required|trim', 
		['required' => 'Merk Harus Diisi!']);
		$this->form_validation->set_rules('no_plat', 'No.Plat', 'required|trim', 
		['required' => 'No.Plat Harus Diisi!']);
		$this->form_validation->set_rules('warna', 'Warna', 'required|trim', 
		['required' => 'Warna Harus Diisi!']);
		$this->form_validation->set_rules('tahun', 'Tahun', 'required|trim', 
		['required' => 'Tahun Harus Diisi!']);
		$this->form_validation->set_rules('status', 'Status', 'required|trim', 
		['required' => 'Status Harus Dipilih!']
		);
		$this->form_validation->set_rules('harga', 'Harga Sewa', 'required|trim', 
		['required' => 'Harga Sewa Harus Di Isi!']
		);
		$this->form_validation->set_rules('denda', 'Denda', 'required|trim', 
		['required' => 'Denda Harus Di Isi!']
		);
		$this->form_validation->set_rules('ac', 'AC', 'required|trim', 
		['required' => 'AC Harus Dipilih!']
		);
		$this->form_validation->set_rules('mp3', 'MP3 Player', 'required|trim', 
		['required' => 'MP3 Player Harus Dipilih!']
		);
		$this->form_validation->set_rules('supir', 'Supir', 'required|trim', 
		['required' => 'Supir Harus Dipilih!']
		);
		$this->form_validation->set_rules('lock', 'Central Lock', 'required|trim', 
		['required' => 'Central Lock Harus Dipilih!']
		);
		$this->form_validation->set_rules('gambar', 'Gambar', 'trim');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('themeplates_admin/sidebar', $data);
			$this->load->view('admin/mobil/tambahMobil');
			$this->load->view('themeplates_admin/footer');
		} else {
			$this->Mobil_model->aksi_tambah();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Mobil Berhasil Di Tambahkan.</div>');
			redirect('admin/mobil');
		}
	}

	public function EditMobil($id)
	{
		$data['judul'] = 'Edit Data Mobil';
		// $data['type'] = $this->db->get('type')->result_array();
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['mobil'] = $this->Mobil_model->getMobilById($id);
		$data['type'] = $this->db->get('type')->result_array();

		$this->form_validation->set_rules('type', 'Type', 'required|trim', 
		['required' => 'Type Harus Dipilih!']
		);
		$this->form_validation->set_rules('merk', 'Merk', 'required|trim', 
		['required' => 'Merk Harus Diisi!']);
		$this->form_validation->set_rules('no_plat', 'No.Plat', 'required|trim', 
		['required' => 'No.Plat Harus Diisi!']);
		$this->form_validation->set_rules('warna', 'Warna', 'required|trim', 
		['required' => 'Warna Harus Diisi!']);
		$this->form_validation->set_rules('tahun', 'Tahun', 'required|trim', 
		['required' => 'Tahun Harus Diisi!']);
		$this->form_validation->set_rules('status', 'Status', 'required|trim', 
		['required' => 'Status Harus Dipilih!']
		);
		$this->form_validation->set_rules('harga', 'Harga Sewa', 'required|trim', 
		['required' => 'Harga Sewa Harus Di Isi!']
		);
		$this->form_validation->set_rules('denda', 'Denda', 'required|trim', 
		['required' => 'Denda Harus Di Isi!']
		);
		$this->form_validation->set_rules('ac', 'AC', 'required|trim', 
		['required' => 'AC Harus Dipilih!']
		);
		$this->form_validation->set_rules('mp3', 'MP3 Player', 'required|trim', 
		['required' => 'MP3 Player Harus Dipilih!']
		);
		$this->form_validation->set_rules('supir', 'Supir', 'required|trim', 
		['required' => 'Supir Harus Dipilih!']
		);
		$this->form_validation->set_rules('lock', 'Central Lock', 'required|trim', 
		['required' => 'Central Lock Harus Dipilih!']
		);
		// $this->form_validation->set_rules('gambar', 'Gambar', 'required|trim', 
		// ['required' => 'Gambar Wajib Di Upload, PNG/JPG!']
		// );
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('themeplates_admin/sidebar', $data);
			$this->load->view('admin/mobil/editMobil');
			$this->load->view('themeplates_admin/footer');
		} else {
			$this->Mobil_model->aksi_edit();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Mobil Berhasil Di Ubah.</div>');
			redirect('admin/mobil');
		}
	}

	public function detailMobil($id)
	{
		$data['judul'] = 'Detail Mobil';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		// $data['mobil'] = $this->Mobil_model->getMobilById($id);
		$data['mobil'] = $this->Mobil_model->getMobilTypeJoin($id);
		$this->load->view('themeplates_admin/header', $data);
		$this->load->view('themeplates_admin/sidebar', $data);
		$this->load->view('admin/mobil/detailMobil', $data);
		$this->load->view('themeplates_admin/footer');
	}

	public function hapusMobil($id)
	{
		$this->db->where('id_mobil', $id);
		$row = $this->db->get('mobil')->row_array();
		unlink('./assets/assets_stisla/img/mobil/' . $row['gambar']);
		$this->db->delete('mobil', ['id_mobil' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Data Mobil Berhasil Di Hapus.</div>');
			redirect('admin/mobil');
	}



}