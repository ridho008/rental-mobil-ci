<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Data Customer</h1>
    </div>
    <div class="section-body">
	      <div class="row">
          <div class="col-6 col-md-6 col-lg-6">
          <form action="" method="post">
            <input type="hidden" name="id" value="<?= $customer['id_customer']; ?>">
            <div class="card">
              <div class="card-body">
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $customer['nama']; ?>">
                    <small class="muted text-danger"><?= form_error('nama'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $customer['username']; ?>" readonly="on">
                    <small class="muted text-danger"><?= form_error('username'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" value="<?= $customer['password']; ?>">
                    <small class="muted text-danger"><?= form_error('password'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control"><?= $customer['alamat']; ?></textarea>
                    <small class="muted text-danger"><?= form_error('alamat'); ?></small>
                  </div>
              </div>
            </div>
        </div>
          <div class="col-6 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-body">
                  <div class="form-group">
                    <label for="kelamin" class="d-block">Jelamin Kelamin</label>
                    <div class="form-group">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="jk" name="jk" value="L" <?php if($customer['kelamin'] == 'L'){echo "checked";} ?>>
                        <label class="form-check-label" for="jk">Pria</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="jk" name="jk" value="P" <?php if($customer['kelamin'] == 'P'){echo "checked";} ?>>
                        <label class="form-check-label" for="jk">Perempuan</label>
                      </div>
                    </div>
                    <small class="muted text-danger"><?= form_error('kelamin'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="<?= $customer['telepon']; ?>">
                    <small class="muted text-danger"><?= form_error('telepon'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="ktp">No.KTP</label>
                    <input type="text" name="ktp" class="form-control" value="<?= $customer['no_ktp']; ?>">
                    <small class="muted text-danger"><?= form_error('ktp'); ?></small>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
                  </div>
              </div>
            </div>
          </form>
          </div>
	</section>

</div>