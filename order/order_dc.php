<?php 
   require_once('../_header.php'); 
   $data_dc = query("SELECT * FROM tb_dry_clean");
?>

<?php if (isset($_POST['order_dc'])) : ?>
   <?php if (order_dc($_POST) > 0) :?>
      <script>
         modalSuccess('Order berhasil ditambahkan!', 'Berhasil');
         setTimeout(() => window.location='<?=url()?>', 1500);
      </script>
   <?php else : ?>
      <script>
         modalError('Order gagal ditambahkan!', 'Gagal');
      </script>
   <?php endif ?>
<?php endif ?>

<!-- Main Content with Tailwind -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<div class="bg-white rounded-xl shadow-lg overflow-hidden">
		<!-- Header -->
		<div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-primary-50 to-secondary-50">
			<h2 class="text-2xl font-bold text-gray-900 flex items-center">
				<i class="fas fa-wind text-purple-600 mr-3"></i>
				Dry Clean
			</h2>
			<a href="<?=url('order/order.php')?>" class="inline-flex items-center space-x-2 px-4 py-2 bg-white text-purple-600 rounded-lg font-semibold shadow hover:shadow-md transition-all hover:scale-105">
				<i class="fas fa-arrow-left"></i>
				<span>Kembali</span>
			</a>
		</div>

		<!-- Body -->
		<div class="p-8">
			<form action="" method="post" class="space-y-6">
				<!-- Grid Layout for Form Fields -->
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
					<!-- Left Column -->
					<div class="space-y-4">
						<!-- Nama Pelanggan -->
						<div>
							<label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-user text-purple-600 mr-2"></i>Nama Pelanggan
							</label>
							<input type="text" name="nama_pel_dc" placeholder="Nama lengkap" autocomplete="off" id="nama"
								class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all">
						</div>

						<!-- Nomor Telepon -->
						<div>
							<label for="no-telp" class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-phone text-purple-600 mr-2"></i>Nomor Telepon
							</label>
							<input type="text" name="no_telp_dc" placeholder="Nomor Telepon" autocomplete="off" id="no-telp"
								class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all">
						</div>

						<!-- Alamat -->
						<div>
							<label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-map-marker-alt text-purple-600 mr-2"></i>Alamat
							</label>
							<textarea name="alamat_dc" rows="4" id="alamat"
								class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all resize-none"></textarea>
						</div>
					</div>

					<!-- Right Column -->
					<div class="space-y-4">
						<!-- Pilih Paket -->
						<div>
							<label for="pilih_paket" class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-box text-purple-600 mr-2"></i>Pilih Paket
							</label>
							<select name="jenis_paket_dc" id="pilih_paket"
								class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all">
								<option>-- Pilih Jenis Paket --</option>
								<?php foreach ($data_dc as $ck) : ?>
								<option><?=$ck['nama_paket_dc']?></option>
								<?php endforeach ?>
							</select>
						</div>

						<!-- Berat -->
						<div>
							<label for="kuantitas" class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-weight text-purple-600 mr-2"></i>Berat (Kg)
							</label>
							<input type="number" name="berat_qty_dc" placeholder="Berat (Kg)" autocomplete="off" id="kuantitas"
								class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all">
						</div>

						<!-- Tanggal Masuk -->
						<div>
							<label for="tgl_order_msk" class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-calendar-plus text-purple-600 mr-2"></i>Tanggal Order Masuk
							</label>
							<input type="date" name="tgl_masuk_dc" autocomplete="off" id="tgl_order_msk"
								class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all">
						</div>

						<!-- Tanggal Keluar -->
						<div>
							<label for="tgl_order_klr" class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-calendar-check text-purple-600 mr-2"></i>Tanggal Order Keluar
							</label>
							<input type="date" name="tgl_keluar_dc" autocomplete="off" id="tgl_order_klr"
								class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all">
						</div>

						<!-- Keterangan -->
						<div>
							<label for="ket" class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-comment text-purple-600 mr-2"></i>Keterangan
							</label>
							<textarea name="keterangan_dc" rows="4" id="ket"
								class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all resize-none"></textarea>
						</div>

						<!-- Metode Pengambilan -->
						<div>
							<label for="metode" class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-truck text-purple-600 mr-2"></i>Metode Pengambilan
							</label>
							<select name="metode_pengambilan" id="metode" required
								class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 transition-all">
								<option value="Ambil di Tempat"><i class="fas fa-home"></i> Ambil di Tempat</option>
								<option value="Antar Jemput"><i class="fas fa-truck"></i> Antar Jemput</option>
							</select>
						</div>
					</div>
				</div>

				<!-- Submit Buttons -->
				<div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
					<button type="reset" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-all">
						<i class="fas fa-times mr-2"></i>Batal
					</button>
					<button type="submit" name="order_dc" class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
						<i class="fas fa-shopping-cart"></i>
						<span>Pesan</span>
					</button>
				</div>
			</form>
		</div>
	</div>
</main>

<?php require_once('../_footer.php') ?>