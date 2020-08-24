<?php 
function cek_login()
{
	$ci = get_instance();
	if(!$ci->session->userdata('username')) {
		redirect('auth');
	} else {
		// kalau udh login & cek role_id nya apa ? 1 atau 2 ?
		$role_id = $ci->session->userdata('role_id');
		// ambil url
		$menu = $ci->uri->segment(2);

		// $query = $ci->db->get_where('customer', ['id_customer' => $menu])
		if($role_id == '2') {
			redirect('home');
		}
	}
}

?>