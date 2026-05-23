<?php
require_once('header_pelanggan.php');

// Ambil nomor order dari URL
$no_ck = $_GET['or_ck_number'];
$data = query("SELECT * FROM tb_order_ck WHERE or_ck_number = '$no_ck'")[0];

// Cek apakah order milik user yang login
if($data['nama_pel_ck'] != $nama_pelanggan){
	echo "<script>
		alert('Anda tidak memiliki akses ke order ini!');
		window.location='riwayat_order.php';
	</script>";
	exit;
}
?>

<!-- Clean Order Detail Page -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<!-- Page Header -->
	<div class="mb-8 flex flex-col gap-4 rounded-[28px] border border-slate-200/80 dark:border-slate-800 bg-white/85 dark:bg-slate-900/75 px-6 py-6 shadow-card backdrop-blur sm:flex-row sm:items-center sm:justify-between lg:px-8">
		<div>
			<h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">Detail Order</h1>
			<p class="text-sm text-slate-600 dark:text-slate-400">No. Order: <?= $data['or_ck_number']?></p>
		</div>
		<a href="riwayat_order.php" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white/90 dark:bg-slate-900 px-4 py-2.5 text-sm font-medium text-slate-700 shadow-soft transition hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">
			<i class="fas fa-arrow-left"></i>
			<span>Kembali</span>
		</a>
	</div>

	<!-- Detail Card -->
	<div class="overflow-hidden rounded-[28px] border border-slate-200/80 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 shadow-card">
		<!-- Customer Info Section -->
		<div class="p-6 border-b border-slate-200 dark:border-slate-800">
			<h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Informasi Customer</h2>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div>
					<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Nama</p>
					<p class="text-sm font-medium text-slate-900 dark:text-white"><?= $data['nama_pel_ck'] ?></p>
				</div>
				<div>
					<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Nomor Telepon</p>
					<p class="text-sm font-medium text-slate-900 dark:text-white"><?= $data['no_telp_ck'] ?></p>
				</div>
				<div class="md:col-span-2">
					<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Alamat</p>
					<p class="text-sm font-medium text-slate-900 dark:text-white"><?= $data['alamat_ck'] ?></p>
				</div>
			</div>
		</div>

		<!-- Order Info Section -->
		<div class="p-6 border-b border-slate-200 dark:border-slate-800">
			<h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Informasi Order</h2>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div>
					<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Tanggal Masuk</p>
					<p class="text-sm font-medium text-slate-900 dark:text-white"><?= date('d/m/Y', strtotime($data['tgl_masuk_ck'])) ?></p>
				</div>
				<div>
					<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Tanggal Keluar</p>
					<p class="text-sm font-medium text-slate-900 dark:text-white"><?= date('d/m/Y', strtotime($data['tgl_keluar_ck'])) ?></p>
				</div>
				<div>
					<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Durasi Kerja</p>
					<p class="text-sm font-medium text-slate-900 dark:text-white"><?= $data['wkt_krj_ck'] ?></p>
				</div>
				<div>
					<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Jenis Paket</p>
					<p class="text-sm font-medium text-slate-900 dark:text-white"><?= $data['jenis_paket_ck'] ?></p>
				</div>
				<div>
					<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Metode Pengambilan</p>
					<p class="text-sm font-medium <?= ($data['metode_pengambilan'] == 'Antar Jemput') ? 'text-orange-600 dark:text-orange-400' : 'text-slate-900 dark:text-white' ?>">
						<?= $data['metode_pengambilan'] ?? 'Ambil di Tempat' ?>
					</p>
				</div>
				<div>
					<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Status</p>
					<?php
					$status = $data['status'] ?? 'Pending';
					$statusClass = 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300';
					if($status == 'Pending') {
						$statusClass = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400';
					} elseif($status == 'Proses') {
						$statusClass = 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400';
					} elseif($status == 'Selesai') {
						$statusClass = 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400';
					}
					?>
					<span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium <?= $statusClass ?>">
						<?= $status ?>
					</span>
				</div>
			</div>
		</div>

		<!-- Payment Info Section -->
		<div class="p-6 border-b border-slate-200 dark:border-slate-800">
			<h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Rincian Pembayaran</h2>
			<div class="rounded-[24px] bg-slate-50 p-4 dark:bg-slate-950/40">
				<div class="grid grid-cols-3 gap-4 text-center">
					<div>
						<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Berat</p>
						<p class="text-lg font-bold text-slate-900 dark:text-white"><?= $data['berat_qty_ck'] ?> Kg</p>
					</div>
					<div>
						<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Harga/Kg</p>
						<p class="text-lg font-bold text-slate-900 dark:text-white">Rp <?= number_format($data['harga_perkilo'], 0, ',', '.') ?></p>
					</div>
					<div>
						<p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Total Bayar</p>
						<p class="text-lg font-bold text-blue-600 dark:text-blue-400">Rp <?= number_format($data['tot_bayar'], 0, ',', '.') ?></p>
					</div>
				</div>
			</div>
		</div>

		<!-- Notes Section -->
		<div class="p-6">
			<h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">Keterangan</h2>
			<p class="text-sm text-slate-600 dark:text-slate-400"><?= $data['keterangan_ck'] ?></p>
		</div>
	</div>
</section>

<?php require_once('footer_pelanggan.php') ?>
