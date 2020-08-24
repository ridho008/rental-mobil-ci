<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {
	public function getAll3Table()
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('customer', 'customer.id_customer = transaksi.id_customer');
		$this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
		return $this->db->get()->result_array();
	}

}