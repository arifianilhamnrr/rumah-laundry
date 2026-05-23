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

<div id="riwayat_order" class="main-content">
	<div class="container">
		<div class="baris">
			<div class="col">
				<div class="card">
					<div class="card-title card-flex">
						<div class="card-col">
							<h2>📋 Riwayat Order Saya</h2>
						</div>
						<div class="card-col txt-right">
							<a href="dashboard.php" class="btn-xs bg-primary">Kembali</a>
						</div>
					</div>

					<div class="card-body">
						<!-- Search Bar -->
						<div style="margin-bottom: 20px;">
							<form method="GET" style="display: flex; gap: 10px;">
								<input type="text" name="search" placeholder="Cari nomor order atau jenis paket..." 
									value="<?= $search ?>" 
									style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
								<button type="submit" style="padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer;">
									🔍 Cari
								</button>
								<?php if(!empty($search)): ?>
								<a href="riwayat_order.php" style="padding: 10px 20px; background: #ddd; color: #333; border: none; border-radius: 5px; text-decoration: none; display: inline-block;">
									Reset
								</a>
								<?php endif; ?>
							</form>
						</div>

						<div class="tabel-kontainer">
							<table class="tabel-transaksi">
								<thead>
									<tr>
										<th class="sticky">No</th>
										<th class="sticky">No. Order</th>
										<th class="sticky">Tipe Layanan</th>
										<th class="sticky">Jenis Paket</th>
										<th class="sticky">Tanggal Masuk</th>
										<th class="sticky">Tanggal Keluar</th>
										<th class="sticky">Status</th>
										<th class="sticky">Total</th>
										<th class="sticky">Action</th>
									</tr>
								</thead>
								<tbody>
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

											// Status badge class
											$status_class = 'status-' . strtolower($status);
									?>
									<tr>
										<td><?= $no++ ?></td>
										<td><strong><?= $no_order ?></strong></td>
										<td>
											<span style="background: #e3f2fd; color: #1976d2; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
												<?= isset($order['tipe']) ? $order['tipe'] : '-' ?>
											</span>
										</td>
										<td><?= $paket ?></td>
										<td><?= !empty($tgl_masuk) ? date('d/m/Y', strtotime($tgl_masuk)) : '-' ?></td>
										<td><?= !empty($tgl_keluar) ? date('d/m/Y', strtotime($tgl_keluar)) : '-' ?></td>
										<td>
											<span class="status-badge <?= $status_class ?>">
												<?= $status ?>
											</span>
										</td>
										<td><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
										<td>
											<a href="<?= $detail_link ?>" class="btn btn-detail">Detail</a>
										</td>
									</tr>
									<?php endforeach; else: ?>
									<tr>
										<td colspan="9" class="txt-center">
											<?php if(!empty($search)): ?>
												Tidak ada hasil untuk pencarian "<?= $search ?>"
											<?php else: ?>
												Belum ada order. <a href="order_baru.php" style="color: #667eea; font-weight: 600;">Buat order sekarang!</a>
											<?php endif; ?>
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
						<div style="margin-top: 20px; padding: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 10px; display: flex; justify-content: space-between; align-items: center;">
							<div>
								<p style="margin: 0; font-size: 14px; opacity: 0.9;">Total Transaksi</p>
								<h3 style="margin: 5px 0 0 0; font-size: 24px;"><?= count($all_orders) ?> Order</h3>
							</div>
							<div style="text-align: right;">
								<p style="margin: 0; font-size: 14px; opacity: 0.9;">Total Belanja</p>
								<h3 style="margin: 5px 0 0 0; font-size: 24px;">Rp <?= number_format($total_belanja, 0, ',', '.') ?></h3>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer_pelanggan.php'); ?>