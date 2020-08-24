<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail Mobil <i class="text-primary"><?= $mobil['merk']; ?></i></h1>
    </div>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="text-primary"><?= $mobil['merk']; ?></h3>
          </div>
          <div class="row">
            <div class="col-md-6 col-lg-6">
              <div class="card-body">
                <img src="<?= base_url('assets/assets_stisla/img/mobil/') . $mobil['gambar']; ?>" alt="<?= $mobil['merk']; ?>" class="img-thumbnail">
                <div class="card card-primary mt-4">
                  <div class="card-header">
                    <h4>Fasilitas</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-md" id="sortable-table">
                        <thead>
                          <tr>
                            <th>AC</th>
                            <th>
                              <?php if($mobil['ac'] == 1) : ?>
                                <div class="badge badge-success">Tersedia</div>
                              <?php else : ?>
                                <div class="badge badge-danger">Tidak Tersedia</div>
                              <?php endif; ?>
                            </th>
                          </tr>
                          <tr>
                            <th>Supir</th>
                            <th>
                              <?php if($mobil['supir'] == 1) : ?>
                                <div class="badge badge-success">Tersedia</div>
                              <?php else : ?>
                                <div class="badge badge-danger">Tidak Tersedia</div>
                              <?php endif; ?>
                            </th>
                          </tr>
                          <tr>
                            <th>MP3 Player</th>
                            <th>
                              <?php if($mobil['mp3_player'] == 1) : ?>
                                <div class="badge badge-success">Tersedia</div>
                              <?php else : ?>
                                <div class="badge badge-danger">Tidak Tersedia</div>
                              <?php endif; ?>
                            </th>
                          </tr>
                          <tr>
                            <th>Central Lock</th>
                            <th>
                              <?php if($mobil['central_lock'] == 1) : ?>
                                <div class="badge badge-success">Tersedia</div>
                              <?php else : ?>
                                <div class="badge badge-danger">Tidak Tersedia</div>
                              <?php endif; ?>
                            </th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6">
              <h4>Spesifikasi <?= $mobil['merk']; ?></h4>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-md" id="sortable-table">
                    <thead>
                      <tr>
                        <td><b>Type Mobil</b></td>
                        <td><?= $mobil['kode_type']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Merk Mobil</b></td>
                        <td><?= $mobil['merk']; ?></td>
                      </tr>
                      <tr>
                        <td><b>No.Plat</b></td>
                        <td><?= $mobil['no_plat']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Warna</b></td>
                        <td><?= $mobil['warna']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Harga Sewa</b></td>
                        <td>Rp.<?= number_format($mobil['harga_mobil'], 0, ',', '.'); ?></td>
                      </tr>
                      <tr>
                        <td><b>Denda</b></td>
                        <td>Rp.<?= number_format($mobil['denda'], 0, ',', '.'); ?></td>
                      </tr>
                      <tr>
                        <td><b>Tahun</b></td>
                        <td><?= $mobil['tahun']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Status</b></td>
                        <td>
                          <?php if($mobil['status'] == 1) : ?>
                            <div class="badge badge-success">Tersedia</div>
                          <?php else : ?>
                            <div class="badge badge-danger">Tidak Tersedia</div>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <tr>
                        <td><a href="<?= base_url('admin/mobil/editMobil/') . $mobil['id_mobil']; ?>" class="btn btn-outline-info">Edit Data <?= $mobil['merk']; ?></a></td>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
	</section>

</div>