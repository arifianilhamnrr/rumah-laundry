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
<html lang="id" class="scroll-smooth">
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

	<link rel="shortcut icon" href="<?=url('_assets/img/logo/nav-logo.png')?>" type="image/x-icon">

	<style>
		* {
			transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
		}
	</style>
</head>
<body class="bg-slate-50 dark:bg-slate-900 min-h-screen">

	<!-- Modal Component Script -->
	<script src="<?=url('_assets/js/modal.js')?>"></script>

	<!-- Theme Manager Script -->
	<script src="<?=url('_assets/js/theme.js')?>"></script>

	<!-- Clean Customer Header -->
	<header class="sticky top-0 z-50 bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 shadow-sm">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="flex justify-between items-center h-16">
				<!-- Logo -->
				<div class="flex items-center space-x-3">
					<img src="<?=url('_assets/img/logo/nav-logo.png')?>" alt="Logo" class="h-8 w-8">
					<span class="text-lg font-semibold text-slate-900 dark:text-white">MR Clean</span>
				</div>

				<!-- Right Side -->
				<div class="flex items-center space-x-3">
					<!-- Dark Mode Toggle -->
					<button id="theme-toggle" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
						<i class="fas fa-moon text-slate-600 dark:text-slate-300"></i>
					</button>

					<!-- User Menu -->
					<div class="relative group">
						<button class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">
							<div class="w-8 h-8 rounded-full bg-primary-500 flex items-center justify-center text-white text-sm font-medium">
								<?= strtoupper(substr($nama_pelanggan, 0, 1)) ?>
							</div>
							<span class="hidden sm:block text-sm font-medium text-slate-700 dark:text-slate-200"><?= htmlspecialchars($nama_pelanggan) ?></span>
							<i class="fas fa-chevron-down text-xs text-slate-500"></i>
						</button>

						<!-- Dropdown -->
						<div class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-lg shadow-lg border border-slate-200 dark:border-slate-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
							<div class="py-1">
								<a href="<?=url('pelanggan/profil.php')?>" class="flex items-center space-x-2 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700">
									<i class="fas fa-user-circle w-4"></i>
									<span>Profil</span>
								</a>
								<a href="<?=url('logout_pelanggan.php')?>" class="flex items-center space-x-2 px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
									<i class="fas fa-sign-out-alt w-4"></i>
									<span>Logout</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Clean Navigation Menu -->
		<div class="border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<nav class="flex space-x-1 overflow-x-auto py-2">
					<a href="<?=url('pelanggan/dashboard.php')?>" class="flex items-center space-x-2 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-white dark:hover:bg-slate-700 rounded-lg transition-colors whitespace-nowrap">
						<i class="fas fa-home"></i>
						<span>Dashboard</span>
					</a>
					<a href="<?=url('pelanggan/order_baru.php')?>" class="flex items-center space-x-2 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-white dark:hover:bg-slate-700 rounded-lg transition-colors whitespace-nowrap">
						<i class="fas fa-plus-circle"></i>
						<span>Order Baru</span>
					</a>
					<a href="<?=url('pelanggan/riwayat_order.php')?>" class="flex items-center space-x-2 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-white dark:hover:bg-slate-700 rounded-lg transition-colors whitespace-nowrap">
						<i class="fas fa-history"></i>
						<span>Riwayat Order</span>
					</a>
				</nav>
			</div>
		</div>
	</header>
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