<?php
require_once('header_pelanggan.php');
$data_ck = query("SELECT * FROM tb_cuci_komplit");
$data_pelanggan = get_pelanggan($id_pelanggan);

if(isset($_POST['order_ck'])){
	if(order_ck($_POST) > 0){
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
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<!-- Page Header -->
	<div class="mb-8 flex flex-col gap-4 rounded-[28px] border border-slate-200/80 dark:border-slate-800 bg-white/85 dark:bg-slate-900/75 px-6 py-6 shadow-card backdrop-blur sm:flex-row sm:items-center sm:justify-between lg:px-8">
		<div>
			<h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">Order Cuci Komplit</h1>
			<p class="text-sm text-slate-600 dark:text-slate-400">Isi form untuk membuat order</p>
		</div>
		<a href="order_baru.php" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white/90 dark:bg-slate-900 px-4 py-2.5 text-sm font-medium text-slate-700 shadow-soft transition hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">
			<i class="fas fa-arrow-left"></i>
			<span>Kembali</span>
		</a>
	</div>

	<!-- Form -->
	<div class="rounded-[28px] border border-slate-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 p-6 shadow-card">
		<form action="" method="post" class="space-y-6">
			<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
				<!-- Left Column -->
				<div class="space-y-4">
					<div>
						<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
							Nama Pelanggan
						</label>
						<input type="text" name="nama_pel_ck" value="<?= htmlspecialchars($data_pelanggan['nama_lengkap']) ?>" readonly class="w-full px-4 py-2 bg-slate-100 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 cursor-not-allowed">
					</div>

					<div>
						<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
							Nomor Telepon
						</label>
						<input type="text" name="no_telp_ck" value="<?= htmlspecialchars($data_pelanggan['no_telp']) ?>" readonly class="w-full px-4 py-2 bg-slate-100 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 cursor-not-allowed">
					</div>

					<div>
						<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
							Alamat
						</label>
						<textarea name="alamat_ck" rows="4" readonly class="w-full px-4 py-2 bg-slate-100 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 cursor-not-allowed resize-none"><?= htmlspecialchars($data_pelanggan['alamat']) ?></textarea>
					</div>
				</div>

				<!-- Right Column -->
				<div class="space-y-4">
					<div>
						<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
							Pilih Paket <span class="text-red-500">*</span>
						</label>
						<select name="jenis_paket_ck" required class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
							<option value="">-- Pilih Jenis Paket --</option>
							<?php foreach($data_ck as $ck): ?>
								<option value="<?= htmlspecialchars($ck['nama_paket_ck']) ?>">
									<?= htmlspecialchars($ck['nama_paket_ck']) ?> - Rp <?= number_format($ck['tarif_ck'], 0, ',', '.') ?>/Kg (<?= htmlspecialchars($ck['waktu_kerja_ck']) ?>)
						</option>
						<?php endforeach; ?>
					</select>
				</div>

				<div>
					<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Berat (Kg) <span class="text-red-500">*</span>
					</label>
					<input type="number" name="berat_qty_ck" placeholder="Masukkan berat dalam Kg" min="1" required class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
				</div>

				<div>
					<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Tanggal Order Masuk <span class="text-red-500">*</span>
					</label>
					<input type="date" name="tgl_masuk_ck" value="<?= date('Y-m-d') ?>" required class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
				</div>

				<div>
					<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Tanggal Order Keluar (Estimasi) <span class="text-red-500">*</span>
					</label>
					<input type="date" name="tgl_keluar_ck" value="<?= date('Y-m-d', strtotime('+2 days')) ?>" required class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
				</div>

				<div>
					<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Keterangan (Optional)
					</label>
					<textarea name="keterangan_ck" rows="3" placeholder="Contoh: Pisahkan pakaian putih" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all resize-none">-</textarea>
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
			<div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 dark:border-slate-800 sm:flex-row sm:justify-end">
				<button type="reset" class="inline-flex items-center justify-center rounded-2xl bg-slate-200 px-6 py-2.5 font-medium text-slate-700 transition hover:bg-slate-300 dark:bg-slate-700 dark:text-slate-200 dark:hover:bg-slate-600">
					<i class="fas fa-redo mr-2"></i>Reset
				</button>
				<button type="submit" name="order_ck" class="inline-flex items-center justify-center rounded-2xl bg-primary-600 px-6 py-2.5 font-medium text-white transition hover:bg-primary-700">
					<i class="fas fa-paper-plane mr-2"></i>Pesan Sekarang
				</button>
			</div>
	</form>
</section>

<?php require_once('footer_pelanggan.php'); ?>
