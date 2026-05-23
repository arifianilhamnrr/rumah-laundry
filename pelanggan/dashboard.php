<?php require_once('header_pelanggan.php'); ?>

<div id="main" class="main-content">
	<div class="container">
		<!-- Welcome Card -->
		<div class="baris">
			<div class="col">
				<div class="welcome-card">
					<h2>👋 Selamat Datang, <?= $nama_pelanggan ?>!</h2>
					<p>Kelola pesanan laundry Anda dengan mudah dan cepat</p>
				</div>
			</div>
		</div>

		<!-- Info Cards -->
		<div class="baris">
			<div class="col col-4">
				<div class="card">
					<div class="card-body">
						<div class="card-panel">
							<div class="panel-header">
								<p>Total Order Saya</p>
								<h2><?= count(get_order_pelanggan($nama_pelanggan)) ?></h2>
							</div>
							<div class="panel-icon">
								<img src="<?=url('_assets/img/total_order.png')?>" alt="order" height="48">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col col-4">
				<div class="card">
					<div class="card-body">
						<div class="card-panel">
							<div class="panel-header">
								<p>Paket Tersedia</p>
								<h2><?= jmlPaket(); ?></h2>
							</div>
							<div class="panel-icon">
								<img src="<?=url('_assets/img/jumlah_paket.png')?>" alt="paket" height="48">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col col-4">
				<div class="card">
					<div class="card-body">
						<div class="card-panel">
							<div class="panel-header">
								<p>Status Akun</p>
								<h2 style="font-size: 18px;">✅ Aktif</h2>
							</div>
							<div class="panel-icon">
								<img src="<?=url('_assets/img/team.png')?>" alt="status" height="48">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Quick Actions -->
		<div class="baris">
			<div class="col">
				<div class="card">
					<div class="card-title">
						<h2>🚀 Menu Cepat</h2>
					</div>
					<div class="card-body">
						<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; padding: 10px;">
							<a href="order_baru.php" style="text-decoration: none;">
								<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 10px; text-align: center; transition: transform 0.3s;">
									<h3 style="margin: 0 0 10px 0; font-size: 24px;">🧺</h3>
									<h4 style="margin: 0;">Order Baru</h4>
									<p style="margin: 10px 0 0 0; font-size: 14px; opacity: 0.9;">Pesan layanan laundry</p>
								</div>
							</a>

							<a href="riwayat_order.php" style="text-decoration: none;">
								<div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 30px; border-radius: 10px; text-align: center; transition: transform 0.3s;">
									<h3 style="margin: 0 0 10px 0; font-size: 24px;">📋</h3>
									<h4 style="margin: 0;">Riwayat Order</h4>
									<p style="margin: 10px 0 0 0; font-size: 14px; opacity: 0.9;">Lihat pesanan Anda</p>
								</div>
							</a>

							<a href="profil.php" style="text-decoration: none;">
								<div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 30px; border-radius: 10px; text-align: center; transition: transform 0.3s;">
									<h3 style="margin: 0 0 10px 0; font-size: 24px;">👤</h3>
									<h4 style="margin: 0;">Profil Saya</h4>
									<p style="margin: 10px 0 0 0; font-size: 14px; opacity: 0.9;">Edit profil Anda</p>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Recent Orders -->
		<div class="baris">
			<div class="col">
				<div class="card">
					<div class="card-title card-flex">
						<div class="card-col">
							<h2>📦 Order Terbaru</h2>
						</div>
						<div class="card-col txt-right">
							<a href="riwayat_order.php" class="btn-xs bg-primary">Lihat Semua</a>
						</div>
					</div>

					<div class="card-body">
						<div class="tabel-kontainer">
							<table class="tabel-transaksi">
								<thead>
									<tr>
										<th class="sticky">No. Order</th>
										<th class="sticky">Tanggal</th>
										<th class="sticky">Jenis Paket</th>
										<th class="sticky">Status</th>
										<th class="sticky">Total</th>
									</tr>
								</thead>
								<tbody>
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
									?>
									<tr>
										<td><?= $no_order ?></td>
										<td><?= $tgl ?></td>
										<td><?= $paket ?></td>
										<td><span class="status-badge status-<?= strtolower($status) ?>"><?= $status ?></span></td>
										<td>Rp <?= number_format($total, 0, ',', '.') ?></td>
									</tr>
									<?php endforeach; else: ?>
									<tr>
										<td colspan="5" class="txt-center">Belum ada order. <a href="order_baru.php">Buat order sekarang!</a></td>
									</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<?php require_once('footer_pelanggan.php'); ?>