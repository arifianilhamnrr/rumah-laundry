<?php require_once('header_pelanggan.php');

$data_pelanggan = get_pelanggan($id_pelanggan);
?>

<!-- Clean Order Page -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
	<!-- Page Header -->
	<div class="flex justify-between items-center mb-6">
		<div>
			<h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">Buat Order Baru</h1>
			<p class="text-sm text-slate-600 dark:text-slate-400">Pilih jenis layanan laundry</p>
		</div>
		<a href="dashboard.php" class="inline-flex items-center space-x-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
			<i class="fas fa-arrow-left"></i>
			<span>Kembali</span>
		</a>
	</div>

	<!-- Package Cards -->
	<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
		<!-- Cuci Komplit -->
		<a href="order_ck.php" class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-6 hover:shadow-md hover:border-blue-500 dark:hover:border-blue-500 transition-all group">
			<div class="flex flex-col items-center text-center">
				<div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
					<i class="fas fa-soap text-blue-600 dark:text-blue-400 text-3xl"></i>
				</div>
				<h4 class="text-lg font-semibold text-slate-900 dark:text-white mb-1">Cuci Komplit</h4>
				<p class="text-sm text-slate-600 dark:text-slate-400 mb-3">Cuci + Setrika</p>
				<div class="inline-flex items-center space-x-1 text-blue-600 dark:text-blue-400 text-sm font-medium">
					<span>Pilih Paket</span>
					<i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
				</div>
			</div>
		</a>

		<!-- Dry Clean -->
		<a href="order_dc.php" class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-6 hover:shadow-md hover:border-purple-500 dark:hover:border-purple-500 transition-all group">
			<div class="flex flex-col items-center text-center">
				<div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
					<i class="fas fa-wind text-purple-600 dark:text-purple-400 text-3xl"></i>
				</div>
				<h4 class="text-lg font-semibold text-slate-900 dark:text-white mb-1">Dry Clean</h4>
				<p class="text-sm text-slate-600 dark:text-slate-400 mb-3">Cuci Kering</p>
				<div class="inline-flex items-center space-x-1 text-purple-600 dark:text-purple-400 text-sm font-medium">
					<span>Pilih Paket</span>
					<i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
				</div>
			</div>
		</a>

		<!-- Cuci Satuan -->
		<a href="order_cs.php" class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-6 hover:shadow-md hover:border-green-500 dark:hover:border-green-500 transition-all group">
			<div class="flex flex-col items-center text-center">
				<div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
					<i class="fas fa-tshirt text-green-600 dark:text-green-400 text-3xl"></i>
				</div>
				<h4 class="text-lg font-semibold text-slate-900 dark:text-white mb-1">Cuci Satuan</h4>
				<p class="text-sm text-slate-600 dark:text-slate-400 mb-3">Per Item</p>
				<div class="inline-flex items-center space-x-1 text-green-600 dark:text-green-400 text-sm font-medium">
					<span>Pilih Paket</span>
					<i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
				</div>
			</div>
		</a>
	</div>
</main>

<?php require_once('footer_pelanggan.php'); ?>