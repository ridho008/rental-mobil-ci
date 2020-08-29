<!-- Page Content -->
<div class="container">

  <div class="row">

    <div class="col-lg-3">
      <h4 class="mt-4 list-group-item list-group-item-action bg-warning text-black-10 text-center">Tipe Mobil</h4>
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
        <h4 class="mt-4 list-group-item list-group-item-action bg-warning text-black-50 ml-3">Kategori Artikel</h4>
          <?php if(empty($berita)) : ?>
            <div class="col-lg-12 col-md-12 mb-5">
              <div class="alert alert-danger" role="alert">Kategori <b>Berita</b> Tidak Ditemukan.</div>
            </div>
          <?php endif; ?>
        <?php foreach($berita as $b) : ?>
        <div class="col-lg-4 col-md-6 mb-5">
          <div class="card h-100">
            <a href="<?= base_url('artikel/baca/') . $b['id_berita']; ?>"><img class="card-img-top" src="<?= base_url('assets/berita/') . $b['foto_berita']; ?>" alt="<?= $b['judul_berita']; ?>"></a>
            <div class="card-body">
              <h4 class="card-title mb-0">
                <a href="<?= base_url('artikel/baca/') . $b['id_berita']; ?>" class="text-secondary"><?= $b['judul_berita']; ?></a>
              </h4>
              <a href="<?= base_url('artikel/kategori/') . $b['id_kategori']; ?>" class="badge badge-dark"><?= $b['nama_kategori']; ?></a>
              <h6><?= substr($b['deskripsi'], 0,100); ?> ...</h6>
              <!-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p> -->
            </div>
            <div class="card-footer">
              <!-- <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small> -->
            </div>
          </div>
        </div>
      <?php endforeach; ?>

        

      </div>
      <!-- /.row -->

    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

</div>
<!-- /.container -->




