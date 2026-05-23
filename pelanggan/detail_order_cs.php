<?php 
require_once('header_pelanggan.php'); 

$no_cs = $_GET['or_cs_number'];
$data = query("SELECT * FROM tb_order_cs WHERE or_cs_number = '$no_cs'")[0];

// Cek apakah order milik user yang login
if($data['nama_pel_cs'] != $nama_pelanggan){
	echo "<script>
		alert('Anda tidak memiliki akses ke order ini!');
		window.location='riwayat_order.php';
	</script>";
	exit;
}
?>

<div id="detail_or_cs" class="main-content">
	<div class="container">
		<div class="baris">
			<div class="col mt-2">
				<div class="card-md">
					<div class="card-title card-flex">
						<div class="card-col">
							<h2>📦 Detail Order</h2>	
						</div>

						<div class="card-col txt-right">
							<h3 class="no-order"><small>No Order : </small><?= $data['or_cs_number']?></h3>	
						</div>
					</div>

					<div class="card-body">
						<div class="jdl-or">
							<h4>Customer</h4>
						</div>
						<table class="tb-detail_customer">   
							<tr>
								<th>Nama</th>
								<td><?= $data['nama_pel_cs'] ?></td>
							</tr>

							<tr>
								<th>Nomor Telepon</th>
								<td><?= $data['no_telp_cs'] ?></td>
							</tr>

							<tr>
								<th>Alamat</th>
								<td><?= $data['alamat_cs'] ?></td>
							</tr>

							<tr>
								<th>Order Masuk</th>
								<td><?= date('d/m/Y', strtotime($data['tgl_masuk_cs'])) ?></td>
							</tr>

							<tr>
								<th>Diambil Pada</th>
								<td><?= date('d/m/Y', strtotime($data['tgl_keluar_cs'])) ?></td>
							</tr>
							
							<tr>
								<th>Durasi Kerja</th>
								<td><?= $data['wkt_krj_cs'] ?></td>
							</tr>

							<tr>
								<th>Jenis Paket</th>
								<td><?= $data['jenis_paket_cs'] ?></td>
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
								<th>Jumlah (Pcs)</th>
								<th>Harga Per-Pcs</th>
								<th>Total Bayar</th>
							</tr>

							<tr>
								<td><?= $data['jml_pcs'] . ' Pcs'?></td>
								<td>Rp <?= number_format($data['harga_perpcs'], 0, ',', '.') ?></td>
								<td><strong>Rp <?= number_format($data['tot_bayar'], 0, ',', '.') ?></strong></td>
							</tr>
						</table>

						<div class="details">
							<h4 class="mb-01">Keterangan:</h4>
							<p class="lead"><?= $data['keterangan_cs'] ?></p>
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