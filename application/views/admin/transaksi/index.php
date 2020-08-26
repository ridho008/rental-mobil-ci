<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><i class="fas fa-random"></i> <?= $judul; ?></h1>
    </div>
    <div class="section-body">
      <h2 class="section-title">Semua <?= $judul; ?></h2>
	      <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Transaksi</h4>
              </div>
              <!-- Kolom Pencarian -->
              <div class="row">
                <div class="col-md-4 ml-4">
                  <form action="<?= base_url('admin/transaksi'); ?>" method="post">
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
                <h6 class="text-muted">Total <?= $total_rows; ?> Transaksi</h6>
                <div class="table-responsive">
                  <table class="table table-bordered table-md">
                    <tr>
                      <th>#</th>
                      <th>Nama Customer</th>
                      <th>Mobil</th>
                      <th>Tanggal Rental</th>
                      <th>Tanggal Kembali</th>
                      <th>Harga Sewa / Hari</th>
                      <th>Denda / Hari</th>
                      <th>Total Denda</th>
                      <th>Tanggal Pengembalian</th>
                      <th>Status Pengembalian</th>
                      <th>Status Rental</th>
                      <th>Cek Pembayaran</th>
                      <th>Aksi</th>
                    </tr>
                    <?php foreach($transaksi as $t) : ?>
                      <tr>
                        <td><?= ++$start; ?></td>
                        <td><?= $t['nama']; ?></td>
                        <td><?= $t['merk']; ?></td>
                        <td><?= date('d/m/Y', strtotime($t['tgl_rental'])); ?></td>
                        <td><?= date('d/m/Y', strtotime($t['tgl_kembali'])); ?></td>
                        <td>Rp.<?= number_format($t['harga_mobil'], 0, ',', '.'); ?></td>
                        <td>Rp.<?= number_format($t['denda'], 0, ',', '.'); ?></td>
                        <td>Rp.<?= number_format($t['total_denda'], 0, ',', '.'); ?></td>
                        <td>
                          <?php if($t['tgl_penggembalian'] == '0000-00-00') : ?>
                            <p>-</p>
                            <?php else : ?>
                              <?= date('d-m-Y', strtotime($t['tgl_penggembalian'])); ?>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if($t['status'] == '1') : ?>
                            <span class="badge badge-primary">Kembali</span>
                            <?php else: ?>
                              <span class="badge badge-warning">Belum Kembali</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if($t['status'] == '1') : ?>
                            <span class="badge badge-primary">Kembali</span>
                            <?php else: ?>
                              <span class="badge badge-warning">Belum Kembali</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if(empty($t['bukti_pembayaran'])) : ?>
                            <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Bukti Belum Di Kirim"><i class="fa fa-times-circle"></i></button>
                            <?php else: ?>
                              <a href="<?= base_url('admin/transaksi/pembayaran/') . $t['id_rental']; ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Bukti Terkirim"><i class="fa fa-check-circle"></i></a>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if($t['status'] == '1') : ?>
                            <!-- <p>-</p> -->
                            <span class="badge badge-success">Transaksi Selesai</span>
                            <?php else : ?>
                              <a href="<?= base_url('admin/transaksi/transaksiSelesai/') . $t['id_rental']; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Transaksi Selesai"><i class="fas fa-check"></i></a>
                              <a href="<?= base_url('admin/transaksi/batal/') . $t['id_rental']; ?>" onclick="return confirm('Yakin ?')" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Batal Transaksi"><i class="fas fa-times"></i></a>
                          <?php endif; ?>
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