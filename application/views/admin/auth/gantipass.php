<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Ganti Password</h4></div>

              <div class="card-body">
                <?= $this->session->userdata('pesan'); ?>
                <form method="post" action="">
                  <div class="form-group">
                    <label for="passlama">Password Lama</label>
                    <input id="passlama" type="password" class="form-control" name="passlama" tabindex="1" autofocus>
                    <small class="muted text-danger"><?= form_error('passlama'); ?></small>
                  </div>

                  <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" tabindex="2">
                    <small class="muted text-danger"><?= form_error('password'); ?></small>
                  </div>

                  <div class="form-group">
                    <label for="password-confirm">Konformasi Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password2" tabindex="2" required>
                    <small class="muted text-danger"><?= form_error('password2'); ?></small>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Ganti Password
                    </button>
                    <a href="<?= base_url('admin/dashboard'); ?>" class="btn btn-danger btn-lg btn-block">Batal</a>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Stisla 2018
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>