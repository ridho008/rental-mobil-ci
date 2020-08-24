<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><i class="fas fa-grip-horizontal"></i> Data Type</h1>
    </div>
    <div class="section-body">
      <h2 class="section-title">Semua Data Type</h2>
      <p class="section-lead">Berbagai merek Type yang tersedia.</p>
	      <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
	      	<a href="<?= base_url('admin/type/tambahType'); ?>" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah Data Type</a>
            <div class="card">
              <div class="card-header">
                <h4>Type</h4>
              </div>
              <!-- Kolom Pencarian -->
              <div class="row">
                <div class="col-md-4 ml-4">
                  <form action="<?= base_url('admin/type'); ?>" method="post">
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
              <h6 class="text-muted">Total <?= $total_rows; ?> Type Mobil</h6>
                <div class="table-responsive">
                  <table class="table table-bordered table-md">
                    <tr>
                      <th>No</th>
                      <th>Kode Type</th>
                      <th>Nama Type</th>
                      <th>Aksi</th>
                    </tr>
                    <?php if(empty($type)) : ?>
                      <tr>
                        <td colspan="7">
                          <div class="alert alert-danger text-center" role="alert">Data Tidak Ditemukan.</div>
                        </td>
                      </tr>
                    <?php endif; ?>
                    <?php 
                    $no = 1;
                    foreach($type as $t) : ?>
										<tr>
											<td><?= ++$start; ?></td>
											<td><?= $t['kode_type']; ?></td>
                      <td><?= $t['nama_type']; ?></td>
											<td>
												<a href="<?= base_url('admin/type/editType/') . $t['id_type']; ?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
												<a href="<?= base_url('admin/type/hapusType/') . $t['id_type']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
											</td>
										</tr>
                    <?php endforeach; ?>
                  </table>
                </div>
                <div class="card-footer text-right">
                  <?php echo $this->pagination->create_links(); ?>
                    <!-- <nav class="d-inline-block">
                      <ul class="pagination mb-0">
                        <li class="page-item disabled">
                          <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li class="page-item">
                          <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                      </ul>
                    </nav> -->
                  </div>
              </div>
            </div>
          </div>
        </div>
	</section>

</div>