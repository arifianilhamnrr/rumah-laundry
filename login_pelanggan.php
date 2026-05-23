<?php 
	require_once('_functions.php');

	// Jika sudah login, redirect
	if(isset($_SESSION['login_pelanggan'])){
		header("Location: pelanggan/dashboard.php");
		exit;
	}
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Pelanggan | Rumah Laundry</title>
	<link rel="stylesheet" href="<?=url('_assets/css/login.css')?>">
	<link rel="shortcut icon" href="<?= url('_assets/img/logo/nav-logo.png') ?>" type="image/x-icon">
	<style>
		:root {
			color-scheme: light;
		}
		* {
			box-sizing: border-box;
		}
		body {
			min-height: 100vh;
			margin: 0;
			background:
				radial-gradient(circle at top left, rgba(148, 163, 184, 0.18), transparent 30%),
				linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%);
			font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
			color: #0f172a;
		}
		body::before {
			content: "";
			position: fixed;
			inset: 0;
			background: linear-gradient(135deg, rgba(255,255,255,0.35), transparent 55%);
			pointer-events: none;
		}
		.input-form {
			position: relative;
		}
		.input-form input {
			width: 100%;
			border: 1px solid #cbd5e1;
			background: rgba(255,255,255,0.92);
			border-radius: 18px;
			padding: 14px 48px 14px 16px;
			font-size: 14px;
			outline: none;
			transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
			box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
		}
		.input-form input:focus {
			border-color: #64748b;
			box-shadow: 0 0 0 4px rgba(148, 163, 184, 0.18);
			background: #fff;
		}
		.toggle-password {
			position: absolute;
			right: 15px;
			top: 50%;
			transform: translateY(-50%);
			cursor: pointer;
			user-select: none;
			color: #64748b;
			font-size: 18px;
		}
		.toggle-password:hover {
			color: #0f172a;
		}
		.box {
			position: relative;
			z-index: 1;
			padding: 32px 16px 16px;
		}
		.box-content {
			max-width: 1180px;
			margin: 0 auto;
			border: 1px solid rgba(226, 232, 240, 0.9);
			border-radius: 32px;
			background: rgba(255,255,255,0.74);
			backdrop-filter: blur(18px);
			box-shadow: 0 10px 30px -18px rgba(15, 23, 42, 0.28), 0 2px 6px rgba(15, 23, 42, 0.06);
			overflow: hidden;
		}
		.box__left {
			padding: 36px 32px !important;
			background: rgba(255,255,255,0.72);
		}
		.box__right {
			background: linear-gradient(180deg, rgba(248,250,252,0.35), rgba(226,232,240,0.2));
		}
		.logo img {
			height: 54px;
			width: 54px;
			padding: 10px;
			border-radius: 18px;
			background: rgba(255,255,255,0.9);
			border: 1px solid #e2e8f0;
			box-shadow: 0 1px 2px rgba(15, 23, 42, 0.08);
		}
		.box__left-title h4 {
			font-size: 30px;
			line-height: 1.1;
			margin-bottom: 8px;
			color: #0f172a;
		}
		.btn-login {
			width: 100%;
			border: 0;
			border-radius: 18px;
			padding: 14px 18px;
			background: #0f172a;
			color: #fff;
			font-weight: 600;
			font-size: 14px;
			box-shadow: 0 10px 20px -14px rgba(15, 23, 42, 0.8);
			transition: transform .2s ease, box-shadow .2s ease, background-color .2s ease;
		}
		.btn-login:hover {
			transform: translateY(-1px);
			background: #1e293b;
			box-shadow: 0 14px 24px -16px rgba(15, 23, 42, 0.9);
		}
		.link-register {
			text-align: center;
			margin-top: 18px;
			font-size: 14px;
			color: #64748b;
		}
		.link-register p {
			margin: 8px 0;
		}
		.link-register a {
			color: #0f172a;
			text-decoration: none;
			font-weight: 600;
		}
		.link-register a:hover {
			text-decoration: underline;
		}
		.copyright {
			position: relative;
			z-index: 1;
			text-align: center;
			padding: 0 16px 24px;
			color: #64748b;
			font-size: 14px;
		}
		.overlay .boxSalah {
			border-radius: 24px;
			border: 1px solid #fecaca;
			background: rgba(255,255,255,0.96);
			box-shadow: 0 12px 30px -18px rgba(127, 29, 29, 0.4);
		}
		@media (max-width: 768px) {
			.box {
				padding-top: 16px;
			}
			.box-content {
				border-radius: 24px;
			}
			.box__left {
				padding: 28px 20px !important;
			}
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
					<img src="<?= url('_assets/img/logo/nav-logo.png') ?>" alt="Logo MR Clean Laundry">
				</div>
				<div class="box__left-title">
					<p style="font-size: 11px; letter-spacing: .24em; text-transform: uppercase; color: #64748b; margin-bottom: 10px;">Portal Pelanggan</p>
					<h4>Login Pelanggan</h4>
					<p style="font-size: 14px; color: #64748b; line-height: 1.6;">Masuk untuk memesan layanan laundry dengan pengalaman baru yang lebih bersih, cepat, nyaman.</p>
				</div>

				<div style="margin: 20px 0 24px; padding: 16px 18px; border: 1px solid #e2e8f0; border-radius: 22px; background: rgba(248,250,252,0.9); box-shadow: 0 1px 2px rgba(15,23,42,.04);">
					<div style="display: flex; gap: 12px; align-items: flex-start;">
						<div style="height: 38px; width: 38px; min-width: 38px; border-radius: 14px; background: #0f172a; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 14px;">✦</div>
						<div>
							<p style="margin: 0 0 4px; font-size: 14px; font-weight: 600; color: #0f172a;">Akses order lebih praktis</p>
							<p style="margin: 0; font-size: 13px; line-height: 1.6; color: #64748b;">Pantau status laundry, buat order baru, cek riwayat, kelola profil.</p>
						</div>
					</div>
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