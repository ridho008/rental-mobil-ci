<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><i class="fas fa-users"></i> Data Customer</h1>
    </div>
    <div class="section-body">
	      <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
	      	<a href="<?= base_url('admin/customer/tambahCustomer'); ?>" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah Data Customer</a>
            <div class="card">
              <div class="card-header">
                <h4>Customer</h4>
              </div>
              <!-- Kolom Pencarian -->
              <div class="row">
                <div class="col-md-4 ml-4">
                  <form action="<?= base_url('admin/customer'); ?>" method="post">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Masukan Keyword..." name="keyword" autocomplete="off" autofocus="on">
                      <div class="input-group-append">
                        <input type="submit" name="submit" class="btn btn-primary" value="Cari">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- Kolom Pencarian -->
              <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <?= $this->session->flashdata('pesan'); ?>
                </div>
              </div>
              <h6 class="text-muted">Total <?= $total_rows; ?> Customer</h6>
                <div class="table-responsive">
                  <table class="table table-bordered table-md">
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Alamat</th>
                      <th>Jenis Kelamin</th>
                      <th>Telepon</th>
                      <th>No.KTP</th>
                      <th>Aksi</th>
                    </tr>
                    <?php if(empty($customers)) : ?>
                      <tr>
                        <td colspan="7">
                          <div class="alert alert-danger text-center" role="alert">Data Tidak Ditemukan.</div>
                        </td>
                      </tr>
                    <?php endif; ?>
                    <?php $no = 1; foreach($customers as $c) : ?>
                    <tr>
                      <td><?= ++$start; ?></td>
                      <td><?= $c['nama']; ?></td>
                      <td><?= $c['username']; ?></td>
                      <td><?= $c['alamat']; ?></td>
                      <td><?= $c['kelamin'] == 'L' ? 'Pria' : 'Perempuan'; ?></td>
                      <td><?= $c['telepon']; ?></td>
                      <td><?= $c['no_ktp']; ?></td>
                      <td>
                        <a href="<?= base_url('admin/customer/editCustomer/') . $c['id_customer']; ?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
                        <a href="<?= base_url('admin/customer/hapusCustomer/') . $c['id_customer']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </table>
                </div>
                <div class="card-footer text-right">
                  <?php echo $this->pagination->create_links(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
	</section>

</div>