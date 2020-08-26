<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental_model extends CI_Model {
	public function aksiTambahRental($id)
	{
		$statusMobil = '0';
		$data = [
				'id_customer' => $this->input->post('id_customer'),
				'id_mobil' => $id,
				'tgl_rental' => $this->input->post('tgl_rental'),
				'tgl_kembali' => $this->input->post('tgl_kembali'),
				'harga' => $this->input->post('harga'),
				'denda' => $this->input->post('denda'),
				'total_denda' => '0',
				'tgl_penggembalian' => '-',
				'status_penggembalian' => 'Belum Kembali',
				'status_rental' => 'Belum Selesai'
		];

		$this->db->set('status', $statusMobil);
		$this->db->where('id_mobil', $id);
		$this->db->update('mobil');
		$this->db->insert('transaksi', $data);
	}

}