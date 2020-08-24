<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {
	public function getMobilTypeJoin($id)
	{
		$this->db->select('*');
		$this->db->from('mobil');
		$this->db->join('type', 'type.id_type = mobil.kode_type');
		$this->db->where('id_type', $id);
		return $this->db->get_where()->result_array();
	}

}