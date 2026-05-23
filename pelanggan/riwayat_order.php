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

<!-- Main Content with Tailwind -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<div class="bg-white rounded-xl shadow-lg overflow-hidden">
		<!-- Header -->
		<div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-primary-50 to-secondary-50">
			<h2 class="text-2xl font-bold text-gray-900 flex items-center">
				<i class="fas fa-history text-primary-600 mr-3"></i>
				Riwayat Order Saya
			</h2>
			<a href="dashboard.php" class="inline-flex items-center space-x-2 px-4 py-2 bg-white text-primary-600 rounded-lg font-semibold shadow hover:shadow-md transition-all hover:scale-105">
				<i class="fas fa-arrow-left"></i>
				<span>Kembali</span>
			</a>
		</div>

		<!-- Search Bar -->
		<div class="p-6 border-b border-gray-200 bg-gray-50">
			<form method="GET" class="flex flex-col sm:flex-row gap-3">
				<div class="flex-1">
					<input type="text" name="search" placeholder="Cari nomor order atau jenis paket..."
						value="<?= htmlspecialchars($search) ?>"
						class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all">
				</div>
				<button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
					<i class="fas fa-search mr-2"></i>Cari
				</button>
				<?php if(!empty($search)): ?>
				<a href="riwayat_order.php" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-all text-center">
					<i class="fas fa-redo mr-2"></i>Reset
				</a>
				<?php endif; ?>
			</form>
		</div>

		</div>

		<!-- Table -->
		<div class="overflow-x-auto">
			<table class="w-full">
				<thead class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
					<tr>
						<th class="px-4 py-4 text-left text-sm font-semibold">No</th>
						<th class="px-4 py-4 text-left text-sm font-semibold">No. Order</th>
						<th class="px-4 py-4 text-left text-sm font-semibold">Tipe Layanan</th>
						<th class="px-4 py-4 text-left text-sm font-semibold">Jenis Paket</th>
						<th class="px-4 py-4 text-left text-sm font-semibold">Tanggal Masuk</th>
						<th class="px-4 py-4 text-left text-sm font-semibold">Tanggal Keluar</th>
						<th class="px-4 py-4 text-left text-sm font-semibold">Status</th>
						<th class="px-4 py-4 text-left text-sm font-semibold">Total</th>
						<th class="px-4 py-4 text-left text-sm font-semibold">Action</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-gray-200">
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
						<td class="px-4 py-4 text-sm text-gray-900"><?= $no++ ?></td>
						<td class="px-4 py-4 text-sm font-semibold text-gray-900"><?= htmlspecialchars($no_order) ?></td>
						<td class="px-4 py-4">
							<span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
								<?= htmlspecialchars(isset($order['tipe']) ? $order['tipe'] : '-') ?>
							</span>
						</td>
						<td class="px-4 py-4 text-sm text-gray-600"><?= htmlspecialchars($paket) ?></td>
						<td class="px-4 py-4 text-sm text-gray-600"><?= !empty($tgl_masuk) ? date('d/m/Y', strtotime($tgl_masuk)) : '-' ?></td>
						<td class="px-4 py-4 text-sm text-gray-600"><?= !empty($tgl_keluar) ? date('d/m/Y', strtotime($tgl_keluar)) : '-' ?></td>
						<td class="px-4 py-4">
							<span class="inline-flex items-center space-x-1 px-3 py-1 rounded-full text-xs font-semibold <?= $statusClass ?>">
								<i class="fas <?= $statusIcon ?>"></i>
								<span><?= htmlspecialchars($status) ?></span>
							</span>
						</td>
						<td class="px-4 py-4 text-sm font-semibold text-gray-900">Rp <?= number_format($total, 0, ',', '.') ?></td>
						<td class="px-4 py-4">
							<a href="<?= htmlspecialchars($detail_link) ?>" class="inline-flex items-center space-x-1 px-3 py-1.5 bg-primary-500 text-white rounded-lg text-xs font-semibold hover:bg-primary-600 transition-colors">
								<i class="fas fa-eye"></i>
								<span>Detail</span>
							</a>
						</td>
					</tr>
					<?php endforeach; else: ?>
					<tr>
						<td colspan="9" class="px-4 py-8 text-center text-gray-500">
							<i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
							<p>
								<?php if(!empty($search)): ?>
									Tidak ada hasil untuk pencarian "<?= htmlspecialchars($search) ?>"
								<?php else: ?>
									Belum ada order. <a href="order_baru.php" class="text-primary-600 hover:underline font-semibold">Buat order sekarang!</a>
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
		<div class="p-6 bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
			<div class="flex flex-col sm:flex-row justify-between items-center gap-4">
				<div>
					<p class="text-sm text-primary-100 mb-1">Total Transaksi</p>
					<h3 class="text-2xl font-bold"><?= count($all_orders) ?> Order</h3>
				</div>
				<div class="text-right">
					<p class="text-sm text-primary-100 mb-1">Total Belanja</p>
					<h3 class="text-2xl font-bold">Rp <?= number_format($total_belanja, 0, ',', '.') ?></h3>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</main>

<?php require_once('footer_pelanggan.php'); ?>