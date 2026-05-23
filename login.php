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

	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Custom Tailwind Config -->
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						primary: {
							500: '#667eea',
							600: '#5568d3',
							700: '#4553b8',
						},
						secondary: {
							500: '#764ba2',
						}
					},
					fontFamily: {
						sans: ['Poppins', 'sans-serif'],
					}
				}
			}
		}
	</script>

	<style>
		@keyframes float {
			0%, 100% { transform: translateY(0) rotate(0deg); }
			50% { transform: translateY(-20px) rotate(10deg); }
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

		.animate-float {
			animation: float 6s ease-in-out infinite;
		}

		.animate-fade-in-up {
			animation: fadeInUp 0.8s ease;
		}
	</style>
</head>
<body class="font-sans bg-gradient-to-br from-primary-500 to-secondary-500 min-h-screen flex items-center justify-center p-5 pb-20 relative overflow-hidden">

	<!-- Animated Background Bubbles -->
	<div class="absolute w-[300px] h-[300px] -top-[150px] -left-[150px] rounded-full bg-white/10 animate-float"></div>
	<div class="absolute w-[400px] h-[400px] -bottom-[200px] -right-[200px] rounded-full bg-white/10 animate-float" style="animation-delay: 3s;"></div>

	<?php if (isset($_SESSION['login']) && isset($_SESSION['master'])) : ?>
		<script>window.location='<?=url()?>'</script>
	<?php endif ?>

	<?php
		$showError = false;
		$errorMessage = '';
		$errorIcon = '';

		if (isset($_POST['login'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$data = mysqli_query($koneksi,"SELECT * FROM master WHERE username = '$username'");

			if (mysqli_num_rows($data) > 0) {
				$hasil = mysqli_fetch_assoc($data);

				if (password_verify($password, $hasil['password'])) {
					$_SESSION['master'] = $username;
					$_SESSION['login'] = true; ?>
						<script>window.location="<?=url()?>";</script>
				<?php
				} else {
					$showError = true;
					$errorMessage = 'Password Salah!';
					$errorIcon = 'fa-times-circle';
				}
			} else {
				$showError = true;
				$errorMessage = 'Username tidak ditemukan!';
				$errorIcon = 'fa-exclamation-triangle';
			}
		}
	?>

	<!-- Main Container -->
	<div class="relative z-10 w-full max-w-5xl">
		<div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2 min-h-[600px]">

			<!-- Left Side - Form -->
			<div class="p-12 flex flex-col justify-center bg-white">
				<div class="text-center mb-10 animate-fade-in-up">
					<h2 class="text-gray-800 text-3xl font-semibold mb-2">Selamat Datang Kembali!</h2>
					<p class="text-gray-600 text-sm">Silakan login untuk melanjutkan</p>
				</div>

				<form action="" method="post" class="space-y-6">
					<!-- Username Field -->
					<div class="animate-fade-in-up">
						<label for="username" class="block text-gray-700 font-medium text-sm mb-2">Username</label>
						<div class="relative">
							<input
								type="text"
								name="username"
								id="username"
								placeholder="Masukkan username"
								required
								autocomplete="off"
								class="w-full px-5 py-3.5 pr-12 border-2 border-gray-200 rounded-xl text-base transition-all focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 bg-gray-50 focus:bg-white"
							>
							<span class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 text-xl">
								<i class="fas fa-user"></i>
							</span>
						</div>
					</div>

					<!-- Password Field -->
					<div class="animate-fade-in-up" style="animation-delay: 0.1s;">
						<label for="password" class="block text-gray-700 font-medium text-sm mb-2">Password</label>
						<div class="relative">
							<input
								type="password"
								name="password"
								id="password"
								placeholder="Masukkan password"
								required
								autocomplete="off"
								class="w-full px-5 py-3.5 pr-12 border-2 border-gray-200 rounded-xl text-base transition-all focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 bg-gray-50 focus:bg-white"
							>
							<span
								class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 text-xl cursor-pointer hover:text-primary-500 transition-colors select-none"
								onclick="togglePassword()"
							>
								<i class="fas fa-eye" id="toggle-icon"></i>
							</span>
						</div>
					</div>

					<!-- Login Button -->
					<div class="animate-fade-in-up" style="animation-delay: 0.2s;">
						<button
							type="submit"
							name="login"
							class="w-full py-4 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-xl text-base font-semibold shadow-lg shadow-primary-500/40 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-primary-500/60 active:translate-y-0 transition-all"
						>
							Login Sekarang
						</button>
					</div>

					<!-- Register Link -->
					<div class="text-center text-sm animate-fade-in-up" style="animation-delay: 0.3s;">
						<p class="text-gray-600">
							Bukan admin?
							<a href="login_pelanggan.php" class="text-primary-600 font-semibold hover:underline">
								Login sebagai Pelanggan
							</a>
						</p>
					</div>
				</form>
			</div>

			<!-- Right Side - Illustration -->
			<div class="hidden md:flex bg-gradient-to-br from-primary-500 to-secondary-500 p-10 flex-col items-center justify-center relative overflow-hidden">
				<!-- Decorative Circles -->
				<div class="absolute w-[150px] h-[150px] -top-[75px] -right-[75px] rounded-full bg-white/10"></div>
				<div class="absolute w-[100px] h-[100px] bottom-12 -left-12 rounded-full bg-white/10"></div>
				<div class="absolute w-[60px] h-[60px] top-24 left-8 rounded-full bg-white/10 animate-pulse"></div>

				<!-- Content -->
				<div class="text-center text-white relative z-10">
					<h1 class="text-5xl font-bold mb-4 animate-fade-in-up">Admin Laundry</h1>
					<p class="text-lg opacity-90 mb-8 animate-fade-in-up" style="animation-delay: 0.2s;">
						Kelola bisnis laundry Anda dengan mudah dan efisien
					</p>

					<!-- Washing Machine SVG Icon -->
					<div class="mt-8 animate-fade-in-up" style="animation-delay: 0.4s;">
						<i class="fas fa-tshirt text-9xl opacity-20"></i>
					</div>
				</div>

				<!-- Floating Bubbles -->
				<div class="absolute top-24 left-12 w-4 h-4 bg-white/30 rounded-full animate-float"></div>
				<div class="absolute top-32 right-20 w-6 h-6 bg-white/20 rounded-full animate-float" style="animation-delay: 1s;"></div>
				<div class="absolute bottom-32 left-24 w-5 h-5 bg-white/25 rounded-full animate-float" style="animation-delay: 2s;"></div>
			</div>
		</div>
	</div>

	<!-- Copyright Footer -->
	<div class="fixed bottom-0 left-0 w-full py-4 bg-black/20 backdrop-blur-md text-center z-10">
		<p class="text-white text-sm m-0 tracking-wide">
			&copy; <span id="tahun"></span> <span class="font-semibold">Mr. Clean Laundry</span> • All Rights Reserved
		</p>
	</div>

	<!-- Error Modal (if needed) -->
	<?php if ($showError): ?>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			if (typeof modalError === 'function') {
				modalError('<?= $errorMessage ?>', 'Login Gagal');
			} else {
				alert('<?= $errorMessage ?>');
			}
		});
	</script>
	<?php endif; ?>

	<script>
		// Set current year
		document.getElementById("tahun").innerHTML = new Date().getFullYear();

		// Toggle password visibility
		function togglePassword() {
			var passwordInput = document.getElementById("password");
			var toggleIcon = document.getElementById("toggle-icon");

			if (passwordInput.type === "password") {
				passwordInput.type = "text";
				toggleIcon.className = "fas fa-eye-slash";
			} else {
				passwordInput.type = "password";
				toggleIcon.className = "fas fa-eye";
			}
		}

		// Add animation on form submit
		document.querySelector('form').addEventListener('submit', function(e) {
			const btn = this.querySelector('button[type="submit"]');
			btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
			btn.style.opacity = '0.7';
		});
	</script>

</body>
</html>
