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
	<link rel="stylesheet" href="<?=url('_assets/css/style.css')?>">
	<link rel="shortcut icon" href="<?=url('_assets/img/logo/nav-logo.png')?>" type="image/x-icon">
	<style>
		/* Custom styling untuk pelanggan */
		header nav {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		}

		.nav-menu li span {
			color: white;
			font-weight: 600;
		}

		.welcome-card {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			padding: 30px;
			border-radius: 10px;
			margin-bottom: 20px;
		}

		.welcome-card h2 {
			margin: 0 0 10px 0;
		}

		.welcome-card p {
			margin: 0;
			opacity: 0.9;
		}

		.status-badge {
			display: inline-block;
			padding: 5px 12px;
			border-radius: 20px;
			font-size: 12px;
			font-weight: 600;
		}

		.status-pending {
			background: #ffeaa7;
			color: #fdcb6e;
		}

		.status-proses {
			background: #74b9ff;
			color: #0984e3;
		}

		.status-selesai {
			background: #55efc4;
			color: #00b894;
		}

		.status-sedang-diantar {
			background: #9e1107ff;
			color: #d4c9eeff;
		}

		.status-diambil {
			background: #dfe6e9;
			color: #636e72;
		}
	</style>
</head>
<body>

	<header>
		<nav>
			<div class="logo">
				<a href="<?=url('pelanggan/dashboard.php')?>">
					<img src="<?=url('_assets/img/logo/nav-logo.png')?>" alt="MR. Clean Laundry">
				</a>
			</div>
			<ul class="nav-menu">
				<li>
					<span id="">👤 <?= ucfirst($nama_pelanggan) ?></span>
					<ul class="dropdown-menu">
						<li><a href="<?=url('pelanggan/profil.php')?>">Profil Saya</a></li>
						<li><a href="<?=url('pelanggan/logout.php')?>">Logout</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<div id="nav-mini">
			<a href="<?=url('pelanggan/dashboard.php')?>" class="link-nav">Dashboard</a>
			<a href="<?=url('pelanggan/order_baru.php')?>" class="link-nav">Order Baru</a>
			<a href="<?=url('pelanggan/riwayat_order.php')?>" class="link-nav">Riwayat Order</a>
			<a href="<?=url('pelanggan/profil.php')?>" class="link-nav">Profil</a>
		</div>
	</header>