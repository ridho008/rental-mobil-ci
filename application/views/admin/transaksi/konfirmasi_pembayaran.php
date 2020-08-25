<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><i class="fas fa-car"></i> <?= $judul; ?></h1>
    </div>
    <div class="section-body">
      <h2 class="section-title">Semua <?= $judul; ?></h2>
	      <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
	      	<a href="<?= base_url('admin/mobil/tambahMobil'); ?>" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah Data Mobil</a>
            <div class="card">
              <div class="card-header">
                <h4>Transaksi Pembayaran</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <?= $this->session->flashdata('pesan'); ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <form action="<?= base_url('admin/transaksi/cek_pembayaran'); ?>" method="post">
                      <?php foreach($pembayaran as $p) : ?>
                       <a href="<?= base_url('admin/transaksi/download/') . $p['id_rental']; ?>" class="btn btn-outline-info" target="_blank"><i class="fa fa-download"></i> Bukti Bayar</a>
                      <?php endforeach; ?>
                      <input type="hidden" name="id_rental" value="<?= $p['id_rental']; ?>">
                      
                    
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                        <div class="control-label">Konfirmasi Pembayaran</div>
                        <label class="custom-switch mt-2">
                          <input type="checkbox" name="status_pembayaran" value="1" class="custom-switch-input">
                          <span class="custom-switch-indicator"></span>
                          <span class="custom-switch-description">Geser/Klik</span>
                        </label>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                  </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
        </div>
	</section>

</div>