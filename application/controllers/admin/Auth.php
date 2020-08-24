<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cek_login();
	}
	
	public function gantipass()
	{
		$data['judul'] = 'Ganti Password';
		$data['customer'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('passlama', 'Password Lama', 'required|trim|min_length[3]', 
		['required' => 'Password Lama Harus Di Isi!']
		);
		$this->form_validation->set_rules('password', 'Password Baru', 'required|trim|matches[password2]|min_length[3]', 
		['required' => 'Password Baru Harus Di Isi!',
		'min_length' => 'Password Minimal 3 Huruf!',
		'matches' => 'Konfirmasi Password Tidak Sama!'
		]
		);
		$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password]', 
		['required' => 'Konfirmasi Password Harus Di Isi!',
		'matches' => 'Konfirmasi Password Tidak Sama!'
		]
		);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates_admin/header', $data);
			$this->load->view('admin/auth/gantipass', $data);
			$this->load->view('themeplates_admin/footer');	
		} else {
			$passwordLama = $this->input->post('passlama', true);
			$passwordBaru1 = $this->input->post('password', true);
			$passwordBaru2 = $this->input->post('password2', true);

			if(!password_verify($passwordLama, $data['customer']['password'])) {
				// Jika password lama salah.
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Password Lama Anda Salah, Coba Lagi!.</div>');
				redirect('admin/auth/gantipass');
			} else {
				if($passwordLama == $passwordBaru1) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Password Baru, Tidak Boleh Sama Dengan Password Lama!.</div>');
					redirect('admin/auth/gantipass');
				} else {
					$passwordHash = password_hash($passwordBaru1, PASSWORD_DEFAULT);

					$this->db->set('password', $passwordHash);
					$this->db->where('username', $this->session->userdata('username'));
					$this->db->update('customer');

					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fa fa-bell" aria-hidden="true"></i> Password Berhasil Di Ganti, <a href="'. base_url('admin/dashboard') .'" class="alert-link">Kembali Ke Dashboard</a>.</div>');
					redirect('admin/auth/gantipass');
				}
			} // else
		} // else 
	}

}