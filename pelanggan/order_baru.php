<?php require_once('header_pelanggan.php'); 

$data_pelanggan = get_pelanggan($id_pelanggan);
?>

<div class="main-content" id="order_pelanggan">
	<div class="container">
		<div class="baris">
			<div class="col mt-2">
				<div class="card">
					<div class="card-title card-flex">
						<div class="card-col">
							<h2>🧺 Buat Order Baru</h2>
						</div>
						<div class="card-col txt-right">
							<a href="dashboard.php" class="btn-xs bg-primary">Kembali</a>
						</div>
					</div>

					<div class="card-body mt-2">
						<div class="col">
							<div class="order-sub-judul txt-center">
								<h3 class="mb-1">Pilih Jenis Paket</h3>
							</div>

							<div class="container-paket">
								<div class="col-paket">
									<a href="order_ck.php" class="paket">
										<img src="<?=url('_assets/img/cuci_komplit.png')?>" alt="cuci komplit" width="160">
										<h4>Cuci Komplit</h4>
										<p style="font-size: 14px; color: #666; margin-top: 10px;">Cuci + Setrika</p>
									</a>
								</div>

								<div class="col-paket">
									<a href="order_dc.php" class="paket">
										<img src="<?=url('_assets/img/dry_clean.png')?>" alt="dry clean" width="160">
										<h4>Dry Clean</h4>
										<p style="font-size: 14px; color: #666; margin-top: 10px;">Cuci Kering</p>
									</a>
								</div>

								<div class="col-paket">
									<a href="order_cs.php" class="paket">
										<img src="<?=url('_assets/img/kemeja_2.png')?>" alt="cuci satuan" width="160">
										<h4>Cuci Satuan</h4>
										<p style="font-size: 14px; color: #666; margin-top: 10px;">Per Item</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer_pelanggan.php'); ?>