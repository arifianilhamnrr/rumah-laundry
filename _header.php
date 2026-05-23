<?php
	require_once('_functions.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MR Clean Laundry | Dashboard</title>

	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- Heroicons -->
	<script src="https://unpkg.com/@heroicons/react@2.0.18/24/outline/index.js" type="module"></script>

	<!-- Custom Tailwind Config -->
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						primary: {
							50: '#f5f7ff',
							100: '#ebf0ff',
							200: '#d6e0ff',
							300: '#b3c7ff',
							400: '#8aa3ff',
							500: '#667eea',
							600: '#5568d3',
							700: '#4553b8',
							800: '#3a4694',
							900: '#2d3748',
						},
						secondary: {
							500: '#764ba2',
							600: '#6a4391',
							700: '#5d3a80',
						}
					}
				}
			}
		}
	</script>

	<!-- Font Awesome for Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- Custom CSS (for backward compatibility) -->
	<link rel="stylesheet" href="<?=url('_assets/css/style.css')?>">

	<link rel="shortcut icon" href="<?=url('_assets/img/logo/nav-logo.png')?>" type="image/x-icon">

	<style>
		/* Custom animations */
		@keyframes slideIn {
			from {
				opacity: 0;
				transform: translateY(-20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		.animate-slide-in {
			animation: slideIn 0.3s ease-out;
		}

		/* Smooth transitions */
		* {
			transition-property: background-color, border-color, color, fill, stroke;
			transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
			transition-duration: 150ms;
		}
	</style>
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
						<a href="<?=url()?>" class="flex items-center space-x-2 group">
							<img src="<?=url('_assets/img/logo/nav-logo.png')?>" alt="Rumah Laundry Logo" class="h-10 w-10 transition-transform group-hover:scale-110">
							<span class="text-white font-bold text-xl hidden sm:block">MR Clean Laundry</span>
						</a>
					</div>

					<!-- User Menu -->
					<div class="flex items-center space-x-4">
						<div class="relative group">
							<button class="flex items-center space-x-2 text-white hover:bg-white/10 px-4 py-2 rounded-lg transition-all">
								<i class="fas fa-user-circle text-2xl"></i>
								<span class="hidden sm:block font-medium"><?= htmlspecialchars(ucfirst($_SESSION['master'])) ?></span>
								<i class="fas fa-chevron-down text-sm"></i>
							</button>

							<!-- Dropdown Menu -->
							<div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 -translate-y-2">
								<div class="py-2">
									<a href="<?=url('about.php')?>" class="flex items-center space-x-2 px-4 py-2 text-gray-700 hover:bg-primary-50 transition-colors">
										<i class="fas fa-info-circle text-primary-600"></i>
										<span>Tentang Kami</span>
									</a>
									<a href="<?=url('logout.php')?>" class="flex items-center space-x-2 px-4 py-2 text-red-600 hover:bg-red-50 transition-colors">
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
					<a href="<?=url('riwayat_transaksi/riwayat.php')?>" class="flex items-center space-x-2 px-4 py-2 text-white hover:bg-white/20 rounded-lg transition-all whitespace-nowrap">
						<i class="fas fa-history"></i>
						<span>Riwayat Transaksi</span>
					</a>
					<a href="<?=url('karyawan/karyawan.php')?>" class="flex items-center space-x-2 px-4 py-2 text-white hover:bg-white/20 rounded-lg transition-all whitespace-nowrap">
						<i class="fas fa-users"></i>
						<span>Manage Karyawan</span>
					</a>
					<a href="<?=url('admin/daftar_pelanggan.php')?>" class="flex items-center space-x-2 px-4 py-2 text-white hover:bg-white/20 rounded-lg transition-all whitespace-nowrap">
						<i class="fas fa-user-friends"></i>
						<span>Daftar Pelanggan</span>
					</a>
					<a href="<?=url('paket/paket.php')?>" class="flex items-center space-x-2 px-4 py-2 text-white hover:bg-white/20 rounded-lg transition-all whitespace-nowrap">
						<i class="fas fa-box"></i>
						<span>Daftar Paket</span>
					</a>
				</div>
			</div>
		</div>
	</header>