<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><i class="fas fa-university"></i> <?= $judul; ?></h1>
    </div>
    <div class="section-body">
	      <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <button type="button" class="btn btn-primary mb-4 tombolTambahBank" data-toggle="modal" data-target="#formModalBank"><i class="fas fa-plus-circle"></i> Tambah Data Bank
            </button>
            <div class="card">
              <div class="card-header">
                <h4>Bank</h4>
              </div>
              <!-- Kolom Pencarian -->
              <div class="row">
                <div class="col-md-4 ml-4">
                  <form action="<?= base_url('admin/bank'); ?>" method="post">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Masukan Keyword..." name="keyword" autocomplete="off" autofocus="on">
                      <div class="input-group-append">
                        <input type="submit" name="submit" class="btn btn-primary" value="Cari">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- Kolom Pencarian -->
              <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <?= $this->session->flashdata('pesan'); ?>
                </div>
              </div>
                <div class="table-responsive">
                  <table class="table table-bordered table-md">
                    <tr>
                      <th>#</th>
                      <th>Bank</th>
                      <th>No.Rekening</th>
                      <th>Aksi</th>
                    </tr>
                    <?php if(empty($bank)) : ?>
                      <tr>
                        <td colspan="7">
                          <div class="alert alert-danger text-center" role="alert">Data Kosong.</div>
                        </td>
                      </tr>
                    <?php endif; ?>
                    <?php foreach($bank as $b) : ?>
                    <tr>
                      <td><?= ++$start; ?></td>
                      <td><?= $b['nama_rek']; ?></td>
                      <td><?= $b['no_rek']; ?></td>
                      <td>
                        <button type="button" class="btn btn-primary tombolUbahBank" data-toggle="modal" data-target="#formModalBank" data-id="<?= $b['id_bank']; ?>"><i class="fas fa-edit"></i></button>
                        <a href="<?= base_url('admin/bank/hapus/') . $b['id_bank']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ?')"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </table>
                </div>
                <div class="card-footer text-right">
                  <?= $this->pagination->create_links(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
	</section>

</div>

<div class="modal fade" id="formModalBank" tabindex="-1" aria-labelledby="formBankModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formBankModalLabel">Tambah Data Bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <input type="hidden" name="id_bank" id="id_bank">
          <div class="form-group">
            <label for="nama">Nama Bank</label>
            <input type="text" name="nama" id="nama" class="form-control">
            <small class="muted text-danger"><?= form_error('nama'); ?></small>
          </div>
          <div class="form-group">
            <label for="no">No.Rekening</label>
            <input type="number" name="no" id="no" class="form-control">
            <small class="muted text-danger"><?= form_error('no'); ?></small>
          </div>
          <div class="form-group tombolUbah">
            <button class="btn btn-primary" type="submit">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>