<?php 
require_once('header_pelanggan.php'); 
$data_cs = query("SELECT * FROM tb_cuci_satuan");
$data_pelanggan = get_pelanggan($id_pelanggan);

if(isset($_POST['order_cs'])){
	if(order_cs($_POST) > 0){
		echo "<script>
			alert('Order berhasil dibuat!');
			window.location='riwayat_order.php';
		</script>";
	} else {
		echo "<script>alert('Order gagal dibuat!');</script>";
	}
}
?>

<div id="order_cs" class="main-content">
	<div class="container">
		<div class="baris">
			<div class="col mt-2">
				<div class="card">
					<div class="card-title card-flex">
						<div class="card-col">
							<h2>👕 Order Cuci Satuan</h2>
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
										<input type="text" name="nama_pel_cs" value="<?= $data_pelanggan['nama_lengkap'] ?>" readonly style="background: #f0f0f0;">
									</div>

									<div class="form-grup">
										<label for="no-telp">Nomor Telepon</label>
										<input type="text" name="no_telp_cs" value="<?= $data_pelanggan['no_telp'] ?>" readonly style="background: #f0f0f0;">
									</div>

									<div class="form-grup">
										<label for="alamat">Alamat</label>
										<textarea name="alamat_cs" rows="4" readonly style="background: #f0f0f0;"><?= $data_pelanggan['alamat'] ?></textarea>
									</div>
								</div>

								<div class="col-form m-1">
									<div class="form-grup">
										<label for="pilih_paket">Pilih Jenis Item</label>
										<select name="jenis_paket_cs" id="pilih_paket" required>
											<option value="">-- Pilih Jenis Item --</option>
											<?php foreach($data_cs as $cs): ?>
											<option value="<?= $cs['nama_cs'] ?>">
												<?= $cs['nama_cs'] ?> - Rp <?= number_format($cs['tarif_cs'], 0, ',', '.') ?>/Pcs (<?= $cs['waktu_kerja_cs'] ?>)
											</option>
											<?php endforeach; ?>
										</select>
									</div>

									<div class="form-grup">
										<label for="kuantitas">Jumlah (Pcs)</label>
										<input type="number" name="jml_pcs" placeholder="Jumlah item" min="1" required>
									</div>

									<div class="form-grup">
										<label for="tgl_order_msk">Tanggal Order Masuk</label>
										<input type="date" name="tgl_masuk_cs" value="<?= date('Y-m-d') ?>" required>
									</div>

									<div class="form-grup">
										<label for="tgl_order_klr">Tanggal Order Keluar (Estimasi)</label>
										<input type="date" name="tgl_keluar_cs" value="<?= date('Y-m-d', strtotime('+1 days')) ?>" required>
									</div>

									<div class="form-grup">
										<label for="ket">Keterangan (Optional)</label>
										<textarea name="keterangan_cs" rows="4" placeholder="Catatan tambahan">-</textarea>
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
									<button type="submit" name="order_cs" class="btn-sm bg-primary">Pesan Sekarang</button>
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