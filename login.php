<?php
	require_once('_functions.php');
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mr. Clean Laundry | Login</title>
	<link rel="shortcut icon" href="<?= url('_assets/img/logo/nav-logo.png') ?>" type="image/x-icon">

	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- Custom Tailwind Config -->
	<script>
		tailwind.config = {
			darkMode: 'class',
			theme: {
				extend: {
					colors: {
						primary: {
							500: '#3b82f6',
							600: '#2563eb',
							700: '#1d4ed8',
						}
					}
				}
			}
		}
	</script>

	<style>
		* {
			transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
		}
	</style>
</head>
<body class="bg-slate-50 dark:bg-slate-900 min-h-screen flex items-center justify-center p-4">

	<?php if (isset($_SESSION['login']) && isset($_SESSION['master'])) : ?>
		<script>window.location='<?=url()?>'</script>
	<?php endif ?>

	<?php
		$showError = false;
		$errorMessage = '';

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
	<!-- Clean Minimalist Login Container -->
	<div class="w-full max-w-md">
		<div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg border border-slate-200 dark:border-slate-700 p-8">

			<!-- Logo & Title -->
			<div class="text-center mb-8">
				<img src="<?= url('_assets/img/logo/nav-logo.png') ?>" alt="Logo" class="h-16 w-16 mx-auto mb-4">
				<h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Welcome Back</h2>
				<p class="text-sm text-slate-600 dark:text-slate-400">Login to continue</p>
			</div>

			<!-- Login Form -->
			<form action="" method="post" class="space-y-4">
				<!-- Username -->
				<div>
					<label for="username" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Username</label>
					<div class="relative">
						<input
							type="text"
							name="username"
							id="username"
							placeholder="Enter username"
							required
							autocomplete="off"
							class="w-full px-4 py-3 pl-11 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all"
						>
						<span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
							<i class="fas fa-user"></i>
						</span>
					</div>
				</div>

				<!-- Password -->
				<div>
					<label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Password</label>
					<div class="relative">
						<input
							type="password"
							name="password"
							id="password"
							placeholder="Enter password"
							required
							autocomplete="off"
							class="w-full px-4 py-3 pl-11 pr-11 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 transition-all"
						>
						<span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
							<i class="fas fa-lock"></i>
						</span>
						<span
							class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 cursor-pointer hover:text-primary-500 transition-colors"
							onclick="togglePassword()"
						>
							<i class="fas fa-eye" id="toggle-icon"></i>
						</span>
					</div>
				</div>

				<!-- Login Button -->
				<button
					type="submit"
					name="login"
					class="w-full py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors"
				>
					Login
				</button>

				<!-- Customer Login Link -->
				<div class="text-center text-sm">
					<p class="text-slate-600 dark:text-slate-400">
						Not admin?
						<a href="login_pelanggan.php" class="text-primary-600 dark:text-primary-400 font-medium hover:underline">
							Login as Customer
						</a>
					</p>
				</div>
			</form>
		</div>
	</div>
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

	<!-- Error Modal -->
	<?php if ($showError): ?>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			if (typeof modalError === 'function') {
				modalError('<?= $errorMessage ?>', 'Login Failed');
			} else {
				alert('<?= $errorMessage ?>');
			}
		});
	</script>
	<?php endif; ?>

	<!-- Modal Script -->
	<script src="<?=url('_assets/js/modal.js')?>"></script>

	<script>
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
	</script>

</body>
</html>
</html>
