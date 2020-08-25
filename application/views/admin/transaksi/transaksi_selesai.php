<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><i class="fas fa-car"></i> <?= $judul; ?></h1>
    </div>
    <div class="section-body">
	      <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>Transaksi Selesai</h4>
              </div>
              <div class="card-body">
                <form action="" method="post">
                  <?php foreach($transaksi as $t) : ?>
                    <input type="hidden" name="id_rental" value="<?= $t['id_rental']; ?>">
                    <input type="hidden" name="tgl_kembali" value="<?= $t['tgl_kembali']; ?>">
                    <input type="hidden" name="denda" value="<?= $t['denda']; ?>">
                    <div class="form-group">
                      <label for="tgl_penggembalian">Tanggal Penggembalian</label>
                      <input type="date" name="tgl_penggembalian" id="tgl_penggembalian" class="form-control" value="<?= $t['tgl_penggembalian']; ?>">
                      <small class="muted text-danger"><?= form_error('tgl_penggembalian'); ?></small>
                    </div>
                    <div class="form-group">
                      <label for="status_penggembalian">Tanggal Penggembalian</label>
                      <select name="status_penggembalian" id="status_penggembalian" class="form-control">
                        <option value="">Pilih Status Penggembalian</option>
                        <option value="Kembali" <?php if($t['status_penggembalian'] == 'Kembali'){echo "selected";} ?>>Kembali</option>
                        <option value="Belum Kembali" <?php if($t['status_penggembalian'] == 'Belum Kembali'){echo "selected";} ?>>Belum Kembali</option>
                      </select>
                      <small class="muted text-danger"><?= form_error('status_penggembalian'); ?></small>
                    </div>
                    <div class="form-group">
                      <label for="status_rental">Status Rental</label>
                      <select name="status_rental" id="status_rental" class="form-control">
                        <option value="">Pilih Status Penggembalian</option>
                        <option value="Selesai" <?php if($t['status_rental'] == 'Selesai'){echo "selected";} ?>>Selesai</option>
                        <option value="Belum Selesai" <?php if($t['status_rental'] == 'Belum Selesai'){echo "selected";} ?>>Belum Selesai</option>
                      </select>
                      <small class="muted text-danger"><?= form_error('status_rental'); ?></small>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  <?php endforeach; ?>
                </form>
              </div>
            </div>
          </div>
        </div>
	</section>

</div>