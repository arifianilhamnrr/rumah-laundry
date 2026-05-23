<?php 
	require_once('_functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mr. Clean Laundry | Login</title>
	<link rel="shortcut icon" href="<?= url('_assets/img/logo/nav-logo.png') ?>" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Poppins', sans-serif;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 20px;
			padding-bottom: 80px;
			position: relative;
			overflow: hidden;
		}

		/* Animated background bubbles */
		body::before,
		body::after {
			content: '';
			position: absolute;
			border-radius: 50%;
			background: rgba(255, 255, 255, 0.1);
			animation: float 6s ease-in-out infinite;
		}

		body::before {
			width: 300px;
			height: 300px;
			top: -150px;
			left: -150px;
		}

		body::after {
			width: 400px;
			height: 400px;
			bottom: -200px;
			right: -200px;
			animation-delay: 3s;
		}

		@keyframes float {
			0%, 100% { transform: translateY(0) rotate(0deg); }
			50% { transform: translateY(-20px) rotate(10deg); }
		}

		.container {
			position: relative;
			z-index: 1;
			width: 100%;
			max-width: 1000px;
		}

		.login-wrapper {
			background: rgba(255, 255, 255, 0.95);
			border-radius: 20px;
			box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
			overflow: hidden;
			display: grid;
			grid-template-columns: 1fr 1fr;
			min-height: 600px;
			backdrop-filter: blur(10px);
		}

		/* Left Side - Form */
		.login-left {
			padding: 60px 50px;
			display: flex;
			flex-direction: column;
			justify-content: center;
			background: white;
		}

		.login-title {
			text-align: center;
			margin-bottom: 40px;
			animation: fadeInUp 0.8s ease;
		}

		.login-title h2 {
			color: #333;
			font-size: 28px;
			font-weight: 600;
			margin-bottom: 8px;
		}

		.login-title p {
			color: #666;
			font-size: 14px;
		}

		.form-group {
			margin-bottom: 25px;
			animation: fadeInUp 1s ease;
		}

		.form-group label {
			display: block;
			margin-bottom: 8px;
			color: #333;
			font-weight: 500;
			font-size: 14px;
		}

		.input-wrapper {
			position: relative;
		}

		.input-wrapper input {
			width: 100%;
			padding: 15px 20px;
			padding-right: 50px;
			border: 2px solid #e1e8ed;
			border-radius: 12px;
			font-size: 15px;
			transition: all 0.3s ease;
			font-family: 'Poppins', sans-serif;
			background: #f8f9fa;
		}

		.input-wrapper input:focus {
			outline: none;
			border-color: #667eea;
			background: white;
			box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
		}

		.input-icon {
			position: absolute;
			right: 18px;
			top: 50%;
			transform: translateY(-50%);
			color: #999;
			font-size: 20px;
		}

		.toggle-password {
			cursor: pointer;
			user-select: none;
			transition: color 0.3s ease;
		}

		.toggle-password:hover {
			color: #667eea;
		}

		.btn-login {
			width: 100%;
			padding: 16px;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			border: none;
			border-radius: 12px;
			font-size: 16px;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s ease;
			font-family: 'Poppins', sans-serif;
			box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
			animation: fadeInUp 1.2s ease;
		}

		.btn-login:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
		}

		.btn-login:active {
			transform: translateY(0);
		}

		/* Right Side - Illustration */
		.login-right {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			padding: 60px 40px;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			position: relative;
			overflow: hidden;
		}

		.right-content {
			text-align: center;
			color: white;
			position: relative;
			z-index: 2;
		}

		.right-content h1 {
			font-size: 36px;
			font-weight: 700;
			margin-bottom: 15px;
			animation: fadeIn 1s ease;
		}

		.right-content p {
			font-size: 16px;
			opacity: 0.9;
			margin-bottom: 30px;
			animation: fadeIn 1.2s ease;
		}

		.illustration {
			width: 100%;
			max-width: 300px;
			margin-top: 30px;
			animation: floatImage 3s ease-in-out infinite;
		}

		@keyframes floatImage {
			0%, 100% { transform: translateY(0); }
			50% { transform: translateY(-15px); }
		}

		/* Decorative elements */
		.circle-decoration {
			position: absolute;
			border-radius: 50%;
			background: rgba(255, 255, 255, 0.1);
		}

		.circle-1 {
			width: 150px;
			height: 150px;
			top: -75px;
			right: -75px;
		}

		.circle-2 {
			width: 100px;
			height: 100px;
			bottom: 50px;
			left: -50px;
		}

		.circle-3 {
			width: 60px;
			height: 60px;
			top: 100px;
			left: 30px;
			animation: pulse 2s ease-in-out infinite;
		}

		@keyframes pulse {
			0%, 100% { transform: scale(1); opacity: 0.5; }
			50% { transform: scale(1.1); opacity: 0.8; }
		}

		/* Error/Success Messages */
		.overlay {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.7);
			display: flex;
			align-items: center;
			justify-content: center;
			z-index: 1000;
			animation: fadeIn 0.3s ease;
		}

		.message-box {
			background: white;
			padding: 40px;
			border-radius: 15px;
			max-width: 400px;
			text-align: center;
			position: relative;
			animation: slideIn 0.3s ease;
			box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
		}

		@keyframes slideIn {
			from {
				transform: translateY(-50px);
				opacity: 0;
			}
			to {
				transform: translateY(0);
				opacity: 1;
			}
		}

		.message-box .close {
			position: absolute;
			top: 15px;
			right: 20px;
			font-size: 30px;
			color: #999;
			text-decoration: none;
			transition: color 0.3s ease;
		}

		.message-box .close:hover {
			color: #333;
		}

		.message-box p {
			color: #e74c3c;
			font-size: 18px;
			font-weight: 500;
			margin-top: 20px;
		}

		.message-icon {
			font-size: 50px;
			margin-bottom: 10px;
		}

		/* Copyright - UPDATED */
		.copyright {
			position: fixed;
			bottom: 0;
			left: 0;
			width: 100%;
			padding: 15px 0;
			background: rgba(0, 0, 0, 0.2);
			backdrop-filter: blur(10px);
			text-align: center;
			z-index: 1;
		}

		.copyright p {
			color: white;
			font-size: 13px;
			margin: 0;
			text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
			letter-spacing: 0.5px;
		}

		.copyright p span {
			font-weight: 600;
		}

		/* Animations */
		@keyframes fadeIn {
			from { opacity: 0; }
			to { opacity: 1; }
		}

		@keyframes fadeInDown {
			from {
				opacity: 0;
				transform: translateY(-20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		@keyframes fadeInUp {
			from {
				opacity: 0;
				transform: translateY(20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		/* Responsive */
		@media (max-width: 768px) {
			.login-wrapper {
				grid-template-columns: 1fr;
				max-width: 450px;
			}

			.login-right {
				display: none;
			}

			.login-left {
				padding: 40px 30px;
			}

			.login-title h2 {
				font-size: 24px;
			}
		}

		@media (max-width: 480px) {
			.login-left {
				padding: 30px 20px;
			}

			.login-title h2 {
				font-size: 22px;
			}

			.message-box {
				margin: 0 20px;
				padding: 30px 20px;
			}
		}
	</style>
</head>
<body>

	<?php if (isset($_SESSION['login']) && isset($_SESSION['master'])) : ?>
		<script>window.location='http://localhost/rumah_laundry/'</script>
	<?php endif ?> 

	<?php 
		if (isset($_POST['login'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$data = mysqli_query($koneksi,"SELECT * FROM master WHERE username = '$username'");

			if (mysqli_num_rows($data) > 0) {
				$hasil = mysqli_fetch_assoc($data);

				if (password_verify($password, $hasil['password'])) {
					$_SESSION['master'] = $username;
					$_SESSION['login'] = true; ?>
						<script>window.location="http://localhost/rumah_laundry/";</script>
				<?php 
				}else {?>

					<div class="overlay">
						<div class="message-box">
							<a href="<?=url('login.php');?>" class="close">&times;</a>
							<div class="message-icon">❌</div>
							<p>Password Salah!</p>
						</div>
					</div>
				
				<?php 
				}
			}else{?>
				<div class="overlay">
					<div class="message-box">
						<a href="<?=url('login.php');?>" class="close">&times;</a>
						<div class="message-icon">⚠️</div>
						<p>Username & Password Salah!</p>
					</div>
				</div>
			<?php 
			}
		}
	?>

	<div class="container">
		<div class="login-wrapper">
			<!-- Left Side - Form -->
			<div class="login-left">
				<!-- Logo dihilangkan -->

				<div class="login-title">
					<h2>Selamat Datang Kembali!</h2>
					<p>Silakan login untuk melanjutkan</p>
				</div>

				<form action="" method="post">
					<div class="form-group">
						<label for="username">Username</label>
						<div class="input-wrapper">
							<input type="text" name="username" id="username" placeholder="Masukkan username" required autocomplete="off">
							<span class="input-icon">👤</span>
						</div>
					</div>

					<div class="form-group">
						<label for="password">Password</label>
						<div class="input-wrapper">
							<input type="password" name="password" id="password" placeholder="Masukkan password" required autocomplete="off">
							<span class="input-icon toggle-password" onclick="togglePassword()">👁️</span>
						</div>
					</div>

					<div class="form-group">
						<button type="submit" name="login" class="btn-login">Login Sekarang</button>
					</div>

					<!-- Setelah tombol login, tambahkan ini: -->
					<div class="link-register" style="text-align: center; margin-top: 15px; font-size: 14px;">
						<p>Bukan admin? <a href="login_pelanggan.php" style="color: #007bff; text-decoration: none; font-weight: 600;">Login sebagai Pelanggan</a></p>
					</div>
				</form>
			</div>

			<!-- Right Side - Illustration -->
			<div class="login-right">
				<div class="circle-decoration circle-1"></div>
				<div class="circle-decoration circle-2"></div>
				<div class="circle-decoration circle-3"></div>

				<div class="right-content">
					<h1>Admin Laundry</h1>
					<p>Kelola bisnis laundry Anda dengan mudah dan efisien</p>
					
					<svg class="illustration" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
						<!-- Washing Machine -->
						<rect x="150" y="150" width="200" height="250" rx="20" fill="white" opacity="0.9"/>
						<rect x="160" y="160" width="180" height="50" rx="10" fill="#f0f0f0"/>
						<circle cx="190" cy="185" r="8" fill="#667eea"/>
						<circle cx="220" cy="185" r="8" fill="#764ba2"/>
						<circle cx="250" cy="185" r="8" fill="#667eea"/>
						
						<!-- Washing Machine Door -->
						<circle cx="250" cy="290" r="70" fill="#e1e8ed" opacity="0.5"/>
						<circle cx="250" cy="290" r="55" fill="white" opacity="0.3"/>
						<circle cx="250" cy="290" r="40" fill="#667eea" opacity="0.2"/>
						
						<!-- Clothes -->
						<path d="M 230 270 Q 240 260 250 270 Q 260 280 250 290 Q 240 300 230 290 Z" fill="#764ba2" opacity="0.6"/>
						<path d="M 250 275 Q 260 265 270 275 Q 280 285 270 295 Q 260 305 250 295 Z" fill="#667eea" opacity="0.6"/>
						
						<!-- Bubbles -->
						<circle cx="200" cy="100" r="15" fill="white" opacity="0.6">
							<animate attributeName="cy" values="100;50;100" dur="3s" repeatCount="indefinite"/>
							<animate attributeName="opacity" values="0.6;0;0.6" dur="3s" repeatCount="indefinite"/>
						</circle>
						<circle cx="300" cy="120" r="20" fill="white" opacity="0.6">
							<animate attributeName="cy" values="120;60;120" dur="4s" repeatCount="indefinite"/>
							<animate attributeName="opacity" values="0.6;0;0.6" dur="4s" repeatCount="indefinite"/>
						</circle>
						<circle cx="250" cy="90" r="12" fill="white" opacity="0.6">
							<animate attributeName="cy" values="90;40;90" dur="3.5s" repeatCount="indefinite"/>
							<animate attributeName="opacity" values="0.6;0;0.6" dur="3.5s" repeatCount="indefinite"/>
						</circle>
					</svg>
				</div>
			</div>
		</div>
	</div>

	<div class="copyright">
		<p>&copy; <span id="tahun"></span> <span>Mr. Clean Laundry</span> • All Rights Reserved</p>
	</div>

	<script>
		// Set current year
		document.getElementById("tahun").innerHTML = new Date().getFullYear();

		// Toggle password visibility
		function togglePassword() {
			var passwordInput = document.getElementById("password");
			var toggleIcon = document.querySelector(".toggle-password");
			
			if (passwordInput.type === "password") {
				passwordInput.type = "text";
				toggleIcon.innerHTML = "🔓";
			} else {
				passwordInput.type = "password";
				toggleIcon.innerHTML = "👁️";
			}
		}

		// Add animation on form submit
		document.querySelector('form').addEventListener('submit', function() {
			document.querySelector('.btn-login').innerHTML = 'Loading...';
			document.querySelector('.btn-login').style.opacity = '0.7';
		});
	</script>

</body>
</html>