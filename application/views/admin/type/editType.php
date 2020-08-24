<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Data Type</h1>
    </div>
    <div class="section-body">
      <h2 class="section-title">Formulir Edit Data Type</h2>
      <p class="section-lead">Berbagai type mobil yang tersedia.</p>
	      <div class="row">
          <div class="col-6 col-md-6 col-lg-6">
            <form action="" method="post">
              <input type="text" name="id" value="<?= $type['id_type']; ?>">
              <div class="card">
                <div class="card-body">
                    <div class="form-group">
                      <label for="kode_type">Kode Type</label>
                      <input type="text" name="kode_type" class="form-control" value="<?= $type['kode_type']; ?>">
                      <small class="muted text-danger"><?= form_error('kode_type'); ?></small>
                    </div>
                    <div class="form-group">
                      <label for="nama_type">Nama Type</label>
                      <input type="text" name="nama_type" class="form-control" value="<?= $type['nama_type']; ?>">
                      <small class="muted text-danger"><?= form_error('nama_type'); ?></small>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
          </div>
	</section>

</div>