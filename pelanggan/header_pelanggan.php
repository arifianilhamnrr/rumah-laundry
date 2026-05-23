<?php
	require_once('../_functions.php');

	// Cek apakah sudah login
	if(!isset($_SESSION['login_pelanggan'])){
		header("Location: ../login_pelanggan.php");
		exit;
	}

	$id_pelanggan = $_SESSION['id_pelanggan'];
	$nama_pelanggan = $_SESSION['nama_pelanggan'];
	$username_pelanggan = $_SESSION['username_pelanggan'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard Pelanggan | MR Clean Laundry</title>

	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- Custom Tailwind Config -->
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						primary: {
							50: '#f5f7ff',
							100: '#ebf0ff',
							500: '#667eea',
							600: '#5568d3',
							700: '#4553b8',
						},
						secondary: {
							500: '#764ba2',
						}
					}
				}
			}
		}
	</script>

	<link rel="stylesheet" href="<?=url('_assets/css/style.css')?>">
	<link rel="shortcut icon" href="<?=url('_assets/img/logo/nav-logo.png')?>" type="image/x-icon">
</head>
<body class="bg-gray-50 min-h-screen">

	<!-- Modal Component Script -->
	<script src="<?=url('_assets/js/modal.js')?>"></script>

	<!-- Header Navigation with Tailwind -->
	<header class="sticky top-0 z-40 w-full backdrop-blur flex-none transition-colors duration-500 lg:z-50 border-b border-slate-900/10 bg-white/95 supports-backdrop-blur:bg-white/60">
		<!-- Main Navigation -->
		<nav class="bg-gradient-to-r from-primary-600 to-secondary-500 shadow-lg">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<div class="flex justify-between items-center h-16">
					<!-- Logo -->
					<div class="flex items-center">
						<a href="<?=url('pelanggan/dashboard.php')?>" class="flex items-center space-x-2 group">
							<img src="<?=url('_assets/img/logo/nav-logo.png')?>" alt="MR Clean Laundry" class="h-10 w-10 transition-transform group-hover:scale-110">
							<span class="text-white font-bold text-xl hidden sm:block">MR Clean Laundry</span>
						</a>
					</div>

					<!-- User Menu -->
					<div class="flex items-center space-x-4">
						<div class="relative group">
							<button class="flex items-center space-x-2 text-white hover:bg-white/10 px-4 py-2 rounded-lg transition-all">
								<i class="fas fa-user-circle text-2xl"></i>
								<span class="hidden sm:block font-medium"><?= htmlspecialchars(ucfirst($nama_pelanggan)) ?></span>
								<i class="fas fa-chevron-down text-sm"></i>
							</button>

							<!-- Dropdown Menu -->
							<div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 -translate-y-2">
								<div class="py-2">
									<a href="<?=url('pelanggan/profil.php')?>" class="flex items-center space-x-2 px-4 py-2 text-gray-700 hover:bg-primary-50 transition-colors">
										<i class="fas fa-user text-primary-600"></i>
										<span>Profil Saya</span>
									</a>
									<a href="<?=url('pelanggan/logout.php')?>" class="flex items-center space-x-2 px-4 py-2 text-red-600 hover:bg-red-50 transition-colors">
										<i class="fas fa-sign-out-alt"></i>
										<span>Logout</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<!-- Sub Navigation -->
		<div class="bg-gradient-to-r from-primary-500 to-secondary-400 border-t border-white/10">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<div class="flex space-x-1 overflow-x-auto py-2 scrollbar-hide">
					<a href="<?=url('pelanggan/dashboard.php')?>" class="flex items-center space-x-2 px-4 py-2 text-white hover:bg-white/20 rounded-lg transition-all whitespace-nowrap">
						<i class="fas fa-home"></i>
						<span>Dashboard</span>
					</a>
					<a href="<?=url('pelanggan/order_baru.php')?>" class="flex items-center space-x-2 px-4 py-2 text-white hover:bg-white/20 rounded-lg transition-all whitespace-nowrap">
						<i class="fas fa-plus-circle"></i>
						<span>Order Baru</span>
					</a>
					<a href="<?=url('pelanggan/riwayat_order.php')?>" class="flex items-center space-x-2 px-4 py-2 text-white hover:bg-white/20 rounded-lg transition-all whitespace-nowrap">
						<i class="fas fa-history"></i>
						<span>Riwayat Order</span>
					</a>
					<a href="<?=url('pelanggan/profil.php')?>" class="flex items-center space-x-2 px-4 py-2 text-white hover:bg-white/20 rounded-lg transition-all whitespace-nowrap">
						<i class="fas fa-user-cog"></i>
						<span>Profil</span>
					</a>
				</div>
			</div>
		</div>
	</header>