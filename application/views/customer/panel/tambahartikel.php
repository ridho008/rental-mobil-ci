<div class="container mt-5 py-5">
	<h2><?= $judul; ?></h2>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-3">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="judul">Judul Artikel</label>
							<input type="text" name="judul" id="judul" class="form-control">
							<small class="muted text-danger"><?= form_error('judul'); ?></small>
						</div>
						
				</div>
				<div class="col-md-3">
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
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="foto">Foto</label>
						<input type="file" name="foto" id="foto" class="form-control-file">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<button type="submit" class="btn btn-primary mt-4">Simpan</button>
					</div>
				</div>
				
		</div>
		<div class="row">
			<div class="col-md">
				<textarea name="deskripsi" id="editor1" rows="10" cols="80"></textarea>
				<small class="muted text-danger"><?= form_error('deskripsi'); ?></small>
			</div>
		</div>
		</form>
	</div>
			</div>
</div>

<script>
	CKEDITOR.replace('editor1');
</script>

