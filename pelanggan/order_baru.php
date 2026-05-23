<?php require_once('header_pelanggan.php');

$data_pelanggan = get_pelanggan($id_pelanggan);
?>

<!-- Clean Order Page -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<!-- Page Header -->
	<div class="mb-8 flex flex-col gap-4 rounded-[28px] border border-slate-200/80 dark:border-slate-800 bg-white/85 dark:bg-slate-900/75 px-6 py-6 shadow-card backdrop-blur sm:flex-row sm:items-center sm:justify-between lg:px-8">
		<div>
			<h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">Buat Order Baru</h1>
			<p class="text-sm text-slate-600 dark:text-slate-400">Pilih jenis layanan laundry</p>
		</div>
		<a href="dashboard.php" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white/90 dark:bg-slate-900 px-4 py-2.5 text-sm font-medium text-slate-700 shadow-soft transition hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">
			<i class="fas fa-arrow-left"></i>
			<span>Kembali</span>
		</a>
	</div>

	<!-- Package Cards -->
	<div class="grid grid-cols-1 gap-4 md:grid-cols-3">
		<!-- Cuci Komplit -->
		<a href="order_ck.php" class="group rounded-[24px] border border-slate-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 p-6 shadow-soft transition hover:-translate-y-1 hover:border-slate-300 hover:shadow-card dark:hover:border-slate-700">
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
		<a href="order_dc.php" class="group rounded-[24px] border border-slate-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 p-6 shadow-soft transition hover:-translate-y-1 hover:border-slate-300 hover:shadow-card dark:hover:border-slate-700">
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
		<a href="order_cs.php" class="group rounded-[24px] border border-slate-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 p-6 shadow-soft transition hover:-translate-y-1 hover:border-slate-300 hover:shadow-card dark:hover:border-slate-700">
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
</section>

<?php require_once('footer_pelanggan.php'); ?>
