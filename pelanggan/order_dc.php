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

<!-- Main Content with Tailwind -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<div class="bg-white rounded-xl shadow-lg overflow-hidden">
		<!-- Header -->
		<div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-primary-50 to-secondary-50">
			<h2 class="text-2xl font-bold text-gray-900 flex items-center">
				<i class="fas fa-wind text-primary-600 mr-3"></i>
				Order Dry Clean
			</h2>
			<a href="order_baru.php" class="inline-flex items-center space-x-2 px-4 py-2 bg-white text-primary-600 rounded-lg font-semibold shadow hover:shadow-md transition-all hover:scale-105">
				<i class="fas fa-arrow-left"></i>
				<span>Kembali</span>
			</a>
		</div>

		<!-- Form -->
		<div class="p-8">
			<form action="" method="post" class="space-y-6">
				<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
					<!-- Left Column -->
					<div class="space-y-4">
						<div>
							<label class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-user text-gray-400 mr-2"></i>Nama Pelanggan
							</label>
							<input type="text" name="nama_pel_dc" value="<?= htmlspecialchars($data_pelanggan['nama_lengkap']) ?>" readonly class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 cursor-not-allowed">
						</div>

						<div>
							<label class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-phone text-gray-400 mr-2"></i>Nomor Telepon
							</label>
							<input type="text" name="no_telp_dc" value="<?= htmlspecialchars($data_pelanggan['no_telp']) ?>" readonly class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 cursor-not-allowed">
						</div>

						<div>
							<label class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>Alamat
							</label>
							<textarea name="alamat_dc" rows="4" readonly class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 cursor-not-allowed resize-none"><?= htmlspecialchars($data_pelanggan['alamat']) ?></textarea>
						</div>
					</div>

					<!-- Right Column -->
					<div class="space-y-4">
						<div>
							<label class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-box text-gray-400 mr-2"></i>Pilih Paket
							</label>
							<select name="jenis_paket_dc" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all">
								<option value="">-- Pilih Jenis Paket --</option>
								<?php foreach($data_dc as $ck): ?>
								<option value="<?= htmlspecialchars($ck['nama_paket_dc']) ?>">
									<?= htmlspecialchars($ck['nama_paket_dc']) ?> - Rp <?= number_format($ck['tarif_dc'], 0, ',', '.') ?>/Kg (<?= htmlspecialchars($ck['waktu_kerja_dc']) ?>)
								</option>
								<?php endforeach; ?>
							</select>
						</div>

						<div>
							<label class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-weight text-gray-400 mr-2"></i>Berat (Kg)
							</label>
							<input type="number" name="berat_qty_dc" placeholder="Masukkan berat dalam Kg" min="1" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all">
						</div>

						<div>
							<label class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-calendar-plus text-gray-400 mr-2"></i>Tanggal Order Masuk
							</label>
							<input type="date" name="tgl_masuk_dc" value="<?= date('Y-m-d') ?>" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all">
						</div>

						<div>
							<label class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-calendar-check text-gray-400 mr-2"></i>Tanggal Order Keluar (Estimasi)
							</label>
							<input type="date" name="tgl_keluar_dc" value="<?= date('Y-m-d', strtotime('+2 days')) ?>" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all">
						</div>

						<div>
							<label class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-sticky-note text-gray-400 mr-2"></i>Keterangan (Optional)
							</label>
							<textarea name="keterangan_dc" rows="4" placeholder="Contoh: Pisahkan pakaian putih" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all resize-none">-</textarea>
						</div>

						<div>
							<label class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-truck text-gray-400 mr-2"></i>Metode Pengambilan
							</label>
							<select name="metode_pengambilan" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all">
								<option value="Ambil di Tempat">
									<i class="fas fa-store"></i> Ambil di Tempat
								</option>
								<option value="Antar Jemput">
									<i class="fas fa-shipping-fast"></i> Antar Jemput (+ Biaya Ongkir)
								</option>
							</select>
							<p class="mt-2 text-sm text-gray-600">
								<i class="fas fa-info-circle text-primary-500 mr-1"></i>
								Pilih "Antar Jemput" jika ingin diantar ke alamat Anda
							</p>
						</div>
					</div>
				</div>

				<!-- Form Actions -->
				<div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
					<button type="reset" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition-all">
						<i class="fas fa-redo mr-2"></i>Reset
					</button>
					<button type="submit" name="order_dc" class="px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
						<i class="fas fa-paper-plane mr-2"></i>Pesan Sekarang
					</button>
				</div>
			</form>
		</div>
	</div>
</main>

<?php require_once('footer_pelanggan.php'); ?>
