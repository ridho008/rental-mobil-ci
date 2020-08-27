<div class="container mt-5">
	<?php if($review['terbit'] == '0') : ?>
	<h2><?= $review['judul_berita']; ?></h2>
	<div class="row">
		<div class="col-md-2">
			<?php if($review['terbit'] == '0') : ?>
			  <span class="badge badge-success mt-2"><i class="fas fa-eye"></i> Belum Di Publikasikan</span>
			  <?php else: ?>
			    <span class="badge badge-success">Telah Di Post</span>
			<?php endif; ?>
		</div>
		<div class="col-md-2">
		<form action="<?= base_url('admin/artikel/review/') . $review['id_berita']; ?>" method="post">
				<div class="form-group">
					<select name="terbit" id="terbit" class="form-control">
						<option value="">Publikasikan ?</option>
						<option value="1">Ya</option>
						<option value="0">Tidak</option>
						<small class="text-danger"><?= form_error('terbit'); ?></small>
					</select>
				</div>
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-primary mt-1">Simpan</button>
		</div>
		</form>
	</div>
	<form action="<?= base_url('admin/artikel/ubahdeskripsi'); ?>" method="post">
		<input type="hidden" name="id_berita" value="<?= $review['id_berita']; ?>">
		<textarea name="deskripsi" id="editor1" rows="10" cols="80">
		    <?= $review['deskripsi']; ?>
		</textarea>
		<div class="form-group">
			<button type="submit" class="btn btn-info mt-2">Ubah</button>
		</div>
	</form>
	<hr>

<?php endif; ?>

	<div class="row">
		<div class="col-md">
			<div class="card">
				<div class="card-header">
					<h3>Hasil Review  <?= $review['judul_berita']; ?></h3>
				</div>
				<div class="card-body">
					<?= $review['deskripsi']; ?>
				</div>
			</div>
		</div>
	</div>
	
</div>

<script>
	CKEDITOR.replace('editor1');
</script>

