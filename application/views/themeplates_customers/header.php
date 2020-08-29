<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $judul; ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url('assets/assets_shop/'); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?= base_url('assets/assets_shop/'); ?>css/shop-homepage.css" rel="stylesheet">
  <link href="<?= base_url('assets/assets_shop/'); ?>css/mystyle.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <script src="<?= base_url('assets/ckeditor/'); ?>ckeditor.js"></script>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url(); ?>">Rental Mobil</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?= base_url(); ?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('artikel'); ?>">Artikel</a>
          </li>
          <?php if($this->session->userdata('role_id') == 2) : ?>
            <?php if($notif == '0') : ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('customer/transaksi'); ?>" class="btn btn-primary">Transaksi <span class="badge badge-light" data-toggle="tooltip" data-placement="bottom" title="<?= $notif; ?> Anda Belum Melakukan Transaksi"><?= $notif; ?></span></a>
              </li>
              <?php else : ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?= base_url('customer/transaksi'); ?>" class="btn btn-primary">Transaksi <span class="badge badge-light" data-toggle="tooltip" data-placement="bottom" title="<?= $notif; ?> Transaksi Belum Di Bayar"><?= $notif; ?></span></a>
                </li>
            <?php endif; ?>
            <!-- <li class="nav-item">
              <a class="nav-link" href="<?= base_url('customer/transaksi'); ?>" class="btn btn-primary">Transaksi <span class="badge badge-light" data-toggle="tooltip" data-placement="bottom" title="<?= $notif; ?> Transaksi Belum Di Bayar"><?= $notif; ?></span></a>
            </li> -->
            <!-- select * from transaksi where status_rental = '0' -->
            <!-- <li class="nav-item">
              <a class="nav-link" href="<?= base_url('customer/transaksi'); ?>">Transaksi</a>
            </li> -->
            <div class="dropdown d-inline">
              <button class="btn btn-outline-light btn-sm dropdown-toggle mt-1" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hi, <?= $customer['nama']; ?>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item has-icon" href="<?= base_url('customer/panel') ?>"><i class="fa fa-user" aria-hidden="true"></i> Akun</a>
                <a class="dropdown-item has-icon" href="auth/gantipass"><i class="fa fa-key" aria-hidden="true"></i> Ganti Password</a>
                <a class="dropdown-item has-icon" href="<?= base_url('home/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
              </div>
            </div>
            <?php else : ?>
              <?php if($this->session->userdata('role_id') == 1) : ?>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="<?= base_url('customer/transaksi'); ?>">Transaksi</a>
                </li> -->
                <?php if($notif == '0') : ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('customer/transaksi'); ?>" class="btn btn-primary">Transaksi <span class="badge badge-light" data-toggle="tooltip" data-placement="bottom" title="<?= $notif; ?> Anda Belum Melakukan Transaksi"><?= $notif; ?></span></a>
                  </li>
                  <?php else : ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?= base_url('customer/transaksi'); ?>" class="btn btn-primary">Transaksi <span class="badge badge-light" data-toggle="tooltip" data-placement="bottom" title="<?= $notif; ?> Transaksi Belum Di Bayar"><?= $notif; ?></span></a>
                    </li>
                <?php endif; ?>
                
                <li class="nav-item d-none">
                  <a class="nav-link" href="<?= base_url('auth/daftar'); ?>">Daftar</a>
                </li>
                <li class="nav-item d-none">
                  <a class="nav-link" href="<?= base_url('auth'); ?>">Login</a>
                </li>
              <?php else : ?>
                <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/daftar'); ?>">Daftar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?= base_url('auth'); ?>">Login</a>
                </li>
              <?php endif; ?>
              
          <?php endif; ?>
          <?php if($this->session->userdata('role_id') == 1) : ?>
            <div class="dropdown d-inline">
              <button class="btn btn-outline-light btn-sm dropdown-toggle mt-1" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hi, <?= $customer['nama']; ?>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item has-icon" href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
                <a class="dropdown-item has-icon" href="admin/auth/gantipass"><i class="fa fa-key" aria-hidden="true"></i> Ganti Password</a>
                <a class="dropdown-item has-icon" href="<?= base_url('auth/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
              </div>
            </div>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>