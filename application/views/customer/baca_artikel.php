<!-- Page Content -->
<div class="container">

  <div class="row">

    <div class="col-lg-3">
      <h4 class="mt-4 list-group-item list-group-item-action bg-warning text-black-10 text-center">Kategori</h4>
      <div class="list-group">
        <?php foreach($kategori as $k) : ?>
        <a href="<?= base_url('customer/kategori/index/') . $k['id_type']; ?>" class="list-group-item list-group-item-action">
          <?= $k['nama_type']; ?> <span class="badge badge-secondary badge-pill float-right"><i class="fa fa-tag"></i></span>
        </a>

        <?php endforeach; ?>
      </div>
      <!-- <div class="list-group">
        
        <a href="" class="list-group-item"></a>
        
      </div> -->

    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">
      <div class="row">
          <?php if(empty($berita)) : ?>
            <div class="col-lg-12 col-md-12 mb-5">
              <div class="alert alert-danger" role="alert">Kategori <b><?= $kateid['nama_type']; ?></b> Tidak Ditemukan.</div>
            </div>
          <?php endif; ?>
        <div class="col-lg-12 col-md-5 mb-5  mt-4">
          <div class="card">
            <div class="card-header bg-warning">
              <h4><?= $berita['judul_berita']; ?></h4>
            </div>
            <div class="card-body">
              <img src="<?= base_url('assets/berita/') . $berita['foto_berita']; ?>" class="img-fluid img-thumbnail">
              <p class="blockquote-footer mt-1">Penulis : <?= $berita['nama']; ?> | <?= date('d-m-Y', strtotime($berita['tgl_post'])); ?></p>
            <hr>
              <?= $berita['deskripsi']; ?>
            </div>
          </div>


        </div>



        

      </div>
      <!-- /.row -->

    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

</div>
<!-- /.container -->




