<?php
	require_once('_functions.php');
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MR Clean Laundry | Dashboard</title>

	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>

	<!-- Custom Tailwind Config with Dark Mode -->
	<script>
		tailwind.config = {
			darkMode: 'class',
			theme: {
				extend: {
					colors: {
						primary: {
							50: '#eff6ff',
							100: '#dbeafe',
							200: '#bfdbfe',
							300: '#93c5fd',
							400: '#60a5fa',
							500: '#3b82f6',
							600: '#2563eb',
							700: '#1d4ed8',
							800: '#1e40af',
							900: '#1e3a8a',
						}
					}
				}
			}
		}
	</script>

	<!-- Font Awesome for Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<link rel="shortcut icon" href="<?=url('_assets/img/logo/nav-logo.png')?>" type="image/x-icon">

	<style>
		/* Dark mode variables */
		:root {
			--bg-primary: #ffffff;
			--bg-secondary: #f8fafc;
			--text-primary: #1e293b;
			--text-secondary: #64748b;
			--border-color: #e2e8f0;
		}

		.dark {
			--bg-primary: #0f172a;
			--bg-secondary: #1e293b;
			--text-primary: #f1f5f9;
			--text-secondary: #94a3b8;
			--border-color: #334155;
		}

		/* Smooth transitions */
		* {
			transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
		}
	</style>
</head>
<body class="bg-slate-50 dark:bg-slate-900 min-h-screen transition-colors duration-200">

	<!-- Modal Component Script -->
	<script src="<?=url('_assets/js/modal.js')?>"></script>

	<!-- Theme Manager Script -->
	<script src="<?=url('_assets/js/theme.js')?>"></script>

	<!-- Clean Minimalist Header -->
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
								<?= strtoupper(substr($_SESSION['master'], 0, 1)) ?>
							</div>
							<span class="hidden sm:block text-sm font-medium text-slate-700 dark:text-slate-200"><?= htmlspecialchars(ucfirst($_SESSION['master'])) ?></span>
							<i class="fas fa-chevron-down text-xs text-slate-500"></i>
						</button>

						<!-- Dropdown -->
						<div class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-lg shadow-lg border border-slate-200 dark:border-slate-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
							<div class="py-1">
								<a href="<?=url('about.php')?>" class="flex items-center space-x-2 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700">
									<i class="fas fa-info-circle w-4"></i>
									<span>Tentang</span>
								</a>
								<a href="<?=url('logout.php')?>" class="flex items-center space-x-2 px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
									<i class="fas fa-sign-out-alt w-4"></i>
									<span>Logout</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Sidebar Navigation -->
	<?php include_once('_includes/sidebar.php'); ?>

	<!-- Sidebar Toggle Script -->
	<script src="<?=url('_assets/js/sidebar.js')?>"></script>
