<?php
require_once('_functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test Assets - Rumah Laundry</title>
	<link rel="stylesheet" href="<?=url('_assets/css/style.css')?>">
	<style>
		.test-container {
			max-width: 800px;
			margin: 50px auto;
			padding: 20px;
			background: white;
			border-radius: 10px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
		}
		.test-item {
			padding: 15px;
			margin: 10px 0;
			border: 1px solid #ddd;
			border-radius: 5px;
		}
		.success { color: green; }
		.error { color: red; }
		.info { color: blue; }
	</style>
</head>
<body>
	<div class="test-container">
		<h1>🔍 Test Assets Loading</h1>
		<p class="info">Halaman ini untuk mengecek apakah CSS, JS, dan gambar terbaca dengan benar di mobile.</p>

		<div class="test-item">
			<h3>📍 URL Information</h3>
			<p><strong>Base URL:</strong> <?= url() ?></p>
			<p><strong>CSS URL:</strong> <?= url('_assets/css/style.css') ?></p>
			<p><strong>JS URL:</strong> <?= url('_assets/js/rumah_laundry.js') ?></p>
			<p><strong>Logo URL:</strong> <?= url('_assets/img/logo/nav-logo.png') ?></p>
		</div>

		<div class="test-item">
			<h3>🎨 CSS Test</h3>
			<p>Jika CSS terbaca, kotak ini akan memiliki border dan padding yang rapi.</p>
			<div class="card">
				<div class="card-body">
					<p>Ini adalah card dengan styling dari style.css</p>
				</div>
			</div>
		</div>

		<div class="test-item">
			<h3>🖼️ Image Test</h3>
			<p>Logo harus muncul di bawah ini:</p>
			<img src="<?= url('_assets/img/logo/nav-logo.png') ?>" alt="Logo" style="max-width: 200px;">
		</div>

		<div class="test-item">
			<h3>📱 Responsive Test</h3>
			<p>Resize browser atau buka di mobile untuk test responsive.</p>
			<div class="baris">
				<div class="col col-4">
					<div class="card">
						<div class="card-body">
							<p>Card 1</p>
						</div>
					</div>
				</div>
				<div class="col col-4">
					<div class="card">
						<div class="card-body">
							<p>Card 2</p>
						</div>
					</div>
				</div>
				<div class="col col-4">
					<div class="card">
						<div class="card-body">
							<p>Card 3</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="test-item">
			<h3>📊 Server Info</h3>
			<p><strong>HTTP_HOST:</strong> <?= $_SERVER['HTTP_HOST'] ?></p>
			<p><strong>SCRIPT_NAME:</strong> <?= $_SERVER['SCRIPT_NAME'] ?></p>
			<p><strong>DOCUMENT_ROOT:</strong> <?= $_SERVER['DOCUMENT_ROOT'] ?></p>
		</div>

		<div class="test-item">
			<h3>✅ Checklist</h3>
			<ul>
				<li>CSS terbaca? (Lihat styling card di atas)</li>
				<li>Logo muncul? (Lihat gambar di atas)</li>
				<li>Responsive? (Resize browser atau buka di mobile)</li>
			</ul>
		</div>

		<div style="text-align: center; margin-top: 30px;">
			<a href="<?= url() ?>" class="btn-lg bg-primary">Kembali ke Dashboard</a>
		</div>
	</div>

	<script src="<?=url('_assets/js/rumah_laundry.js')?>"></script>
	<script>
		console.log('✅ JavaScript loaded successfully!');
		console.log('Base URL:', '<?= url() ?>');
	</script>
</body>
</html>
