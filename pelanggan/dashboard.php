<?php require_once('header_pelanggan.php'); ?>

<!-- Clean Customer Dashboard -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
	<!-- Welcome Section -->
	<div class="mb-6">
		<h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">Dashboard</h1>
		<p class="text-sm text-slate-600 dark:text-slate-400">Selamat datang, <?= htmlspecialchars($nama_pelanggan) ?></p>
	</div>

	<!-- Stats Cards -->
	<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3 mb-8">
		<!-- Card 1: Total Order -->
		<div class="rounded-[24px] border border-slate-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 p-5 shadow-soft transition hover:-translate-y-0.5 hover:shadow-card">
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
		<div class="rounded-[24px] border border-slate-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 p-5 shadow-soft transition hover:-translate-y-0.5 hover:shadow-card">
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
		<div class="rounded-[24px] border border-slate-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 p-5 shadow-soft transition hover:-translate-y-0.5 hover:shadow-card">
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

	<!-- Quick Actions -->
	<div class="mb-8">
		<div class="mb-4 flex items-center justify-between">
			<h2 class="text-lg font-semibold text-slate-900 dark:text-white">Menu Cepat</h2>
			<p class="text-sm text-slate-500 dark:text-slate-400">Akses fitur utama lebih cepat.</p>
		</div>
		<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
			<!-- Order Baru -->
			<a href="order_baru.php" class="group rounded-[24px] border border-slate-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 p-6 shadow-soft transition hover:-translate-y-0.5 hover:shadow-card">
				<div class="flex flex-col items-center text-center">
					<div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
						<i class="fas fa-tshirt text-blue-600 dark:text-blue-400 text-2xl"></i>
					</div>
					<h4 class="font-semibold text-slate-900 dark:text-white mb-1">Order Baru</h4>
					<p class="text-xs text-slate-600 dark:text-slate-400">Pesan layanan laundry</p>
				</div>
			</a>

			<!-- Riwayat Order -->
			<a href="riwayat_order.php" class="group rounded-[24px] border border-slate-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 p-6 shadow-soft transition hover:-translate-y-0.5 hover:shadow-card">
				<div class="flex flex-col items-center text-center">
					<div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
						<i class="fas fa-history text-purple-600 dark:text-purple-400 text-2xl"></i>
					</div>
					<h4 class="font-semibold text-slate-900 dark:text-white mb-1">Riwayat Order</h4>
					<p class="text-xs text-slate-600 dark:text-slate-400">Lihat pesanan Anda</p>
				</div>
			</a>

			<!-- Profil -->
			<a href="profil.php" class="group rounded-[24px] border border-slate-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 p-6 shadow-soft transition hover:-translate-y-0.5 hover:shadow-card">
				<div class="flex flex-col items-center text-center">
					<div class="w-14 h-14 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
						<i class="fas fa-user-circle text-green-600 dark:text-green-400 text-2xl"></i>
					</div>
					<h4 class="font-semibold text-slate-900 dark:text-white mb-1">Profil Saya</h4>
					<p class="text-xs text-slate-600 dark:text-slate-400">Edit profil Anda</p>
				</div>
			</a>
		</div>
	</div>

	<!-- Recent Orders -->
	<div class="mb-6">
		<div class="mb-4 flex items-center justify-between">
			<h2 class="text-lg font-semibold text-slate-900 dark:text-white">Order Terbaru</h2>
			<a href="riwayat_order.php" class="text-sm text-blue-600 dark:text-blue-400 hover:underline flex items-center space-x-1">
				<span>Lihat Semua</span>
				<i class="fas fa-arrow-right text-xs"></i>
			</a>
		</div>

		<div class="overflow-hidden rounded-[28px] border border-slate-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 shadow-soft">
			<div class="overflow-x-auto">
				<table class="w-full">
					<thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
						<tr>
							<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">No. Order</th>
							<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">Tanggal</th>
							<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">Jenis Paket</th>
							<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">Status</th>
							<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">Total</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-slate-200 dark:divide-slate-700">
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
								$statusClass = 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300';
								$statusIcon = 'fa-clock';
								if($status == 'Pending') {
									$statusClass = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400';
									$statusIcon = 'fa-clock';
								} elseif($status == 'Proses') {
									$statusClass = 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400';
									$statusIcon = 'fa-spinner';
								} elseif($status == 'Selesai') {
									$statusClass = 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400';
									$statusIcon = 'fa-check-circle';
								}
						?>
						<tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
							<td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white"><?= htmlspecialchars($no_order) ?></td>
							<td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400"><?= htmlspecialchars($tgl) ?></td>
							<td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400"><?= htmlspecialchars($paket) ?></td>
							<td class="px-4 py-3">
								<span class="inline-flex items-center space-x-1 px-2 py-1 rounded-md text-xs font-medium <?= $statusClass ?>">
									<i class="fas <?= $statusIcon ?>"></i>
									<span><?= htmlspecialchars($status) ?></span>
								</span>
							</td>
							<td class="px-4 py-3 text-sm font-semibold text-slate-900 dark:text-white">Rp <?= number_format($total, 0, ',', '.') ?></td>
						</tr>
						<?php endforeach; else: ?>
						<tr>
							<td colspan="5" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">
								<i class="fas fa-inbox text-3xl mb-2 text-slate-300 dark:text-slate-600"></i>
								<p>Belum ada order. <a href="order_baru.php" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Buat order sekarang!</a></p>
							</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</section>

<?php require_once('footer_pelanggan.php'); ?>
