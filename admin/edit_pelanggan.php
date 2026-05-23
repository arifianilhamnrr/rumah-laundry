<?php 
	require_once('../_header.php'); 
	
	if(!isset($_SESSION['login']) || $_SESSION['master'] == ''){
		header("Location: ../login.php");
		exit;
	}

	$id = $_GET['id'];
	$data = get_pelanggan($id);

	if(isset($_POST['update'])){
		if(update_pelanggan($_POST) > 0){
			echo "<script>
				alert('Data pelanggan berhasil diupdate!');
				window.location='daftar_pelanggan.php';
			</script>";
		} else {
			echo "<script>alert('Data gagal diupdate!');</script>";
		}
	}
?>

<div id="edit_pelanggan" class="main-content">
	<div class="container">
		<div class="baris">
			<div class="col mt-2">
				<div class="card">
					<div class="card-title card-flex">
						<div class="card-col">
							<h2>✏️ Edit Data Pelanggan</h2>	
						</div>
						<div class="card-col txt-right">
							<a href="daftar_pelanggan.php" class="btn-xs bg-primary">Kembali</a>
						</div>
					</div>

					<div class="card-body">
						<form action="" method="post" class="form-input">
							<input type="hidden" name="id_pelanggan" value="<?= $data['id_pelanggan'] ?>">
							
							<div class="form-grup">
								<label for="nama">Nama Lengkap</label>
								<input type="text" name="nama_lengkap" id="nama" value="<?= $data['nama_lengkap'] ?>" required autocomplete="off">
							</div>

							<div class="form-grup">
								<label for="email">Email</label>
								<input type="email" name="email" id="email" value="<?= $data['email'] ?>" required autocomplete="off">
							</div>

							<div class="form-grup">
								<label for="no_telp">Nomor Telepon</label>
								<input type="text" name="no_telp" id="no_telp" value="<?= $data['no_telp'] ?>" required autocomplete="off">
							</div>

							<div class="form-grup">
								<label for="alamat">Alamat</label>
								<textarea name="alamat" id="alamat" rows="4" required><?= $data['alamat'] ?></textarea>
							</div>

							<div class="form-grup">
								<label>Username</label>
								<input type="text" value="<?= $data['username'] ?>" disabled style="background: #f0f0f0;">
								<small style="color: #666;">Username tidak dapat diubah</small>
							</div>

							<div class="form-grup">
								<button type="submit" name="update" class="mt-1">Update Data</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('../_footer.php'); ?>