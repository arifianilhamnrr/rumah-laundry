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

<div id="detail_or_ck" class="main-content">
	<div class="container">
		<div class="baris">
			<div class="col mt-2">
				<div class="card-md">
					<div class="card-title card-flex">
						<div class="card-col">
							<h2>📦 Detail Order</h2>	
						</div>

						<div class="card-col txt-right">
							<h3 class="no-order"><small>No Order : </small><?= $data['or_ck_number']?></h3>	
						</div>
					</div>

					<div class="card-body">
						<div class="jdl-or">
							<h4>Customer</h4>
						</div>
						<table class="tb-detail_customer">   
							<tr>
								<th>Nama</th>
								<td><?= $data['nama_pel_ck'] ?></td>
							</tr>

							<tr>
								<th>Nomor Telepon</th>
								<td><?= $data['no_telp_ck'] ?></td>
							</tr>

							<tr>
								<th>Alamat</th>
								<td><?= $data['alamat_ck'] ?></td>
							</tr>

							<tr>
								<th>Order Masuk</th>
								<td><?= date('d/m/Y', strtotime($data['tgl_masuk_ck'])) ?></td>
							</tr>

							<tr>
								<th>Diambil Pada</th>
								<td><?= date('d/m/Y', strtotime($data['tgl_keluar_ck'])) ?></td>
							</tr>
							
							<tr>
								<th>Durasi Kerja</th>
								<td><?= $data['wkt_krj_ck'] ?></td>
							</tr>

							<tr>
								<th>Jenis Paket</th>
								<td><?= $data['jenis_paket_ck'] ?></td>
							</tr>

							<tr>
								<th>Metode Pengambilan</th>
								<td>
									<input type="text" disabled value="<?= $data['metode_pengambilan'] ?? 'Ambil di Tempat' ?>" 
									style="<?= ($data['metode_pengambilan'] == 'Antar Jemput') ? 'color: #e17055; font-weight: 600;' : '' ?>">
								</td>
							</tr>

							<tr>
								<th>Status</th>
								<td>
									<?php 
									$status = $data['status'] ?? 'Pending';
									$status_class = 'status-' . strtolower($status);
									?>
									<span class="status-badge <?= $status_class ?>">
										<?= $status ?>
									</span>
								</td>
							</tr>
						</table>

						<div class="mt-1"></div>
						
						<div class="jdl-or">
							<h4>Order</h4>
						</div>
						
						<table class="tb-detail_order">   
							<tr>
								<th>Berat (Kg)</th>
								<th>Harga Per-Kg</th>
								<th>Total Bayar</th>
							</tr>

							<tr>
								<td><?= $data['berat_qty_ck'] . ' Kg'?></td>
								<td>Rp <?= number_format($data['harga_perkilo'], 0, ',', '.') ?></td>
								<td><strong>Rp <?= number_format($data['tot_bayar'], 0, ',', '.') ?></strong></td>
							</tr>
						</table>

						<div class="details">
							<h4 class="mb-01">Keterangan:</h4>
							<p class="lead"><?= $data['keterangan_ck'] ?></p>
						</div>

						<div class="form-footer_detail">
							<div class="buttons">
								<a href="riwayat_order.php" class="btn-sm bg-primary">Kembali ke Riwayat</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer_pelanggan.php') ?>