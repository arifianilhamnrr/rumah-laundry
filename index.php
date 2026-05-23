<?php
	require_once('_header.php');
	if (isset($_SESSION['login']) == '') {
		header("Location: login.php");
		exit();
	}
	$jml_karyawan = count(query('SELECT * FROM master LIMIT 20 OFFSET 1'));
?>

	<!-- Main Content with Tailwind -->
	<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
		<!-- Welcome Section -->
		<div class="mb-8">
			<div class="bg-gradient-to-r from-primary-600 to-secondary-500 rounded-2xl shadow-xl p-6 sm:p-8 text-white">
				<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
					<div>
						<p class="text-primary-100 text-sm font-medium mb-1">Selamat Datang</p>
						<h1 class="text-3xl sm:text-4xl font-bold"><?= htmlspecialchars(ucfirst($_SESSION['master'])) ?></h1>
						<p class="text-primary-100 mt-2">Dashboard Management System</p>
					</div>
					<a href="<?=url('order/order.php')?>" class="inline-flex items-center space-x-2 bg-white text-primary-600 px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
						<i class="fas fa-plus-circle"></i>
						<span>Order Baru</span>
					</a>
				</div>
			</div>
		</div>

		<!-- Stats Cards -->
		<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
			<!-- Card 1: Jumlah Karyawan -->
			<div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 overflow-hidden">
				<div class="p-6">
					<div class="flex items-center justify-between">
						<div class="flex-1">
							<p class="text-gray-500 text-sm font-medium mb-1">Jumlah Karyawan</p>
							<h3 class="text-3xl font-bold text-gray-900"><?= $jml_karyawan ?></h3>
						</div>
						<div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-full p-4">
							<i class="fas fa-users text-white text-2xl"></i>
						</div>
					</div>
				</div>
				<div class="bg-gradient-to-r from-blue-500 to-blue-600 h-1"></div>
			</div>

			<!-- Card 2: Total Order -->
			<div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 overflow-hidden">
				<div class="p-6">
					<div class="flex items-center justify-between">
						<div class="flex-1">
							<p class="text-gray-500 text-sm font-medium mb-1">Total Order</p>
							<h3 class="text-3xl font-bold text-gray-900"><?= jmlOrder(); ?></h3>
						</div>
						<div class="bg-gradient-to-br from-green-500 to-green-600 rounded-full p-4">
							<i class="fas fa-shopping-cart text-white text-2xl"></i>
						</div>
					</div>
				</div>
				<div class="bg-gradient-to-r from-green-500 to-green-600 h-1"></div>
			</div>

			<!-- Card 3: Jumlah Paket -->
			<div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 overflow-hidden">
				<div class="p-6">
					<div class="flex items-center justify-between">
						<div class="flex-1">
							<p class="text-gray-500 text-sm font-medium mb-1">Jumlah Paket Tersedia</p>
							<h3 class="text-3xl font-bold text-gray-900"><?= jmlPaket(); ?></h3>
						</div>
						<div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-full p-4">
							<i class="fas fa-box-open text-white text-2xl"></i>
						</div>
					</div>
				</div>
				<div class="bg-gradient-to-r from-purple-500 to-purple-600 h-1"></div>
			</div>
		</div>

		<!-- Daftar Order Cuci Komplit -->
		<div class="mb-8">
			<?php require_once('daftar_order/daf_or_ck.php');?>
		</div>

		<!-- Daftar Order Cuci Kering/Dry Clean -->
		<div class="mb-8">
			<?php require_once('daftar_order/daf_or_dc.php');?>
		</div>

		<!-- Daftar Order Cuci Satuan -->
		<div class="mb-8">
			<?php require_once('daftar_order/daf_or_cs.php');?>
		</div>

	</main>

<?php require_once('_footer.php'); ?>