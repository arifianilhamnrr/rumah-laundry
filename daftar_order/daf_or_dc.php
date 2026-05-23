<div class="bg-white rounded-xl shadow-lg overflow-hidden">
	<!-- Card Header -->
	<div class="p-6 border-b border-gray-200 bg-gradient-to-r from-primary-50 to-secondary-50">
		<h2 class="text-xl font-bold text-gray-900 flex items-center">
			<i class="fas fa-wind text-purple-600 mr-3"></i>
			Order Dry Clean
		</h2>
	</div>

	<div class="p-6">
		<!-- Search & Print Section -->
		<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
			<!-- Search Form -->
			<form method="GET" class="flex gap-2 items-center flex-1">
				<input type="text" name="cari_dc" placeholder="Cari order (nama / nomor / paket)"
					value="<?= isset($_GET['cari_dc']) ? $_GET['cari_dc'] : ''; ?>"
					class="flex-1 min-w-[240px] px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-primary-500/10 transition-all">
				<button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition-colors">
					<i class="fas fa-search mr-1"></i>Cari
				</button>
				<a href="index.php" class="px-4 py-2 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 transition-colors">
					<i class="fas fa-redo mr-1"></i>Reset
				</a>
			</form>

			<!-- Print Form -->
			<form action="laporan_dc.php" method="GET" target="_blank" class="flex gap-2 items-center">
				<input type="month" name="bulan" required class="px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition-all">
				<button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg font-semibold hover:bg-green-600 transition-colors">
					<i class="fas fa-print mr-1"></i>Cetak
				</button>
			</form>
		</div>

		<!-- Table -->
		<div class="overflow-x-auto">
			<table class="w-full">
				<thead class="bg-gradient-to-r from-purple-500 to-purple-600 text-white">
					<tr>
						<th class="px-4 py-3 text-left text-sm font-semibold">No</th>
						<th class="px-4 py-3 text-left text-sm font-semibold">No.Order</th>
						<th class="px-4 py-3 text-left text-sm font-semibold">Tgl Order</th>
						<th class="px-4 py-3 text-left text-sm font-semibold">Nama Pelanggan</th>
						<th class="px-4 py-3 text-left text-sm font-semibold">Jenis Paket</th>
						<th class="px-4 py-3 text-left text-sm font-semibold">Waktu Kerja</th>
						<th class="px-4 py-3 text-left text-sm font-semibold">Berat (Kg)</th>
						<th class="px-4 py-3 text-left text-sm font-semibold">Metode</th>
						<th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
						<th class="px-4 py-3 text-left text-sm font-semibold">Action</th>
					</tr>
				</thead>

				<tbody class="divide-y divide-gray-200">
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
						<tr class="hover:bg-gray-50 transition-colors">
							<td class="px-4 py-3 text-sm text-gray-900"><?= $no_dc; ?></td>
							<td class="px-4 py-3 text-sm font-semibold text-gray-900"><?= $ck['or_dc_number'] ?></td>
							<td class="px-4 py-3 text-sm text-gray-600"><?= $ck['tgl_masuk_dc'] ?></td>
							<td class="px-4 py-3 text-sm text-gray-600"><?= $ck['nama_pel_dc'] ?></td>
							<td class="px-4 py-3 text-sm text-gray-600"><?= $ck['jenis_paket_dc'] ?></td>
							<td class="px-4 py-3 text-sm text-gray-600"><?= $ck['wkt_krj_dc'] ?></td>
							<td class="px-4 py-3 text-sm text-gray-600"><?= $ck['berat_qty_dc'] . ' Kg' ?></td>

							<!-- Metode Pengambilan -->
							<td class="px-4 py-3 text-sm">
								<?php
								$metode = isset($ck['metode_pengambilan']) ? $ck['metode_pengambilan'] : 'Ambil di Tempat';
								$icon = ($metode == 'Antar Jemput') ? 'fa-truck' : 'fa-home';
								$color = ($metode == 'Antar Jemput') ? 'text-orange-600' : 'text-green-600';
								?>
								<span class="inline-flex items-center space-x-1 <?= $color ?> font-semibold">
									<i class="fas <?= $icon ?>"></i>
									<span><?= $metode ?></span>
								</span>
							</td>

							<!-- Status Badge -->
							<td class="px-4 py-3">
								<?php
								$status = $ck['status'] ?? 'Pending';
								$badge_class = '';
								if($status == 'Pending') {
									$badge_class = 'bg-yellow-100 text-yellow-800';
								} elseif($status == 'Diproses') {
									$badge_class = 'bg-blue-100 text-blue-800';
								} elseif($status == 'Selesai') {
									$badge_class = 'bg-green-100 text-green-800';
								} elseif($status == 'Sedang Diantar') {
									$badge_class = 'bg-orange-100 text-orange-800';
								} elseif($status == 'Diambil') {
									$badge_class = 'bg-gray-100 text-gray-800';
								}
								?>
								<span class="inline-block px-3 py-1 rounded-full text-xs font-semibold <?= $badge_class ?>">
									<?= $status ?>
								</span>
							</td>

							<!-- Action Buttons -->
							<td class="px-4 py-3">
								<div class="flex flex-col space-y-2">
									<div class="flex space-x-2">
										<a href="<?=url('detail_order/detail_dc/detail_order_dc.php?or_dc_number=')?><?=$ck['or_dc_number']?>" class="inline-flex items-center space-x-1 px-3 py-1.5 bg-blue-500 text-white rounded-lg text-xs font-semibold hover:bg-blue-600 transition-colors">
											<i class="fas fa-eye"></i>
											<span>Detail</span>
										</a>
										<a href="<?=url('daftar_order/hapus_dc.php?or_dc_number=')?><?=$ck['or_dc_number']?>" onclick="return confirm('Yakin akan menghapus?');" class="inline-flex items-center space-x-1 px-3 py-1.5 bg-red-500 text-white rounded-lg text-xs font-semibold hover:bg-red-600 transition-colors">
											<i class="fas fa-trash"></i>
											<span>Hapus</span>
										</a>
									</div>
									<!-- Status Dropdown -->
									<select onchange="updateStatus(this.value, '<?=$ck['or_dc_number']?>', 'ck')" class="px-3 py-1.5 border-2 border-gray-300 rounded-lg text-xs focus:outline-none focus:border-purple-500 transition-all">
										<option value="">-- Update Status --</option>
										<option value="Pending" <?= (isset($ck['status']) && $ck['status'] == 'Pending') ? 'selected' : '' ?>><i class="fas fa-clock"></i> Pending</option>
										<option value="Diproses" <?= (isset($ck['status']) && $ck['status'] == 'Diproses') ? 'selected' : '' ?>><i class="fas fa-spinner"></i> Diproses</option>
										<option value="Selesai" <?= (isset($ck['status']) && $ck['status'] == 'Selesai') ? 'selected' : '' ?>><i class="fas fa-check"></i> Selesai</option>
										<option value="Sedang Diantar" <?= (isset($ck['status']) && $ck['status'] == 'Sedang Diantar') ? 'selected' : '' ?>><i class="fas fa-truck"></i> Sedang Diantar</option>
										<option value="Diambil" <?= (isset($ck['status']) && $ck['status'] == 'Diambil') ? 'selected' : '' ?>><i class="fas fa-box"></i> Diambil</option>
									</select>
								</div>
							</td>
						</tr>
					<?php $no_dc++; endforeach; else : ?>
						<tr>
							<td colspan="10" class="px-4 py-8 text-center text-gray-500">
								<i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
								<p>Data Tidak Tersedia</p>
							</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Script JavaScript -->
<script>
	function updateStatus(status, noOrder, tipe){
		if(status != ''){
			if(confirm('Update status order menjadi: ' + status + '?')){
				window.location = '<?=url('admin/update_status_order.php')?>?tipe=' + tipe + '&no_order=' + noOrder + '&status=' + status;
			}
		}
	}
</script>