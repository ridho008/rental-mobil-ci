<?php 
// Konfigurasi Pagination MOBIL
$config['base_url'] = 'http://localhost/rental-mobil-ci/admin/mobil/index';
// var_dump($config['total_rows']); die;
$config['num_links'] = 2;

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
$config['cur_tag_close’'] = '</li>';

$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close’'] = '</li>';

$config['attributes'] = array('class' => 'page-link');




?>