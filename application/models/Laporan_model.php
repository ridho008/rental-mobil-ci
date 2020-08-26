<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
	public function tampilLaporanPerTgl()
	{
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
		$this->db->join('customer', 'customer.id_customer = transaksi.id_customer');
		$this->db->where('transaksi.tgl_rental >=', $dari);
		$this->db->where('transaksi.tgl_rental <=', $sampai);
		return $this->db->get()->result_array();
	}

	public function printTransaksi()
	{
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');

		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
		$this->db->join('customer', 'customer.id_customer = transaksi.id_customer');
		$this->db->where('transaksi.tgl_rental >=', $dari);
		$this->db->where('transaksi.tgl_rental <=', $sampai);
		return $this->db->get()->result_array();
	}

}