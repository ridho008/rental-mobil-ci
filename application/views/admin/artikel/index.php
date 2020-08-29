<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><i class="fas fa-list"></i> <?= $judul; ?></h1>
    </div>
    <div class="section-body">
      <h2 class="section-title">Semua <?= $judul; ?></h2>
      <p class="section-lead">Berbagai <?= $judul; ?> yang tersedia.</p>
	      <div class="row">
          <div class="col-12 col-md-12 col-lg-12">
            <button type="button" class="btn btn-primary mb-4 tombolTambahArtikel" data-toggle="modal" data-target="#formModalTambahArtikel">
              Tambah Data Artikel
            </button>
            <?php if(validation_errors()) : ?>
              <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
            <?php endif; ?>
	      	<!-- <a href="<?= base_url('admin/artikel/tambahArtikel'); ?>" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah Data Artikel</a> -->
            <div class="card">
              <div class="card-header">
                <h4>Artikel</h4>
              </div>
              <!-- Kolom Pencarian -->
              <div class="row">
                <div class="col-md-4 ml-4">
                  <form action="<?= base_url('admin/artikel'); ?>" method="post">
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
                <h6 class="text-muted">Total <?= $total_rows; ?> Mobil</h6>
                <div class="table-responsive">
                  <table class="table table-bordered table-md">
                    <tr>
                      <th>#</th>
                      <th>Gambar</th>
                      <th>Judul</th>
                      <th>Deskripsi</th>
                      <th>Kategori</th>
                      <th>Tanggal Post</th>
                      <th>Di Posting</th>
                      <th>Terbit</th>
                    </tr>
                    <?php if(empty($artikel)) : ?>
                      <tr>
                        <td colspan="8">
                          <div class="alert alert-danger text-center" role="alert">Data Arikel Masih Kosong.</div>
                        </td>
                      </tr>
                    <?php endif; ?>
                    <?php 
                    $no = 1;
                    foreach($artikel as $a) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td>
                        <img src="<?= base_url('assets/berita/') . $a['foto_berita']; ?>" width="80">           
                      </td>
											<td><?= $a['judul_berita']; ?></td>
											<td><?= substr($a['deskripsi'], 0, 20) . "..."; ?></td>
											<td><?= $a['nama_kategori']; ?></td>
                      <td><?= $a['tgl_post']; ?></td>
                      <td><?= $a['updateby']; ?></td>
                      <td>
                        <?php if($a['terbit'] == '0') : ?>
                          <a href="<?= base_url('admin/artikel/review/') . $a['id_berita']; ?>" target="_blank" class="btn btn-info"><i class="fas fa-eye"></i> Review</a>
                          <?php else: ?>
                            <span class="badge badge-success btn-sm" data-toggle="tooltip" data-placement="top" title="Sudah Di Publikasi"><i class="fas fa-check"></i></span>
                            <a href="<?= base_url('admin/artikel/review/') . $a['id_berita']; ?>" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <?php endif; ?>
                      </td>
                      <td>
                        <button type="button" class="btn btn-primary formModalUbah" data-toggle="modal" data-target="#formModalTambahArtikel" data-id="<?= $a['id_berita']; ?>"><i class="fas fa-edit"></i></button>
                        <a href="<?= base_url('admin/artikel/hapus/') . $a['id_berita']; ?>" onclick="return confirm('Yakin ?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </td>
										</tr>
                    <?php endforeach; ?>
                  </table>
                </div>
                <div class="card-footer text-right">
                  <?php echo $this->pagination->create_links(); ?> 
                  </div>
              </div>
            </div>
          </div>
        </div>
	</section>

</div>

<!-- Button trigger modal -->


<!-- Modal Tambah Berita -->
<div class="modal fade" id="formModalTambahArtikel" tabindex="-1" aria-labelledby="formArtikelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formArtikelModalLabel">Tambah Artikel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" enctype="multipart/form-data" method="post">
          <input type="text" name="id_berita" id="id_berita">
          <div class="form-group">
            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" class="form-control">
              <option value="">Pilih Kategori</option>
              <?php foreach($kategori as $k) : ?>
                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
              <?php endforeach; ?>
              <small class="muted text-danger"><?= form_error('kategori'); ?></small>
            </select>
          </div>
          <div class="form-group">
            <label for="judul">Judul Artikel</label>
            <input type="text" name="judul" id="judul" class="form-control">
            <small class="muted text-danger"><?= form_error('judul'); ?></small>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
            <small class="muted text-danger"><?= form_error('deskripsi'); ?></small>
          </div>
          <div class="form-group">
            <label for="foto">Gambar</label><br>
            <img src="" id="tampilFoto" width="80">
            <input type="file" name="foto" id="foto" class="form-control">
            <input type="text" name="inputfoto" id="inputfoto" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  CKEDITOR.replace('editor1');
</script>