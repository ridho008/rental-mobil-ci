<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {
	public function getAll3Table($limit, $start, $keyword = null)
	{
		if($keyword) {
			$this->db->like('nama', $keyword);
			$this->db->or_like('merk', $keyword);
			$this->db->or_like('status_penggembalian', $keyword);
			$this->db->or_like('status_rental', $keyword);
		}
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('customer', 'customer.id_customer = transaksi.id_customer');
		$this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
		$this->db->order_by('transaksi.id_rental', 'DESC');
		return $this->db->get('', $limit, $start)->result_array();
	}

	public function getAllCustomerJoin($id_customer)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('customer', 'customer.id_customer = transaksi.id_customer');
		$this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
		$this->db->where('customer.username', $id_customer);
		$this->db->order_by('transaksi.id_rental', 'DESC');
		// return $this->db->get_where('customer.id_customer', ['customer.id_customer' => $this->session->userdata('id_customer')])->result_array();
		return $this->db->get()->result_array();



		// $id = $customer['id_customer'];
		// $query = "SELECT * FROM transaksi INNER JOIN mobil ON mobil.id_mobil = transaksi.id_mobil INNER JOIN customer ON customer.id_customer = transaksi.id_customer WHERE customer.id_customer = '$id'";
		// return $this->db->query($query)->result_array();
	}

	public function countAllTransaksi()
	{
		return $this->db->get('transaksi')->num_rows();
	}

	public function getAllCustomerPembayaran($id)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil');
		$this->db->join('customer', 'customer.id_customer = transaksi.id_customer');
		$this->db->where('transaksi.id_rental', $id);
		return $this->db->get()->result_array();
	}

	public function uploadBuktiPembayaran()
	{
		$id_rental = $this->input->post('id_rental');
		$uploadBukti = $_FILES['bukti']['name'];

		if($uploadBukti) {
			$config['allowed_types'] = 'gif|png|jpg|pdf';
			$config['max_sizes'] = '2048';
			$config['upload_path'] = './assets/bukti/';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('bukti')) {
				$nameFotoBaru = $this->upload->data('file_name');
				$this->db->set('bukti_pembayaran', $nameFotoBaru);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$this->db->set('bukti_pembayaran', $uploadBukti);
		$this->db->where('id_rental', $id_rental);
		$this->db->update('transaksi');
	}

	public function getTransaksiById($id)
	{
		return $this->db->get_where('transaksi', ['id_rental' => $id])->result_array();
	}

	public function downloadPembayaran($id)
	{
		return $this->db->get_where('transaksi', ['id_rental' => $id])->row_array();
	}

	public function updateTransaksiSelesai()
	{
		$id_rental = $this->input->post('id_rental');
		$id_mobil = $this->input->post('id_mobil');

		$tgl_penggembalian = $this->input->post('tgl_penggembalian');
		$tgl_kembali = $this->input->post('tgl_kembali');
		$denda = $this->input->post('denda');

		$x = strtotime($tgl_penggembalian);
		$y = strtotime($tgl_kembali);
		$selisih = floor(abs($x - $y)/(60*60*24));
		// var_dump($selisih); die;
		$totalDenda = $selisih * $denda;
		// var_dump($totalDenda);

		$this->db->set('status', '1');
		$this->db->where('id_mobil', $id_mobil);
		$this->db->update('mobil');

		$data = [
				'tgl_penggembalian' => $this->input->post('tgl_penggembalian'),
				'status_penggembalian' => $this->input->post('status_penggembalian'),
				'status_rental' => $this->input->post('status_rental'),
				'total_denda' => $totalDenda
		];
		$this->db->where('id_rental', $id_rental);
		$this->db->update('transaksi', $data);
	}
	

}