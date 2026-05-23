<?php require_once('header_pelanggan.php'); ?>

<!-- Clean Customer Dashboard -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
	<!-- Welcome Section -->
	<div class="mb-6">
		<h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">Dashboard</h1>
		<p class="text-sm text-slate-600 dark:text-slate-400">Selamat datang, <?= htmlspecialchars($nama_pelanggan) ?></p>
	</div>

	<!-- Stats Cards -->
	<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
		<!-- Card 1: Total Order -->
		<div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-5 hover:shadow-md transition-shadow">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide mb-1">Total Order</p>
					<p class="text-2xl font-bold text-slate-900 dark:text-white"><?= count(get_order_pelanggan($nama_pelanggan)) ?></p>
				</div>
				<div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
					<i class="fas fa-shopping-bag text-blue-600 dark:text-blue-400 text-xl"></i>
				</div>
			</div>
		</div>

		<!-- Card 2: Paket -->
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

		<!-- Card 3: Status -->
		<div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-5 hover:shadow-md transition-shadow">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide mb-1">Status</p>
					<p class="text-lg font-bold text-green-600 dark:text-green-400 flex items-center">
						<i class="fas fa-check-circle mr-2"></i>
						Aktif
					</p>
				</div>
				<div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
					<i class="fas fa-user-check text-green-600 dark:text-green-400 text-xl"></i>
				</div>
			</div>
		</div>
	</div>
						</h3>
					</div>
					<div class="bg-gradient-to-br from-green-500 to-green-600 rounded-full p-4">
						<i class="fas fa-user-check text-white text-2xl"></i>
					</div>
				</div>
			</div>
			<div class="bg-gradient-to-r from-green-500 to-green-600 h-1"></div>
		</div>
	</div>

	<!-- Quick Actions -->
	<div class="mb-8">
		<div class="bg-white rounded-xl shadow-lg overflow-hidden">
			<div class="p-6 border-b border-gray-200">
				<h2 class="text-xl font-bold text-gray-900 flex items-center">
					<i class="fas fa-rocket text-primary-600 mr-2"></i>
					Menu Cepat
				</h2>
			</div>
			<div class="p-6">
				<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
					<!-- Order Baru -->
					<a href="order_baru.php" class="group">
						<div class="bg-gradient-to-br from-primary-500 to-primary-600 text-white p-6 rounded-xl text-center transition-all transform hover:scale-105 hover:shadow-xl">
							<div class="text-4xl mb-3">
								<i class="fas fa-tshirt"></i>
							</div>
							<h4 class="font-bold text-lg mb-2">Order Baru</h4>
							<p class="text-sm text-primary-100">Pesan layanan laundry</p>
						</div>
					</a>

					<!-- Riwayat Order -->
					<a href="riwayat_order.php" class="group">
						<div class="bg-gradient-to-br from-pink-500 to-rose-600 text-white p-6 rounded-xl text-center transition-all transform hover:scale-105 hover:shadow-xl">
							<div class="text-4xl mb-3">
								<i class="fas fa-history"></i>
							</div>
							<h4 class="font-bold text-lg mb-2">Riwayat Order</h4>
							<p class="text-sm text-pink-100">Lihat pesanan Anda</p>
						</div>
					</a>

					<!-- Profil -->
					<a href="profil.php" class="group">
						<div class="bg-gradient-to-br from-cyan-500 to-blue-600 text-white p-6 rounded-xl text-center transition-all transform hover:scale-105 hover:shadow-xl">
							<div class="text-4xl mb-3">
								<i class="fas fa-user-circle"></i>
							</div>
							<h4 class="font-bold text-lg mb-2">Profil Saya</h4>
							<p class="text-sm text-cyan-100">Edit profil Anda</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Recent Orders -->
	<div class="mb-8">
		<div class="bg-white rounded-xl shadow-lg overflow-hidden">
			<div class="p-6 border-b border-gray-200 flex justify-between items-center">
				<h2 class="text-xl font-bold text-gray-900 flex items-center">
					<i class="fas fa-box text-primary-600 mr-2"></i>
					Order Terbaru
				</h2>
				<a href="riwayat_order.php" class="inline-flex items-center space-x-1 text-primary-600 hover:text-primary-700 font-semibold text-sm transition-colors">
					<span>Lihat Semua</span>
					<i class="fas fa-arrow-right"></i>
				</a>
			</div>

			<div class="overflow-x-auto">
				<table class="w-full">
					<thead class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
						<tr>
							<th class="px-6 py-4 text-left text-sm font-semibold">No. Order</th>
							<th class="px-6 py-4 text-left text-sm font-semibold">Tanggal</th>
							<th class="px-6 py-4 text-left text-sm font-semibold">Jenis Paket</th>
							<th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
							<th class="px-6 py-4 text-left text-sm font-semibold">Total</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-gray-200">
						<?php
						$recent_orders = array_slice(get_order_pelanggan($nama_pelanggan), 0, 5);
						if(!empty($recent_orders)):
							foreach($recent_orders as $order):
								// Tentukan field berdasarkan tipe
								if($order['tipe'] == 'Cuci Komplit'){
									$no_order = $order['or_ck_number'];
									$tgl = $order['tgl_masuk_ck'];
									$paket = $order['jenis_paket_ck'];
									$total = $order['tot_bayar'];
									$status = $order['status'] ?? 'Pending';
								} elseif($order['tipe'] == 'Dry Clean'){
									$no_order = $order['or_dc_number'];
									$tgl = $order['tgl_masuk_dc'];
									$paket = $order['jenis_paket_dc'];
									$total = $order['tot_bayar'];
									$status = $order['status'] ?? 'Pending';
								} else {
									$no_order = $order['or_cs_number'];
									$tgl = $order['tgl_masuk_cs'];
									$paket = $order['jenis_paket_cs'];
									$total = $order['tot_bayar'];
									$status = $order['status'] ?? 'Pending';
								}

								// Status badge styling
								$statusClass = 'bg-gray-100 text-gray-800';
								$statusIcon = 'fa-clock';
								if($status == 'Pending') {
									$statusClass = 'bg-yellow-100 text-yellow-800';
									$statusIcon = 'fa-clock';
								} elseif($status == 'Proses') {
									$statusClass = 'bg-blue-100 text-blue-800';
									$statusIcon = 'fa-spinner';
								} elseif($status == 'Selesai') {
									$statusClass = 'bg-green-100 text-green-800';
									$statusIcon = 'fa-check-circle';
								}
						?>
						<tr class="hover:bg-gray-50 transition-colors">
							<td class="px-6 py-4 text-sm font-medium text-gray-900"><?= htmlspecialchars($no_order) ?></td>
							<td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($tgl) ?></td>
							<td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($paket) ?></td>
							<td class="px-6 py-4">
								<span class="inline-flex items-center space-x-1 px-3 py-1 rounded-full text-xs font-semibold <?= $statusClass ?>">
									<i class="fas <?= $statusIcon ?>"></i>
									<span><?= htmlspecialchars($status) ?></span>
								</span>
							</td>
							<td class="px-6 py-4 text-sm font-semibold text-gray-900">Rp <?= number_format($total, 0, ',', '.') ?></td>
						</tr>
						<?php endforeach; else: ?>
						<tr>
							<td colspan="5" class="px-6 py-8 text-center text-gray-500">
								<i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
								<p>Belum ada order. <a href="order_baru.php" class="text-primary-600 hover:underline font-semibold">Buat order sekarang!</a></p>
							</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</main>

<?php require_once('footer_pelanggan.php'); ?>