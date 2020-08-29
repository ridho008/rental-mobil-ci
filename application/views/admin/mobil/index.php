<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><i class="fas fa-car"></i> Data Mobil</h1>
    </div>
    <div class="section-body">
      <h2 class="section-title">Semua Data Mobil</h2>
      <p class="section-lead">Berbagai merek mobil yang tersedia.</p>
	      <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
	      	<a href="<?= base_url('admin/mobil/tambahMobil'); ?>" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah Data Mobil</a>
            <div class="card">
              <div class="card-header">
                <h4>Mobil</h4>
              </div>
              <!-- Kolom Pencarian -->
              <div class="row">
                <div class="col-md-4 ml-4">
                  <form action="<?= base_url('admin/mobil'); ?>" method="post">
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
                <h6 class="text-muted">Total <?= $total_rows; ?> Mobil</h6>
                <div class="table-responsive">
                  <table class="table table-bordered table-md">
                    <tr>
                      <th>#</th>
                      <th>Gambar</th>
                      <th>Type</th>
                      <th>Merk</th>
                      <th>No.Plat</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                    <?php if(empty($mobil)) : ?>
                      <tr>
                        <td colspan="7">
                          <div class="alert alert-danger text-center" role="alert">Data Tidak Ditemukan.</div>
                        </td>
                      </tr>
                    <?php endif; ?>
                    <?php 
                    $no = 1;
                    foreach($mobil as $m) : ?>
										<tr>
											<td><?= ++$start; ?></td>
											<td>
                        <img src="<?= base_url('assets/assets_stisla/img/mobil/') . $m['gambar']; ?>" alt="<?= $m['merk']; ?>" width="80">           
                      </td>
											<td><?= $m['nama_type']; ?></td>
											<td><?= $m['merk']; ?></td>
											<td><?= $m['no_plat']; ?></td>
											<td>
											<?php if($m['status'] == 1) : ?>
												<div class="badge badge-success">Tersedia</div>
											<?php else : ?>
												<div class="badge badge-danger">Tidak Tersedia</div>
											<?php endif; ?>
											</td>
											<td>
												<a href="<?= base_url('admin/mobil/detailMobil/') . $m['id_mobil']; ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
												<a href="<?= base_url('admin/mobil/editMobil/') . $m['id_mobil']; ?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
												<a href="<?= base_url('admin/mobil/hapusMobil/') . $m['id_mobil']; ?>" onclick="return confirm('Yakin ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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