<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Daftar Customer</h4></div>

              <div class="card-body">
                <form method="post" action="">
                  
                  <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input id="nama" type="text" class="form-control" name="nama" value="<?= set_value('nama'); ?>">
                    <small class="muted text-danger"><?= form_error('nama'); ?></small>
                  </div>

                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" value="<?= set_value('username'); ?>">
                    <small class="muted text-danger"><?= form_error('username'); ?></small>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" name="password">
                      <small class="muted text-danger"><?= form_error('password'); ?></small>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Konfirmasi Password</label>
                      <input id="password2" type="password" class="form-control" name="password2">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="kelamin" class="d-block">Jelamin Kelamin</label>
                    <div class="form-group">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="jk" name="jk" value="L">
                        <label class="form-check-label" for="jk">Pria</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="jk" name="jk" value="P">
                        <label class="form-check-label" for="jk">Perempuan</label>
                      </div>
                    </div>
                    <small class="muted text-danger"><?= form_error('kelamin'); ?></small>
                  </div>

                  <div class="form-group">
                    <label for="ktp">Nomor KTP</label>
                    <input id="ktp" type="text" class="form-control" name="ktp" value="<?= set_value('ktp'); ?>">
                    <small class="muted text-danger"><?= form_error('ktp'); ?></small>
                  </div>

                  <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input id="telepon" type="text" class="form-control" name="telepon" value="<?= set_value('telepon'); ?>">
                    <small class="muted text-danger"><?= form_error('telepon'); ?></small>
                  </div>

                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                    <small class="muted text-danger"><?= form_error('alamat'); ?></small>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Daftar
                    </button>
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