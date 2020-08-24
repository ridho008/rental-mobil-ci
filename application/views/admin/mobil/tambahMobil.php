<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Tambah Data Mobil</h1>
    </div>
    <div class="section-body">
      <h2 class="section-title">Formulir Tambah Data Mobil</h2>
      <p class="section-lead">Berbagai merek mobil yang tersedia.</p>
	      <div class="row">
          <div class="col-6 col-md-6 col-lg-6">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="card">
              <div class="card-body">
                  <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                      <option value="">-- Pilih Type --</option>
                      <?php foreach($type as $t) : ?>
                      <option value="<?= $t['id_type'] ?>"><?= $t['nama_type']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <small class="muted text-danger"><?= form_error('type'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="merk">Merk</label>
                    <input type="text" name="merk" class="form-control" value="<?= set_value('merk'); ?>">
                    <small class="muted text-danger"><?= form_error('merk'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="no_plat">Nomor Plat</label>
                    <input type="text" name="no_plat" class="form-control" value="<?= set_value('no_plat'); ?>">
                    <small class="muted text-danger"><?= form_error('no_plat'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="warna">Warna</label>
                    <input type="text" name="warna" class="form-control" value="<?= set_value('warna'); ?>">
                    <small class="muted text-danger"><?= form_error('warna'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="harga">Harga Sewa</label>
                    <input type="number" name="harga" class="form-control" value="<?= set_value('harga'); ?>">
                    <small class="muted text-danger"><?= form_error('harga'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="denda">Denda</label>
                    <input type="number" name="denda" class="form-control" value="<?= set_value('denda'); ?>">
                    <small class="muted text-danger"><?= form_error('denda'); ?></small>
                  </div>
              </div>
            </div>
        </div>
          <div class="col-6 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-body">
                  <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="text" name="tahun" class="form-control" value="<?= set_value('tahun'); ?>">
                    <small class="muted text-danger"><?= form_error('tahun'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="">-- Pilih Status --</option>
                      <option value="1">Tersedia</option>
                      <option value="0">Tidak Tersedia</option>
                    </select>
                    <small class="muted text-danger"><?= form_error('status'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar" class="form-control-file">
                    <small class="muted text-danger"><?= form_error('gambar'); ?></small>
                  </div>
                  <div class="card card-primary">
                  <div class="card-header">
                    <h4>Fasilitas</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="ac" class="d-block">AC</label>
                          <div class="form-group">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="ac" name="ac" value="1">
                              <label class="form-check-label" for="ac">Tersedia</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="ac" name="ac" value="0">
                              <label class="form-check-label" for="ac">Tidak Tersedia</label>
                            </div>
                          </div>
                          <small class="muted text-danger"><?= form_error('ac'); ?></small>
                        </div>
                        <div class="form-group">
                          <label for="supir" class="d-block">supir</label>
                          <div class="form-group">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="supir" name="supir" value="1">
                              <label class="form-check-label" for="supir">Tersedia</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="supir" name="supir" value="0">
                              <label class="form-check-label" for="supir">Tidak Tersedia</label>
                            </div>
                          </div>
                          <small class="muted text-danger"><?= form_error('supir'); ?></small>
                        </div>
                      </div> <!-- Col-md6 -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="mp3" class="d-block">MP3 Player</label>
                          <div class="form-group">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="mp3" name="mp3" value="1">
                              <label class="form-check-label" for="mp3">Tersedia</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="mp3" name="mp3" value="0">
                              <label class="form-check-label" for="mp3">Tidak Tersedia</label>
                            </div>
                          </div>
                          <small class="muted text-danger"><?= form_error('mp3'); ?></small>
                        </div>
                        <div class="form-group">
                          <label for="lock" class="d-block">Central Lock</label>
                          <div class="form-group">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="lock" name="lock" value="1">
                              <label class="form-check-label" for="lock">Tersedia</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="lock" name="lock" value="0">
                              <label class="form-check-label" for="lock">Tidak Tersedia</label>
                            </div>
                          </div>
                          <small class="muted text-danger"><?= form_error('lock'); ?></small>
                        </div>
                          </div> <!-- Col-md6 -->
                  </div> 
                  </div>
                </div>
                   <!-- Row -->
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
                  </div>
              </div>
            </div>
          </form>
          </div>
        </div>
	</section>

</div>