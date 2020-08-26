<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
	}

	public function index()
	{
		$data['judul'] = 'Halaman Login';
		$this->defaultPage();
		$this->form_validation->set_rules('username', 'Username', 'required|trim', 
		['required' => 'Username Harus Di Isi!']
		);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', 
		['required' => 'Password Harus Di Isi!']
		);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('auth/login', $data);
			$this->load->view('themeplates_admin/footer');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// ambil username, karna di cek username
		$customer = $this->db->get_where('customer', ['username' => $username])->row_array();

		if($customer != null) {
			// cek apakah password benar atau tidak
			if(password_verify($password, $customer['password'])) {
				// jika benar
				$data = [
						'username' => $customer['username'],
						'id_customer' => $customer['id_customer'],
						'role_id' => $customer['role_id']
				];
				// masukan $data kedalam session
				$this->session->set_userdata($data);

				if($customer['role_id'] == 1) {
					redirect('admin/dashboard');
				} else {
					redirect('home');
				}
			} else {
				// jika password salah
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger"><i class="far fa-lightbulb"></i> Password anda salah, coba lagi!.</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger"><i class="far fa-lightbulb"></i> Akun Belum Di Daftar, Tidak Bisa Login!.</div>');
			redirect('auth');
		}
	}

	public function daftar()
	{
		$this->defaultPage();
		$data['judul'] = 'Daftar Customer Rental Mobil';

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', 
		['required' => 'Nama Harus Di Isi!']
		);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[6]|max_length[8]', 
		['required' => 'Status Harus Di Isi!',
		'min_length' => 'Minimal Panjang 6 Huruf',
		'max_length' => 'Maxsimal Panjang 8 Huruf'
		]
		);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', 
		['required' => 'Password Harus Di Isi!',
		'min_length' => 'Minimal Panjang 6 Huruf',
		'matches' => 'Konfirmasi Password Tidak Sama!'
		]
		);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]', 
		['required' => 'Konfirmasi Password Harus Di Isi!',
		]
		);
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim', 
		['required' => 'Jenis Kelamin Harus Di Pilih!']
		);
		$this->form_validation->set_rules('ktp', 'No.KTP', 'required|trim', 
		['required' => 'No.KTP Harus Di Isi!']
		);
		$this->form_validation->set_rules('telepon', 'Telepon', 'required|trim', 
		['required' => 'Telepon Harus Di Isi!']
		);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', 
		['required' => 'Alamat Harus Di Isi!']
		);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('auth/daftar', $data);
			$this->load->view('themeplates_admin/footer');
		} else {
			$this->Auth_model->aksiDaftar();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Akun Berhasil Di Buat, Silahkan Login.</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('id_customer');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="far fa-lightbulb"></i> Berhasil Logout.</div>');
			redirect('auth');
	}

	public function gantipass()
	{
		$data['judul'] = 'Ganti Password';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->db->get('type')->result_array();

		$this->form_validation->set_rules('passlama', 'Password Lama', 'required|trim|min_length[3]', 
		['required' => 'Password Lama Harus Di Isi!']
		);
		$this->form_validation->set_rules('passbaru1', 'Password Baru', 'required|trim|matches[passbaru2]', 
		['required' => 'Password Baru Harus Di Isi!',
		'min_length' => 'Password Minimal 5 Huruf!',
		'matches' => 'Konfirmasi Password Tidak Sama!'
		]
		);
		$this->form_validation->set_rules('passbaru2', 'Konfirmasi Password', 'required|trim|matches[passbaru1]', 
		['required' => 'Konfirmasi Password Harus Di Isi!',
		'matches' => 'Konfirmasi Password Tidak Sama!'
		]
		);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_customers/header', $data);
			$this->load->view('auth/gantipass', $data);
			$this->load->view('themeplates_customers/footer');	
		} else {
			$passwordLama = $this->input->post('passlama', true);
			$passwordBaru1 = $this->input->post('passbaru1', true);
			$passwordBaru2 = $this->input->post('passbaru2', true);

			if(!password_verify($passwordLama, $data['customer']['password'])) {
				// Jika password lama salah.
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Password Lama Anda Salah, Coba Lagi!.</div>');
				redirect('auth/gantipass');
			} else {
				if($passwordLama == $passwordBaru1) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Password Baru, Tidak Boleh Sama Dengan Password Lama!.</div>');
					redirect('auth/gantipass');
				} else {
					$passwordHash = password_hash($passwordBaru1, PASSWORD_DEFAULT);

					$this->db->set('password', $passwordHash);
					$this->db->where('username', $this->session->userdata('username'));
					$this->db->update('customer');

					$this->session->set_flashdata('pesan', '<div class="alert alert-success"><i class="fa fa-bell" aria-hidden="true"></i> Password Berhasil Di Ganti.</div>');
					redirect('auth/gantipass');
				}
			} // else
		} // else 
	}

	public function defaultPage()
	{
		if($this->session->userdata('role_id') == 1) {
			redirect('admin/dashboard');
		} else if($this->session->userdata('role_id') == 2) {
			redirect('home');
		}
	}

}