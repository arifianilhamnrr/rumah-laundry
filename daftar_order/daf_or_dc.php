<div class="bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm">
	<!-- Card Header -->
	<div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
		<h2 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center">
			<i class="fas fa-wind text-purple-600 dark:text-purple-400 mr-2"></i>
			Order Dry Clean
		</h2>
	</div>

	<div class="p-6">
		<!-- Search & Print Section -->
		<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 mb-4">
			<!-- Search Form -->
			<form method="GET" class="flex gap-2 items-center flex-1">
				<input type="text" name="cari_dc" placeholder="Cari order..."
					value="<?= isset($_GET['cari_dc']) ? $_GET['cari_dc'] : ''; ?>"
					class="flex-1 min-w-[200px] px-3 py-2 text-sm border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400">
				<button type="submit" class="px-4 py-2 text-sm bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium transition-colors">
					<i class="fas fa-search mr-1"></i>Cari
				</button>
				<a href="index.php" class="px-4 py-2 text-sm bg-slate-200 hover:bg-slate-300 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 rounded-lg font-medium transition-colors">
					<i class="fas fa-redo mr-1"></i>Reset
				</a>
			</form>

			<!-- Print Form -->
			<form action="laporan_dc.php" method="GET" target="_blank" class="flex gap-2 items-center">
				<input type="month" name="bulan" required class="px-3 py-2 text-sm border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500">
				<button type="submit" class="px-4 py-2 text-sm bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
					<i class="fas fa-print mr-1"></i>Cetak
				</button>
			</form>
		</div>

		<!-- Table -->
		<div class="overflow-x-auto">
			<table class="w-full text-sm">
				<thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-600">
					<tr>
						<th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">No</th>
						<th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">No.Order</th>
						<th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Tgl Order</th>
						<th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Nama</th>
						<th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Paket</th>
						<th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Waktu</th>
						<th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Berat</th>
						<th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Metode</th>
						<th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Status</th>
						<th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Action</th>
					</tr>
				</thead>

				<tbody class="divide-y divide-slate-200 dark:divide-slate-700">
					<?php
					$where = "";
					if (!empty($_GET['cari_dc'])) {
						$cari = mysqli_real_escape_string($koneksi, $_GET['cari_dc']);
						$where = "WHERE or_dc_number LIKE '%$cari%' OR nama_pel_dc LIKE '%$cari%' OR jenis_paket_dc LIKE '%$cari%'";
					}

					$cuci_komplit = query("SELECT * FROM tb_order_dc $where ORDER BY id_order_dc DESC");
					if (!empty($cuci_komplit)) :
						$no_dc = 1;
						foreach($cuci_komplit as $ck) : ?>
						<tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
							<td class="px-4 py-3 text-slate-900 dark:text-slate-100"><?= $no_dc; ?></td>
							<td class="px-4 py-3 font-medium text-slate-900 dark:text-slate-100"><?= $ck['or_dc_number'] ?></td>
							<td class="px-4 py-3 text-slate-600 dark:text-slate-400"><?= $ck['tgl_masuk_dc'] ?></td>
							<td class="px-4 py-3 text-slate-600 dark:text-slate-400"><?= $ck['nama_pel_dc'] ?></td>
							<td class="px-4 py-3 text-slate-600 dark:text-slate-400"><?= $ck['jenis_paket_dc'] ?></td>
							<td class="px-4 py-3 text-slate-600 dark:text-slate-400"><?= $ck['wkt_krj_dc'] ?></td>
							<td class="px-4 py-3 text-slate-600 dark:text-slate-400"><?= $ck['berat_qty_dc'] . ' Kg' ?></td>

							<!-- Metode -->
							<td class="px-4 py-3">
								<?php
								$metode = isset($ck['metode_pengambilan']) ? $ck['metode_pengambilan'] : 'Ambil di Tempat';
								$icon = ($metode == 'Antar Jemput') ? 'fa-truck' : 'fa-home';
								$color = ($metode == 'Antar Jemput') ? 'text-orange-600 dark:text-orange-400' : 'text-green-600 dark:text-green-400';
								?>
								<span class="inline-flex items-center space-x-1 text-xs <?= $color ?> font-medium">
									<i class="fas <?= $icon ?>"></i>
									<span><?= $metode ?></span>
								</span>
							</td>

							<!-- Status -->
							<td class="px-4 py-3">
								<?php
								$status = $ck['status'] ?? 'Pending';
								$badge_class = '';
								if($status == 'Pending') {
									$badge_class = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400';
								} elseif($status == 'Diproses') {
									$badge_class = 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-purple-400';
								} elseif($status == 'Selesai') {
									$badge_class = 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400';
								} elseif($status == 'Sedang Diantar') {
									$badge_class = 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400';
								} elseif($status == 'Diambil') {
									$badge_class = 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300';
								}
								?>
								<span class="inline-block px-2 py-1 rounded-md text-xs font-medium <?= $badge_class ?>">
									<?= $status ?>
								</span>
							</td>

							<!-- Action -->
							<td class="px-4 py-3">
								<div class="flex flex-col space-y-2">
									<div class="flex space-x-1">
										<a href="<?=url('detail_order/detail_dc/detail_order_dc.php?or_dc_number=')?><?=$ck['or_dc_number']?>" class="inline-flex items-center px-2 py-1 bg-purple-600 hover:bg-purple-700 text-white rounded text-xs font-medium transition-colors">
											<i class="fas fa-eye text-xs"></i>
										</a>
										<a href="<?=url('daftar_order/hapus_dc.php?or_dc_number=')?><?=$ck['or_dc_number']?>" onclick="return confirm('Yakin akan menghapus?');" class="inline-flex items-center px-2 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-medium transition-colors">
											<i class="fas fa-trash text-xs"></i>
										</a>
									</div>
									<select onchange="updateStatus(this.value, '<?=$ck['or_dc_number']?>', 'ck')" class="px-2 py-1 text-xs border border-slate-300 dark:border-slate-600 rounded bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
										<option value="">Update Status</option>
										<option value="Pending" <?= (isset($ck['status']) && $ck['status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
										<option value="Diproses" <?= (isset($ck['status']) && $ck['status'] == 'Diproses') ? 'selected' : '' ?>>Diproses</option>
										<option value="Selesai" <?= (isset($ck['status']) && $ck['status'] == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
										<option value="Sedang Diantar" <?= (isset($ck['status']) && $ck['status'] == 'Sedang Diantar') ? 'selected' : '' ?>>Sedang Diantar</option>
										<option value="Diambil" <?= (isset($ck['status']) && $ck['status'] == 'Diambil') ? 'selected' : '' ?>>Diambil</option>
									</select>
								</div>
							</td>
						</tr>
					<?php $no_dc++; endforeach; else : ?>
						<tr>
							<td colspan="10" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">
								<i class="fas fa-inbox text-3xl mb-2 text-slate-300 dark:text-slate-600"></i>
								<p class="text-sm">Data Tidak Tersedia</p>
							</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	function updateStatus(status, noOrder, tipe){
		if(status != ''){
			if(confirm('Update status order menjadi: ' + status + '?')){
				window.location = '<?=url('admin/update_status_order.php')?>?tipe=' + tipe + '&no_order=' + noOrder + '&status=' + status;
			}
		}
	}
</script>