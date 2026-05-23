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
	<title>Login Pelanggan | Rumah Laundry</title>
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

		.link-register {
			text-align: center;
			margin-top: 15px;
			font-size: 14px;
		}

		.link-register a {
			color: #007bff;
			text-decoration: none;
			font-weight: 600;
		}

		.link-register a:hover {
			text-decoration: underline;
		}
	</style>
</head>
<body>

	<?php 
		if(isset($_POST['login'])){
			$username = $_POST['username'];
			$password = $_POST['password'];

			$pelanggan = login_pelanggan($username, $password);

			if($pelanggan){
				$_SESSION['login_pelanggan'] = true;
				$_SESSION['id_pelanggan'] = $pelanggan['id_pelanggan'];
				$_SESSION['nama_pelanggan'] = $pelanggan['nama_lengkap'];
				$_SESSION['username_pelanggan'] = $pelanggan['username'];
				
				echo "<script>
					alert('Login berhasil!');
					window.location='pelanggan/dashboard.php';
				</script>";
			} else {
				echo "
					<div class='overlay'>
						<div class='boxSalah'>
							<a href='login_pelanggan.php' class='close'>&times;</a>
							<p>Username atau Password salah!</p>
						</div>
					</div>
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
					<h4>Login Pelanggan</h4>
					<p style="font-size: 13px; color: #666;">Masuk untuk memesan layanan laundry</p>
				</div>

				<div class="box__left-form">
					<form action="" method="post">
						<div class="box__left-form-group">
							<div class="input-form">
								<input type="text" name="username" placeholder="Username" required autocomplete="off">
							</div>
						</div>

						<div class="box__left-form-group">
							<div class="input-form">
								<input type="password" name="password" id="password" placeholder="Password" required autocomplete="off">
								<span class="toggle-password" onclick="togglePassword()">👁️</span>
							</div>
						</div>

						<div class="box__left-form-group">
							<button type="submit" name="login" class="btn-login mt-1">Login</button>
						</div>

						<div class="link-register">
							<p>Belum punya akun? <a href="register_pelanggan.php">Daftar di sini</a></p>
							<p><a href="login.php">Login sebagai Admin</a></p>
						</div>
					</form>
				</div>
			</div>

			<div class="col box__right">
				<div class="box__right-content">
					<div class="text__right">
						<h1>Mr. Clean Laundry</h1>
						<p style="font-size: 18px; margin-top: 10px;">Layanan laundry tercepat & termurah</p>
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
		function togglePassword() {
			var passwordInput = document.getElementById("password");
			var toggleIcon = document.querySelector(".toggle-password");
			
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