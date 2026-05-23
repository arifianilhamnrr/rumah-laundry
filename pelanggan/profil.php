<?php require_once('header_pelanggan.php'); 

$data_pelanggan = get_pelanggan($id_pelanggan);

if(isset($_POST['update_profil'])){
	if(update_pelanggan($_POST) > 0){
		echo "<script>
			modalSuccess('Profil berhasil diupdate!', 'Berhasil');
			setTimeout(() => window.location='profil.php', 1500);
		</script>";
	} else {
		echo "<script>modalError('Profil gagal diupdate!', 'Gagal');</script>";
	}
}
?>

<!-- Main Content with Tailwind -->
<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<div class="bg-white rounded-xl shadow-lg overflow-hidden">
		<!-- Header -->
		<div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-primary-50 to-secondary-50">
			<h2 class="text-2xl font-bold text-gray-900 flex items-center">
				<i class="fas fa-user-circle text-primary-600 mr-3"></i>
				Profil Saya
			</h2>
			<a href="dashboard.php" class="inline-flex items-center space-x-2 px-4 py-2 bg-white text-primary-600 rounded-lg font-semibold shadow hover:shadow-md transition-all hover:scale-105">
				<i class="fas fa-arrow-left"></i>
				<span>Kembali</span>
			</a>
		</div>

		<!-- Body -->
		<div class="p-8">
			<form action="" method="post" class="space-y-6">
							<input type="hidden" name="id_pelanggan" value="<?= $data_pelanggan['id_pelanggan'] ?>">

					<!-- Grid Layout for Form Fields -->
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<!-- Nama Lengkap -->
						<div>
							<label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-user text-primary-600 mr-2"></i>Nama Lengkap
							</label>
							<input type="text" name="nama_lengkap" id="nama" value="<?= $data_pelanggan['nama_lengkap'] ?>" required autocomplete="off"
								class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all">
						</div>

						<!-- Email -->
						<div>
							<label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-envelope text-primary-600 mr-2"></i>Email
							</label>
							<input type="email" name="email" id="email" value="<?= $data_pelanggan['email'] ?>" required autocomplete="off"
								class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all">
						</div>

						<!-- Nomor Telepon -->
						<div>
							<label for="no_telp" class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-phone text-primary-600 mr-2"></i>Nomor Telepon
							</label>
							<input type="text" name="no_telp" id="no_telp" value="<?= $data_pelanggan['no_telp'] ?>" required autocomplete="off"
								class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all">
						</div>

						<!-- Username (Disabled) -->
						<div>
							<label class="block text-sm font-semibold text-gray-700 mb-2">
								<i class="fas fa-user-tag text-gray-400 mr-2"></i>Username
							</label>
							<input type="text" value="<?= $data_pelanggan['username'] ?>" disabled
								class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed">
							<p class="text-xs text-gray-500 mt-1">Username tidak dapat diubah</p>
						</div>
					</div>

					<!-- Alamat (Full Width) -->
					<div>
						<label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
							<i class="fas fa-map-marker-alt text-primary-600 mr-2"></i>Alamat
						</label>
						<textarea name="alamat" id="alamat" rows="4" required
							class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all resize-none"><?= $data_pelanggan['alamat'] ?></textarea>
					</div>

					<!-- Tanggal Daftar (Full Width) -->
					<div>
						<label class="block text-sm font-semibold text-gray-700 mb-2">
							<i class="fas fa-calendar-alt text-gray-400 mr-2"></i>Tanggal Daftar
						</label>
						<input type="text" value="<?= date('d F Y', strtotime($data_pelanggan['tanggal_daftar'])) ?>" disabled
							class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed">
					</div>

					<!-- Submit Button -->
					<div class="flex justify-end pt-4">
						<button type="submit" name="update_profil"
							class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
							<i class="fas fa-save"></i>
							<span>Update Profil</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</main>

<?php require_once('footer_pelanggan.php'); ?>