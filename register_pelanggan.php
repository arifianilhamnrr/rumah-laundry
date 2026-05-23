<?php 
	require_once('_functions.php');

	// Jika sudah login, redirect
	if(isset($_SESSION['login_pelanggan'])){
		header("Location: pelanggan/dashboard.php");
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daftar Akun Pelanggan | Rumah Laundry</title>
	<link rel="stylesheet" href="<?=url('_assets/css/login.css')?>">
	<link rel="shortcut icon" href="<?= url('_assets/img/logo/nav-logo.png') ?>" type="image/x-icon">
	<style>
		.input-form {
			position: relative;
		}
		
		.toggle-password {
			position: absolute;
			right: 15px;
			top: 50%;
			transform: translateY(-50%);
			cursor: pointer;
			user-select: none;
			color: #666;
			font-size: 18px;
		}
		
		.toggle-password:hover {
			color: #333;
		}

		.box__left-form {
			max-height: 450px;
			overflow-y: auto;
			padding-right: 10px;
		}

		/* Scrollbar styling */
		.box__left-form::-webkit-scrollbar {
			width: 6px;
		}

		.box__left-form::-webkit-scrollbar-track {
			background: #f1f1f1;
			border-radius: 10px;
		}

		.box__left-form::-webkit-scrollbar-thumb {
			background: #888;
			border-radius: 10px;
		}

		.box__left-form::-webkit-scrollbar-thumb:hover {
			background: #555;
		}

		.link-login {
			text-align: center;
			margin-top: 15px;
			font-size: 14px;
		}

		.link-login a {
			color: #007bff;
			text-decoration: none;
			font-weight: 600;
		}

		.link-login a:hover {
			text-decoration: underline;
		}
	</style>
</head>
<body>

	<?php 
		if(isset($_POST['daftar'])){
			if(register_pelanggan($_POST) > 0){
				echo "
					<script>
						alert('Pendaftaran berhasil! Silakan login.');
						window.location='login_pelanggan.php';
					</script>
				";
			}
		}
	?>

	<div class="box">
		<div class="box-content">
			<div class="col box__left">
				<div class="logo">
					<img src="<?= url('_assets/img/logo/nav-logo.png') ?>" alt="">
				</div>
				<div class="box__left-title">
					<h4>Daftar Akun Pelanggan</h4>
					<p style="font-size: 13px; color: #666;">Buat akun untuk memesan layanan laundry</p>
				</div>

				<div class="box__left-form">
					<form action="" method="post">
						<div class="box__left-form-group">
							<div class="input-form">
								<input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required autocomplete="off">
							</div>
						</div>

						<div class="box__left-form-group">
							<div class="input-form">
								<input type="email" name="email" placeholder="Email" required autocomplete="off">
							</div>
						</div>

						<div class="box__left-form-group">
							<div class="input-form">
								<input type="text" name="no_telp" placeholder="Nomor Telepon" required autocomplete="off" pattern="[0-9]+" title="Hanya angka">
							</div>
						</div>

						<div class="box__left-form-group">
							<div class="input-form">
								<textarea name="alamat" placeholder="Alamat Lengkap" required rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; resize: vertical;"></textarea>
							</div>
						</div>

						<div class="box__left-form-group">
							<div class="input-form">
								<input type="text" name="username" placeholder="Username" required autocomplete="off">
							</div>
						</div>

						<div class="box__left-form-group">
							<div class="input-form">
								<input type="password" name="password" id="password" placeholder="Password" required autocomplete="off" minlength="6">
								<span class="toggle-password" onclick="togglePassword('password')">👁️</span>
							</div>
						</div>

						<div class="box__left-form-group">
							<div class="input-form">
								<input type="password" name="konfirmasi_password" id="konfirmasi_password" placeholder="Konfirmasi Password" required autocomplete="off" minlength="6">
								<span class="toggle-password" onclick="togglePassword('konfirmasi_password')">👁️</span>
							</div>
						</div>

						<div class="box__left-form-group">
							<button type="submit" name="daftar" class="btn-login mt-1">Daftar</button>
						</div>

						<div class="link-login">
							<p>Sudah punya akun? <a href="login_pelanggan.php">Login di sini</a></p>
							<p><a href="login.php">Login sebagai Admin</a></p>
						</div>
					</form>
				</div>
			</div>

			<div class="col box__right">
				<div class="box__right-content">
					<div class="text__right">
						<h1>Selamat Datang</h1>
						<p style="font-size: 18px; margin-top: 10px;">Daftar untuk menikmati layanan laundry kami</p>
					</div>

					<img src=" <?=url('_assets/img/orang.png')?>" alt="" class="box-img-orang">
					<img src=" <?=url('_assets/img/celana.png')?>" alt="" class="box-img-celana">
					<img src=" <?=url('_assets/img/kaos.png')?>" alt="" class="box-img-kaos">
					<img src=" <?=url('_assets/img/kemeja.png')?>" alt="" class="box-img-kemeja">

					<div class="bubble-1"></div>
					<div class="bubble-2"></div>
					<div class="bubble-3"></div>
					<div class="bubble-4"></div>
					<div class="bubble-5"></div>
					<div class="bubble-6"></div>

					<div class="garis garis-sm garis-1"></div>
					<div class="garis garis-md garis-2"></div>
					<div class="garis garis-sm garis-3"></div>
					<div class="garis garis-md garis-4"></div>
					<div class="garis garis-md garis-5"></div>
					<div class="garis garis-lg garis-6"></div>
					<div class="garis garis-lg garis-7"></div>
					<div class="garis garis-xl garis-8"></div>
					<div class="garis garis-sm garis-9"></div>
					<div class="garis garis-md garis-10"></div>
					<div class="garis garis-sm garis-11"></div>
					<div class="garis garis-md garis-12"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="copyright">
		<p>&copy; <span id="tahun"></span> All Rights Reserved.</p>
		<script>
		var now = new Date();
		var tahun = now.getFullYear();
		document.getElementById("tahun").innerHTML = tahun;
		</script>
	</div>

	<script>
		function togglePassword(fieldId) {
			var passwordInput = document.getElementById(fieldId);
			var toggleIcon = event.target;
			
			if (passwordInput.type === "password") {
				passwordInput.type = "text";
				toggleIcon.innerHTML = "🔒";
			} else {
				passwordInput.type = "password";
				toggleIcon.innerHTML = "👁️";
			}
		}
	</script>

</body>
</html>