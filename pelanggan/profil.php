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

<!-- Clean Profile Page -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
	<!-- Page Header -->
	<div class="flex justify-between items-center mb-6">
		<div>
			<h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">Profil Saya</h1>
			<p class="text-sm text-slate-600 dark:text-slate-400">Kelola informasi profil Anda</p>
		</div>
		<a href="dashboard.php" class="inline-flex items-center space-x-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
			<i class="fas fa-arrow-left"></i>
			<span>Kembali</span>
		</a>
	</div>

	<!-- Form -->
	<div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-6">
		<form action="" method="post" class="space-y-6">
			<input type="hidden" name="id_pelanggan" value="<?= $data_pelanggan['id_pelanggan'] ?>">

			<!-- Grid Layout for Form Fields -->
			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
				<!-- Nama Lengkap -->
				<div>
					<label for="nama" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Nama Lengkap <span class="text-red-500">*</span>
					</label>
					<input type="text" name="nama_lengkap" id="nama" value="<?= $data_pelanggan['nama_lengkap'] ?>" required autocomplete="off"
						class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
				</div>

				<!-- Email -->
				<div>
					<label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Email <span class="text-red-500">*</span>
					</label>
					<input type="email" name="email" id="email" value="<?= $data_pelanggan['email'] ?>" required autocomplete="off"
						class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
				</div>

				<!-- Nomor Telepon -->
				<div>
					<label for="no_telp" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Nomor Telepon <span class="text-red-500">*</span>
					</label>
					<input type="text" name="no_telp" id="no_telp" value="<?= $data_pelanggan['no_telp'] ?>" required autocomplete="off"
						class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
				</div>

				<!-- Username (Disabled) -->
				<div>
					<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
						Username
					</label>
					<input type="text" value="<?= $data_pelanggan['username'] ?>" disabled
						class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 cursor-not-allowed">
					<p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Username tidak dapat diubah</p>
				</div>
			</div>

			<!-- Alamat (Full Width) -->
			<div>
				<label for="alamat" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
					Alamat <span class="text-red-500">*</span>
				</label>
				<textarea name="alamat" id="alamat" rows="4" required
					class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all resize-none"><?= $data_pelanggan['alamat'] ?></textarea>
			</div>

			<!-- Tanggal Daftar (Full Width) -->
			<div>
				<label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
					Tanggal Daftar
				</label>
				<input type="text" value="<?= date('d F Y', strtotime($data_pelanggan['tanggal_daftar'])) ?>" disabled
					class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 cursor-not-allowed">
			</div>

			<!-- Submit Button -->
			<div class="flex justify-end pt-4">
				<button type="submit" name="update_profil"
					class="inline-flex items-center space-x-2 px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors">
					<i class="fas fa-save"></i>
					<span>Update Profil</span>
				</button>
			</div>
		</form>
	</div>
</section>

<?php require_once('footer_pelanggan.php'); ?>
