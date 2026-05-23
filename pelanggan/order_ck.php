<?php 
require_once('header_pelanggan.php'); 
$data_ck = query("SELECT * FROM tb_cuci_komplit");
$data_pelanggan = get_pelanggan($id_pelanggan);

if(isset($_POST['order_ck'])){
	if(order_ck($_POST) > 0){
		echo "<script>
			alert('Order berhasil dibuat!');
			window.location='riwayat_order.php';
		</script>";
	} else {
		echo "<script>alert('Order gagal dibuat!');</script>";
	}
}
?>

<div id="order_ck" class="main-content">
	<div class="container">
		<div class="baris">
			<div class="col mt-2">
				<div class="card">
					<div class="card-title card-flex">
						<div class="card-col">
							<h2>🧺 Order Cuci Komplit</h2>
						</div>
						<div class="card-col txt-right">
							<a href="order_baru.php" class="btn-xs bg-primary">Kembali</a>
						</div>
					</div>

					<div class="card-body">
						<form action="" method="post">
							<div class="row-input">
								<div class="col-form m-1">
									<div class="form-grup">
										<label for="nama">Nama Pelanggan</label>
										<input type="text" name="nama_pel_ck" value="<?= $data_pelanggan['nama_lengkap'] ?>" readonly style="background: #f0f0f0;">
									</div>

									<div class="form-grup">
										<label for="no-telp">Nomor Telepon</label>
										<input type="text" name="no_telp_ck" value="<?= $data_pelanggan['no_telp'] ?>" readonly style="background: #f0f0f0;">
									</div>

									<div class="form-grup">
										<label for="alamat">Alamat</label>
										<textarea name="alamat_ck" rows="4" readonly style="background: #f0f0f0;"><?= $data_pelanggan['alamat'] ?></textarea>
									</div>
								</div>

								<div class="col-form m-1">
									<div class="form-grup">
										<label for="pilih_paket">Pilih Paket</label>
										<select name="jenis_paket_ck" id="pilih_paket" required>
											<option value="">-- Pilih Jenis Paket --</option>
											<?php foreach($data_ck as $ck): ?>
											<option value="<?= $ck['nama_paket_ck'] ?>">
												<?= $ck['nama_paket_ck'] ?> - Rp <?= number_format($ck['tarif_ck'], 0, ',', '.') ?>/Kg (<?= $ck['waktu_kerja_ck'] ?>)
											</option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="form-grup">
										<label for="kuantitas">Berat (Kg)</label>
										<input type="number" name="berat_qty_ck" placeholder="Berat (Kg)" min="1" required>
									</div>

									<div class="form-grup">
										<label for="tgl_order_msk">Tanggal Order Masuk</label>
										<input type="date" name="tgl_masuk_ck" value="<?= date('Y-m-d') ?>" required>
									</div>

									<div class="form-grup">
										<label for="tgl_order_klr">Tanggal Order Keluar (Estimasi)</label>
										<input type="date" name="tgl_keluar_ck" value="<?= date('Y-m-d', strtotime('+2 days')) ?>" required>
									</div>

									<div class="form-grup">
										<label for="ket">Keterangan (Optional)</label>
										<textarea name="keterangan_ck" rows="4" placeholder="Contoh: Pisahkan pakaian putih">-</textarea>
									</div>

									<div class="form-grup">
										<label for="metode">Metode Pengambilan</label>
										<select name="metode_pengambilan" id="metode" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
											<option value="Ambil di Tempat">🏠 Ambil di Tempat</option>
											<option value="Antar Jemput">🚚 Antar Jemput (+ Biaya Ongkir)</option>
										</select>
										<small style="color: #666;">Pilih "Antar Jemput" jika ingin diantar ke alamat Anda</small>
									</div>
								</div>
							</div>
							
							<div class="form-footer">
								<div class="buttons">
									<button type="submit" name="order_ck" class="btn-sm bg-primary">Pesan Sekarang</button>
									<button type="reset" class="btn-sm bg-transparent">Reset</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer_pelanggan.php'); ?>