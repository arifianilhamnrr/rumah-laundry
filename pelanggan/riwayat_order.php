<?php
require_once('header_pelanggan.php');

// Ambil semua order pelanggan
$all_orders = get_order_pelanggan($nama_pelanggan);

// Filter berdasarkan pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';
if(!empty($search)){
	$all_orders = array_filter($all_orders, function($order) use ($search) {
		$no_order = '';
		if(isset($order['or_ck_number'])) $no_order = $order['or_ck_number'];
		if(isset($order['or_dc_number'])) $no_order = $order['or_dc_number'];
		if(isset($order['or_cs_number'])) $no_order = $order['or_cs_number'];

		return stripos($no_order, $search) !== false || stripos($order['tipe'], $search) !== false;
	});
}
?>

<!-- Clean Order History Page -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
	<!-- Page Header -->
	<div class="flex justify-between items-center mb-6">
		<div>
			<h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">Riwayat Order</h1>
			<p class="text-sm text-slate-600 dark:text-slate-400">Lihat semua pesanan Anda</p>
		</div>
		<a href="dashboard.php" class="inline-flex items-center space-x-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
			<i class="fas fa-arrow-left"></i>
			<span>Kembali</span>
		</a>
	</div>

	<!-- Search Bar -->
	<div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-4 mb-6">
		<form method="GET" class="flex flex-col sm:flex-row gap-3">
			<div class="flex-1">
				<input type="text" name="search" placeholder="Cari nomor order atau jenis paket..."
					value="<?= htmlspecialchars($search) ?>"
					class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all">
			</div>
			<button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors">
				<i class="fas fa-search mr-2"></i>Cari
			</button>
			<?php if(!empty($search)): ?>
			<a href="riwayat_order.php" class="px-6 py-2 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-lg font-medium hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors text-center">
				<i class="fas fa-redo mr-2"></i>Reset
			</a>
			<?php endif; ?>
		</form>
	</div>

	<!-- Table -->
	<div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
		<div class="overflow-x-auto">
			<table class="w-full">
				<thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
					<tr>
						<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">No</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">No. Order</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">Tipe Layanan</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">Jenis Paket</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">Tanggal Masuk</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">Tanggal Keluar</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">Status</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">Total</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-slate-600 dark:text-slate-300 uppercase tracking-wider">Action</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-slate-200 dark:divide-slate-700">
					<?php if(!empty($all_orders)):
						$no = 1;
						foreach($all_orders as $order):
							// Inisialisasi variabel default
							$no_order = '';
							$tgl_masuk = '';
							$tgl_keluar = '';
							$paket = '';
							$total = 0;
							$status = 'Pending';
							$detail_link = '#';

							// Tentukan field berdasarkan tipe
							if($order['tipe'] == 'Cuci Komplit'){
								$no_order = isset($order['or_ck_number']) ? $order['or_ck_number'] : '';
								$tgl_masuk = isset($order['tgl_masuk_ck']) ? $order['tgl_masuk_ck'] : '';
								$tgl_keluar = isset($order['tgl_keluar_ck']) ? $order['tgl_keluar_ck'] : '';
								$paket = isset($order['jenis_paket_ck']) ? $order['jenis_paket_ck'] : '';
								$total = isset($order['tot_bayar']) ? $order['tot_bayar'] : 0;
								$status = isset($order['status']) ? $order['status'] : 'Pending';
								$detail_link = 'detail_order_ck.php?or_ck_number=' . $no_order;
							} elseif($order['tipe'] == 'Dry Clean'){
								$no_order = isset($order['or_dc_number']) ? $order['or_dc_number'] : '';
								$tgl_masuk = isset($order['tgl_masuk_dc']) ? $order['tgl_masuk_dc'] : '';
								$tgl_keluar = isset($order['tgl_keluar_dc']) ? $order['tgl_keluar_dc'] : '';
								$paket = isset($order['jenis_paket_dc']) ? $order['jenis_paket_dc'] : '';
								$total = isset($order['tot_bayar']) ? $order['tot_bayar'] : 0;
								$status = isset($order['status']) ? $order['status'] : 'Pending';
								$detail_link = 'detail_order_dc.php?or_dc_number=' . $no_order;
							} else {
								$no_order = isset($order['or_cs_number']) ? $order['or_cs_number'] : '';
								$tgl_masuk = isset($order['tgl_masuk_cs']) ? $order['tgl_masuk_cs'] : '';
								$tgl_keluar = isset($order['tgl_keluar_cs']) ? $order['tgl_keluar_cs'] : '';
								$paket = isset($order['jenis_paket_cs']) ? $order['jenis_paket_cs'] : '';
								$total = isset($order['tot_bayar']) ? $order['tot_bayar'] : 0;
								$status = isset($order['status']) ? $order['status'] : 'Pending';
								$detail_link = 'detail_order_cs.php?or_cs_number=' . $no_order;
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
						<td class="px-4 py-3 text-sm text-slate-900 dark:text-white"><?= $no++ ?></td>
						<td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white"><?= htmlspecialchars($no_order) ?></td>
						<td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400"><?= htmlspecialchars($order['tipe']) ?></td>
						<td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400"><?= htmlspecialchars($paket) ?></td>
						<td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400"><?= htmlspecialchars($tgl_masuk) ?></td>
						<td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400"><?= htmlspecialchars($tgl_keluar) ?></td>
						<td class="px-4 py-3">
							<span class="inline-flex items-center space-x-1 px-2 py-1 rounded-md text-xs font-medium <?= $statusClass ?>">
								<i class="fas <?= $statusIcon ?>"></i>
								<span><?= htmlspecialchars($status) ?></span>
							</span>
						</td>
						<td class="px-4 py-3 text-sm font-semibold text-slate-900 dark:text-white">Rp <?= number_format($total, 0, ',', '.') ?></td>
						<td class="px-4 py-3">
							<a href="<?= $detail_link ?>" class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded-md transition-colors">
								<i class="fas fa-eye mr-1"></i>
								Detail
							</a>
						</td>
					</tr>
					<?php endforeach; else: ?>
					<tr>
						<td colspan="9" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">
							<i class="fas fa-inbox text-3xl mb-2 text-slate-300 dark:text-slate-600"></i>
							<p>
								<?php if(!empty($search)): ?>
									Tidak ada hasil untuk pencarian "<?= htmlspecialchars($search) ?>"
								<?php else: ?>
									Belum ada order. <a href="order_baru.php" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">Buat order sekarang!</a>
								<?php endif; ?>
							</p>
						</td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>

		<!-- Summary -->
		<?php if(!empty($all_orders)):
			$total_belanja = 0;
			foreach($all_orders as $order){
				if(isset($order['tot_bayar'])){
					$total_belanja += $order['tot_bayar'];
				}
			}
		?>
		<div class="border-t border-slate-200 dark:border-slate-700 p-4 bg-slate-50 dark:bg-slate-800/50">
			<div class="flex flex-col sm:flex-row justify-between items-center gap-4">
				<div>
					<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Total Transaksi</p>
					<h3 class="text-xl font-bold text-slate-900 dark:text-white"><?= count($all_orders) ?> Order</h3>
				</div>
				<div class="text-right">
					<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Total Belanja</p>
					<h3 class="text-xl font-bold text-slate-900 dark:text-white">Rp <?= number_format($total_belanja, 0, ',', '.') ?></h3>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php require_once('footer_pelanggan.php'); ?>
