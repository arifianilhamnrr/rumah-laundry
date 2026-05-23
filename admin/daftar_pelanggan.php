<?php 
	require_once('../_header.php'); 
	
	// Cek apakah admin
	if(!isset($_SESSION['login']) || $_SESSION['master'] == ''){
		header("Location: ../login.php");
		exit;
	}

	// Ambil semua pelanggan
	$data_pelanggan = query('SELECT * FROM pelanggan ORDER BY tanggal_daftar DESC');
?>

<div id="daftar_pelanggan" class="main-content">
	<div class="container">
		<div class="baris">
			<div class="selamat-datang">
				<div class="col-header">
					<h2 class="judul-md">👥 Daftar Pelanggan Terdaftar</h2>
					<p style="font-size: 14px; color: #666;">Total: <?= count($data_pelanggan) ?> Pelanggan</p>
				</div>
			</div>
		</div>

		<div class="baris">
			<div class="col">
				<div class="card">
					<div class="card-title card-flex">
						<div class="card-col">
							<h2>Data Pelanggan</h2>	
						</div>
						<div class="card-col txt-right">
							<a href="<?=url()?>" class="btn-xs bg-primary">Kembali ke Dashboard</a>
						</div>
					</div>

					<div class="card-body">
						<div class="tabel-kontainer">
							<table class="tabel-transaksi">
								<thead>
									<tr>
										<th class="sticky">No</th>
										<th class="sticky">Nama Lengkap</th>
										<th class="sticky">Username</th>
										<th class="sticky">Email</th>
										<th class="sticky">No. Telepon</th>
										<th class="sticky">Alamat</th>
										<th class="sticky">Tanggal Daftar</th>
										<th class="sticky">Action</th>
									</tr>
								</thead>

								<tbody>
									<?php if(!empty($data_pelanggan)): ?>
										<?php $no = 1; ?>
										<?php foreach($data_pelanggan as $pelanggan): ?>
											<tr>
												<td><?= $no ?></td>
												<td><?= $pelanggan['nama_lengkap'] ?></td>
												<td><strong><?= $pelanggan['username'] ?></strong></td>
												<td><?= $pelanggan['email'] ?></td>
												<td><?= $pelanggan['no_telp'] ?></td>
												<td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
													<?= $pelanggan['alamat'] ?>
												</td>
												<td><?= date('d/m/Y H:i', strtotime($pelanggan['tanggal_daftar'])) ?></td>
												<td>
													<a href="<?=url('admin/edit_pelanggan.php')?>?id=<?=$pelanggan['id_pelanggan']?>" class="btn btn-edit">Edit</a>
													<a href="<?=url('admin/hapus_pelanggan.php')?>?id=<?=$pelanggan['id_pelanggan']?>" onclick="return confirm('Yakin akan menghapus pelanggan ini?');" class="btn btn-hapus">Hapus</a>
												</td>
											</tr>
											<?php $no++ ?>
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td colspan="8" class="txt-center">Belum ada pelanggan terdaftar</td>
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

<?php require_once('../_footer.php'); ?>