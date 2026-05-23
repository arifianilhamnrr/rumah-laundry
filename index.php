<?php
	require_once('_header.php');
	if (isset($_SESSION['login']) == '') {
		header("Location: login.php");
		exit();
	}
	$jml_karyawan = count(query('SELECT * FROM master LIMIT 20 OFFSET 1'));
?>

	<!-- Clean Minimalist Dashboard -->
	<main class="p-4 sm:p-6 lg:p-8">
		<!-- Welcome Section -->
		<div class="mb-6">
			<h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">Dashboard</h1>
			<p class="text-sm text-slate-600 dark:text-slate-400">Selamat datang, <?= htmlspecialchars(ucfirst($_SESSION['master'])) ?></p>
		</div>

		<!-- Stats Cards -->
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
			<!-- Card 1: Karyawan -->
			<div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-5 hover:shadow-md transition-shadow">
				<div class="flex items-center justify-between">
					<div>
						<p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide mb-1">Karyawan</p>
						<p class="text-2xl font-bold text-slate-900 dark:text-white"><?= $jml_karyawan ?></p>
					</div>
					<div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
						<i class="fas fa-users text-blue-600 dark:text-blue-400 text-xl"></i>
					</div>
				</div>
			</div>

			<!-- Card 2: Total Order -->
			<div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-5 hover:shadow-md transition-shadow">
				<div class="flex items-center justify-between">
					<div>
						<p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide mb-1">Total Order</p>
						<p class="text-2xl font-bold text-slate-900 dark:text-white"><?= jmlOrder(); ?></p>
					</div>
					<div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
						<i class="fas fa-shopping-cart text-green-600 dark:text-green-400 text-xl"></i>
					</div>
				</div>
			</div>

			<!-- Card 3: Paket -->
			<div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-5 hover:shadow-md transition-shadow">
				<div class="flex items-center justify-between">
					<div>
						<p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide mb-1">Paket</p>
						<p class="text-2xl font-bold text-slate-900 dark:text-white"><?= jmlPaket(); ?></p>
					</div>
					<div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
						<i class="fas fa-box-open text-purple-600 dark:text-purple-400 text-xl"></i>
					</div>
				</div>
			</div>
		</div>

		<!-- Order Lists -->
		<div class="space-y-4">
			<!-- Cuci Komplit -->
			<div>
				<?php require_once('daftar_order/daf_or_ck.php');?>
			</div>

			<!-- Dry Clean -->
			<div>
				<?php require_once('daftar_order/daf_or_dc.php');?>
			</div>

			<!-- Cuci Satuan -->
			<div>
				<?php require_once('daftar_order/daf_or_cs.php');?>
			</div>
		</div>

	</main>
</div>

<?php require_once('_footer.php'); ?>