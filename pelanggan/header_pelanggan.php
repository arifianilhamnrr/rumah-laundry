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
							50: '#f8fafc',
							100: '#f1f5f9',
							200: '#e2e8f0',
							300: '#cbd5e1',
							400: '#94a3b8',
							500: '#64748b',
							600: '#475569',
							700: '#334155',
							800: '#1e293b',
							900: '#0f172a'
						}
					},
					boxShadow: {
						'soft': '0 1px 2px 0 rgb(15 23 42 / 0.05), 0 1px 3px 0 rgb(15 23 42 / 0.08)',
						'card': '0 1px 2px 0 rgb(15 23 42 / 0.04), 0 8px 24px -12px rgb(15 23 42 / 0.18)'
					},
					borderRadius: {
						'xl2': '1rem'
					}
				}
			}
		}
	</script>

	<link rel="shortcut icon" href="<?=url('_assets/img/logo/nav-logo.png')?>" type="image/x-icon">

	<style>
		:root {
			color-scheme: light;
		}
		.dark {
			color-scheme: dark;
		}
		* {
			transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
		}
		html, body {
			height: 100%;
		}
		body {
			display: flex;
			flex-direction: column;
			background-image:
				radial-gradient(circle at top, rgba(148, 163, 184, 0.12), transparent 30%),
				linear-gradient(to bottom, rgba(255,255,255,0.98), rgba(248,250,252,1));
		}
		.dark body {
			background-image:
				radial-gradient(circle at top, rgba(51, 65, 85, 0.35), transparent 30%),
				linear-gradient(to bottom, rgba(2,6,23,0.98), rgba(15,23,42,1));
		}
		main {
			flex: 1 0 auto;
		}
		footer {
			flex-shrink: 0;
		}
		::-webkit-scrollbar {
			width: 10px;
			height: 10px;
		}
		::-webkit-scrollbar-track {
			background: transparent;
		}
		::-webkit-scrollbar-thumb {
			background: rgba(148, 163, 184, 0.5);
			border-radius: 9999px;
		}
		.dark ::-webkit-scrollbar-thumb {
			background: rgba(71, 85, 105, 0.8);
		}
		.glass-panel {
			background: rgba(255, 255, 255, 0.75);
			backdrop-filter: blur(14px);
		}
		.dark .glass-panel {
			background: rgba(15, 23, 42, 0.72);
		}
	</style>
</head>
<body class="min-h-screen bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased">

	<!-- Modal Component Script -->
	<script src="<?=url('_assets/js/modal.js')?>"></script>

	<!-- Theme Manager Script -->
	<script src="<?=url('_assets/js/theme.js')?>"></script>

	<div class="min-h-screen flex flex-col">
	<!-- Clean Customer Header -->
	<header class="sticky top-0 z-50 border-b border-slate-200/80 dark:border-slate-800 glass-panel shadow-soft">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="flex justify-between items-center h-16 gap-3">
				<!-- Logo -->
				<div class="flex items-center space-x-3 min-w-0">
					<div class="flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 dark:border-slate-700 bg-white/90 dark:bg-slate-900 shadow-soft">
						<img src="<?=url('_assets/img/logo/nav-logo.png')?>" alt="Logo" class="h-6 w-6">
					</div>
					<div class="min-w-0">
						<p class="text-[11px] uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Portal Pelanggan</p>
						<span class="block truncate text-base sm:text-lg font-semibold text-slate-900 dark:text-white">MR Clean Laundry</span>
					</div>
				</div>

				<!-- Right Side -->
				<div class="flex items-center space-x-3">
					<!-- Dark Mode Toggle -->
					<button id="theme-toggle" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 dark:border-slate-700 bg-white/90 dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-800 shadow-soft transition-colors">
						<i class="fas fa-moon text-slate-600 dark:text-slate-300"></i>
					</button>

					<!-- User Menu -->
					<div class="relative group">
						<button class="flex items-center space-x-2 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white/90 dark:bg-slate-900 px-3 py-2 shadow-soft hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
							<div class="w-8 h-8 rounded-xl bg-slate-900 dark:bg-slate-100 flex items-center justify-center text-white dark:text-slate-900 text-sm font-semibold shadow-soft">
								<?= strtoupper(substr($nama_pelanggan, 0, 1)) ?>
							</div>
							<div class="hidden sm:block text-left">
								<p class="max-w-[140px] truncate text-sm font-medium text-slate-700 dark:text-slate-200"><?= htmlspecialchars($nama_pelanggan) ?></p>
								<p class="max-w-[140px] truncate text-xs text-slate-500 dark:text-slate-400">@<?= htmlspecialchars($username_pelanggan) ?></p>
							</div>
							<i class="fas fa-chevron-down text-xs text-slate-500"></i>
						</button>

						<!-- Dropdown -->
						<div class="absolute right-0 mt-2 w-56 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white/95 dark:bg-slate-900/95 p-2 shadow-card opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
							<div class="py-1">
								<div class="px-3 pb-2 mb-1 border-b border-slate-200 dark:border-slate-800">
									<p class="text-sm font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($nama_pelanggan) ?></p>
									<p class="text-xs text-slate-500 dark:text-slate-400">Pelanggan aktif</p>
								</div>
								<a href="<?=url('pelanggan/profil.php')?>" class="flex items-center space-x-2 rounded-xl px-3 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">
									<i class="fas fa-user-circle w-4"></i>
									<span>Profil</span>
								</a>
								<a href="<?=url('pelanggan/logout.php')?>" class="flex items-center space-x-2 rounded-xl px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/40">
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
		<div class="border-t border-slate-200/80 dark:border-slate-800 bg-slate-50/80 dark:bg-slate-950/40">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<nav class="flex gap-2 overflow-x-auto py-3">
					<a href="<?=url('pelanggan/dashboard.php')?>" class="inline-flex items-center space-x-2 whitespace-nowrap rounded-xl2 border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900 px-4 py-2.5 text-sm font-medium text-slate-700 dark:text-slate-200 shadow-soft hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
						<i class="fas fa-home"></i>
						<span>Dashboard</span>
					</a>
					<a href="<?=url('pelanggan/order_baru.php')?>" class="inline-flex items-center space-x-2 whitespace-nowrap rounded-xl2 border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900 px-4 py-2.5 text-sm font-medium text-slate-700 dark:text-slate-200 shadow-soft hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
						<i class="fas fa-plus-circle"></i>
						<span>Order Baru</span>
					</a>
					<a href="<?=url('pelanggan/riwayat_order.php')?>" class="inline-flex items-center space-x-2 whitespace-nowrap rounded-xl2 border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900 px-4 py-2.5 text-sm font-medium text-slate-700 dark:text-slate-200 shadow-soft hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
						<i class="fas fa-history"></i>
						<span>Riwayat Order</span>
					</a>
					<a href="<?=url('pelanggan/profil.php')?>" class="inline-flex items-center space-x-2 whitespace-nowrap rounded-xl2 border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900 px-4 py-2.5 text-sm font-medium text-slate-700 dark:text-slate-200 shadow-soft hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
						<i class="fas fa-user"></i>
						<span>Profil</span>
					</a>
				</nav>
			</div>
		</div>
	</header>

	<main class="flex-1 w-full">
