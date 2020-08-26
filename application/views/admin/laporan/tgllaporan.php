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
              </div>
            </div>
          </div>
        </div>
	</section>

</div>