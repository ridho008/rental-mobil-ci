<div class="container mt-4">
<h3 class="text-center"><?= $judul; ?> Rental Mobil Surya</h3>
<table align="center">
	<tr>
		<td>Dari Tanggal</td>
		<td>:</td>
		<td><?= date('d-M-Y', strtotime($_GET['dari'])); ?></td>
	</tr>
	<tr>
		<td>Sampai Tanggal</td>
		<td>:</td>
		<td><?= date('d-M-Y', strtotime($_GET['sampai'])); ?></td>
	</tr>
</table>

<div class="table-responsive">
  <table class="table table-bordered table-md">
    <tr>
      <th>#</th>
      <th>Nama Customer</th>
      <th>Mobil</th>
      <th>Tanggal Rental</th>
      <th>Tanggal Kembali</th>
      <th>Harga Sewa / Hari</th>
      <th>Denda / Hari</th>
      <th>Total Denda</th>
      <th>Tanggal Pengembalian</th>
      <th>Status Pengembalian</th>
      <th>Status Rental</th>
    </tr>
    <?php $no = 1; foreach($laporan as $l) : ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $l['nama']; ?></td>
        <td><?= $l['merk']; ?></td>
        <td><?= date('d/m/Y', strtotime($l['tgl_rental'])); ?></td>
        <td><?= date('d/m/Y', strtotime($l['tgl_kembali'])); ?></td>
        <td>Rp.<?= number_format($l['harga_mobil'], 0, ',', '.'); ?></td>
        <td>Rp.<?= number_format($l['denda'], 0, ',', '.'); ?></td>
        <td>Rp.<?= number_format($l['total_denda'], 0, ',', '.'); ?></td>
        <td>
          <?php if($l['tgl_penggembalian'] == '0000-00-00') : ?>
            <p>-</p>
            <?php else : ?>
              <?= date('d-m-Y', strtotime($l['tgl_penggembalian'])); ?>
          <?php endif; ?>
        </td>
        <td><?= $l['status_penggembalian']; ?></td>
        <td><?= $l['status_rental']; ?></td>
      </tr>
    <?php endforeach; ?>
    <?php if(empty($laporan)) : ?>
      <tr>
        <td colspan="11">
          <div class="alert alert-danger" role="alert">Laporan Transaksi Dari <strong><?= date('d-m-Y', strtotime(set_value('dari'))); ?></strong> Dan Sampai <strong><?= date('d-m-Y', strtotime(set_value('sampai'))); ?></strong> Tidak Di Temukan.</div>
        </td>
      </tr>
    <?php endif; ?>
  </table>
</div>
</div>

<script>
	window.print();
</script>