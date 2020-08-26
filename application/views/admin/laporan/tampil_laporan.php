<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><i class="fas fa-clipboard"></i> Data <?= $judul; ?></h1>
    </div>
    <div class="section-body">
	      <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4><?= $judul; ?></h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <?= $this->session->flashdata('pesan'); ?>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                  <form action="" method="post">
                      <div class="form-group">
                        <label for="dari">Dari Tanggal</label>
                        <input type="date" name="dari" id="dari" class="form-control">
                        <small class="muted text-danger"><?= form_error('dari'); ?></small>
                      </div>
                        
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="sampai">Sampai Tanggal</label>
                          <input type="date" name="sampai" id="sampai" class="form-control">
                          <small class="muted text-danger"><?= form_error('sampai'); ?></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-4"><i class="fas fa-eye"></i> Tampilkan</button>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <a href="<?= base_url('admin/laporan/print/?dari=') . set_value('dari') . '&sampai=' . set_value('sampai'); ?>" target="_blank" class="btn btn-outline-info mb-2"><i class="fas fa-print"></i> Print</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-1">
                    <p>Laporan Dari Tanggal <strong><?= date('d-m-Y', strtotime(set_value('dari'))); ?></strong></p>
                    <p>Laporan Sampai Tanggal <strong><?= date('d-m-Y', strtotime(set_value('sampai'))); ?></strong></p>
                  </div>
                  
                </div>
                <!-- table -->
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
                    </tr>
                    <?php $no = 1; foreach($laporan as $l) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $l['nama']; ?></td>
                        <td><?= $l['merk']; ?></td>
                        <td><?= date('d/m/Y', strtotime($l['tgl_rental'])); ?></td>
                        <td><?= date('d/m/Y', strtotime($l['tgl_kembali'])); ?></td>
                        <td>Rp.<?= number_format($l['harga_mobil'], 0, ',', '.'); ?></td>
                        <td>Rp.<?= number_format($l['denda'], 0, ',', '.'); ?></td>
                        <td>Rp.<?= number_format($l['total_denda'], 0, ',', '.'); ?></td>
                        <td>
                          <?php if($l['tgl_penggembalian'] == '0000-00-00') : ?>
                            <p>-</p>
                            <?php else : ?>
                              <?= date('d-m-Y', strtotime($l['tgl_penggembalian'])); ?>
                          <?php endif; ?>
                        </td>
                        <td><?= $l['status_penggembalian']; ?></td>
                        <td><?= $l['status_rental']; ?></td>
                      </tr>
                    <?php endforeach; ?>
                    <?php if(empty($laporan)) : ?>
                      <tr>
                        <td colspan="10">
                          <div class="alert alert-danger" role="alert">Laporan Transaksi Dari <strong><?= date('d-m-Y', strtotime(set_value('dari'))); ?></strong> Dan Sampai <strong><?= date('d-m-Y', strtotime(set_value('sampai'))); ?></strong> Tidak Di Temukan.</div>
                        </td>
                      </tr>
                    <?php endif; ?>
                  </table>
                </div>
                <!-- /table -->
              </div>
            </div>
          </div>
        </div>
	</section>

</div>