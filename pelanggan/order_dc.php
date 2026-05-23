<?php
require_once('header_pelanggan.php');
$data_dc = query("SELECT * FROM tb_dry_clean");
$data_pelanggan = get_pelanggan($id_pelanggan);

if(isset($_POST['order_dc'])){
	if(order_dc($_POST) > 0){
		echo "<script>
			modalSuccess('Order berhasil dibuat!', 'Success');
			setTimeout(() => { window.location='riwayat_order.php'; }, 1500);
		</script>";
	} else {
		echo "<script>modalError('Order gagal dibuat!', 'Error');</script>";
	}
}
?>

<!-- Clean Order Form Page -->
<main class="container mx-auto px-4 lg:px-8 py-6">
	<!-- Page Header -->
	<div class="flex justify-between items-center mb-6">
		<div>
			<h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">Order Dry Clean</h1>
			<p class="text-sm text-slate-600 dark:text-slate-400">Isi form untuk membuat order</p>
		</div>
		<a href="order_baru.php" class="inline-flex items-center space-x-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
			<i class="fas fa-arrow-left"></i>
			<span>Kembali</span>
		</a>
	</div>

	<!-- Form -->
	<div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-6">
		<form action="" method="post" class="space-y-6">
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
				<!-- Left Column -->
				<div class="space-y-4">
					<div>
						<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
							Nama Pelanggan
						</label>
						<input type="text" name="nama_pel_dc" value="<?= htmlspecialchars($data_pelanggan['nama_lengkap']) ?>" readonly class="w-full px-4 py-2 bg-slate-100 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 cursor-not-allowed">
					</div>

					<div>
						<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
							Nomor Telepon
						</label>
						<input type="text" name="no_telp_dc" value="<?= htmlspecialchars($data_pelanggan['no_telp']) ?>" readonly class="w-full px-4 py-2 bg-slate-100 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 cursor-not-allowed">
					</div>

					<div>
						<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
							Alamat
						</label>
						<textarea name="alamat_dc" rows="4" readonly class="w-full px-4 py-2 bg-slate-100 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 cursor-not-allowed resize-none"><?= htmlspecialchars($data_pelanggan['alamat']) ?></textarea>
					</div>
				</div>

				<!-- Right Column -->
				<div class="space-y-4">
					<div>
						<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
							Pilih Paket <span class="text-red-500">*</span>
						</label>
						<select name="jenis_paket_dc" required class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
							<option value="">-- Pilih Jenis Paket --</option>
							<?php foreach($data_dc as $ck): ?>
								<option value="<?= htmlspecialchars($ck['nama_paket_dc']) ?>">
									<?= htmlspecialchars($ck['nama_paket_dc']) ?> - Rp <?= number_format($ck['tarif_dc'], 0, ',', '.') ?>/Kg (<?= htmlspecialchars($ck['waktu_kerja_dc']) ?>)
						</option>
						<?php endforeach; ?>
					</select>
				</div>

				<div>
					<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Berat (Kg) <span class="text-red-500">*</span>
					</label>
					<input type="number" name="berat_qty_dc" placeholder="Masukkan berat dalam Kg" min="1" required class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
				</div>

				<div>
					<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Tanggal Order Masuk <span class="text-red-500">*</span>
					</label>
					<input type="date" name="tgl_masuk_dc" value="<?= date('Y-m-d') ?>" required class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
				</div>

				<div>
					<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Tanggal Order Keluar (Estimasi) <span class="text-red-500">*</span>
					</label>
					<input type="date" name="tgl_keluar_dc" value="<?= date('Y-m-d', strtotime('+2 days')) ?>" required class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
				</div>

				<div>
					<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Keterangan (Optional)
					</label>
					<textarea name="keterangan_dc" rows="3" placeholder="Contoh: Pisahkan pakaian putih" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all resize-none">-</textarea>
				</div>

				<div>
					<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Metode Pengambilan <span class="text-red-500">*</span>
					</label>
					<select name="metode_pengambilan" required class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
						<option value="Ambil di Tempat">Ambil di Tempat</option>
						<option value="Antar Jemput">Antar Jemput (+ Biaya Ongkir)</option>
					</select>
					<p class="mt-2 text-xs text-slate-500 dark:text-slate-400">
						<i class="fas fa-info-circle mr-1"></i>
						Pilih "Antar Jemput" jika ingin diantar ke alamat Anda
					</p>
				</div>
			</div>
		</div>

		<!-- Form Actions -->
		<div class="flex justify-end space-x-3 pt-6 border-t border-slate-200 dark:border-slate-700">
			<button type="reset" class="px-6 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-lg font-medium hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
				<i class="fas fa-redo mr-2"></i>Reset
			</button>
			<button type="submit" name="order_dc" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors">
				<i class="fas fa-paper-plane mr-2"></i>Pesan Sekarang
			</button>
		</div>
	</form>
</main>

<?php require_once('footer_pelanggan.php'); ?>
