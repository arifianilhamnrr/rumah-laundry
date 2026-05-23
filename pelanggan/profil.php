<?php require_once('header_pelanggan.php'); 

$data_pelanggan = get_pelanggan($id_pelanggan);

if(isset($_POST['update_profil'])){
	if(update_pelanggan($_POST) > 0){
		echo "<script>
			alert('Profil berhasil diupdate!');
			window.location='profil.php';
		</script>";
	} else {
		echo "<script>alert('Profil gagal diupdate!');</script>";
	}
}
?>

<div id="profil_pelanggan" class="main-content">
	<div class="container">
		<div class="baris">
			<div class="col mt-2">
				<div class="card">
					<div class="card-title card-flex">
						<div class="card-col">
							<h2>👤 Profil Saya</h2>
						</div>
						<div class="card-col txt-right">
							<a href="dashboard.php" class="btn-xs bg-primary">Kembali</a>
						</div>
					</div>

					<div class="card-body">
						<form action="" method="post" class="form-input">
							<input type="hidden" name="id_pelanggan" value="<?= $data_pelanggan['id_pelanggan'] ?>">
							
							<div class="form-grup">
								<label for="nama">Nama Lengkap</label>
								<input type="text" name="nama_lengkap" id="nama" value="<?= $data_pelanggan['nama_lengkap'] ?>" required autocomplete="off">
							</div>

							<div class="form-grup">
								<label for="email">Email</label>
								<input type="email" name="email" id="email" value="<?= $data_pelanggan['email'] ?>" required autocomplete="off">
							</div>

							<div class="form-grup">
								<label for="no_telp">Nomor Telepon</label>
								<input type="text" name="no_telp" id="no_telp" value="<?= $data_pelanggan['no_telp'] ?>" required autocomplete="off">
							</div>

							<div class="form-grup">
								<label for="alamat">Alamat</label>
								<textarea name="alamat" id="alamat" rows="4" required><?= $data_pelanggan['alamat'] ?></textarea>
							</div>

							<div class="form-grup">
								<label>Username</label>
								<input type="text" value="<?= $data_pelanggan['username'] ?>" disabled style="background: #f0f0f0;">
								<small style="color: #666;">Username tidak dapat diubah</small>
							</div>

							<div class="form-grup">
								<label>Tanggal Daftar</label>
								<input type="text" value="<?= date('d F Y', strtotime($data_pelanggan['tanggal_daftar'])) ?>" disabled style="background: #f0f0f0;">
							</div>

							<div class="form-grup">
								<button type="submit" name="update_profil" class="mt-1">Update Profil</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer_pelanggan.php'); ?>