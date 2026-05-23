<?php
require_once('_functions.php');

// Jika sudah login, redirect
if (isset($_SESSION['login_pelanggan'])) {
	header("Location: pelanggan/dashboard.php");
	exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daftar Akun Pelanggan | Rumah Laundry</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="shortcut icon" href="<?= url('_assets/img/logo/nav-logo.png') ?>" type="image/x-icon">
</head>

<body class="bg-slate-50 min-h-screen flex flex-col items-center justify-center font-sans antialiased relative py-8 px-4">

	<?php
	if (isset($_POST['daftar'])) {
		if (register_pelanggan($_POST) > 0) {
			echo "<script>
                    alert('Pendaftaran berhasil! Silakan login.');
                    window.location='login_pelanggan.php';
                </script>";
		} else {
			echo "
                    <div class='fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50' id='error-overlay'>
                        <div class='bg-white p-6 rounded-2xl shadow-2xl relative max-w-sm w-full mx-4 text-center transform transition-all'>
                            <button onclick='document.getElementById(\"error-overlay\").remove()' class='absolute top-3 right-4 text-2xl text-gray-400 hover:text-gray-700'>&times;</button>
                            <div class='w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4'>
                                <svg class='w-8 h-8 text-red-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12'></path></svg>
                            </div>
                            <p class='text-gray-800 font-semibold text-lg'>Pendaftaran Gagal!</p>
                            <p class='text-gray-500 text-sm mt-1'>Periksa kembali data yang Anda masukkan.</p>
                        </div>
                    </div>
                ";
		}
	}
	?>

	<div class="flex w-full max-w-6xl bg-white rounded-3xl shadow-[0_20px_50px_rgba(8,_112,_184,_0.1)] overflow-hidden z-10 relative min-h-[720px]">

		<div class="w-full lg:w-5/12 p-8 sm:p-10 lg:p-12 flex flex-col justify-center bg-white relative z-20">
			<div class="mb-8 text-center">
				<img src="<?= url('_assets/img/logo/nav-logo.png') ?>" alt="Logo Rumah Laundry"
					class="h-20 w-auto mx-auto mb-6 object-contain">
				<h4 class="text-2xl font-bold text-gray-800 tracking-tight">Daftar Akun Pelanggan</h4>
				<p class="text-sm text-gray-500 mt-1">Buat akun untuk memesan layanan laundry</p>
			</div>

			<form action="" method="post" class="w-full max-w-sm mx-auto space-y-5">
				<div class="relative">
					<input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required autocomplete="off"
						class="w-full border-b-2 border-gray-200 py-2 text-gray-700 focus:outline-none focus:border-blue-500 transition-colors bg-transparent placeholder-gray-400">
				</div>

				<div class="relative">
					<input type="email" name="email" placeholder="Email" required autocomplete="off"
						class="w-full border-b-2 border-gray-200 py-2 text-gray-700 focus:outline-none focus:border-blue-500 transition-colors bg-transparent placeholder-gray-400">
				</div>

				<div class="relative">
					<input type="text" name="no_telp" placeholder="Nomor Telepon" required autocomplete="off" pattern="[0-9]+" title="Hanya angka"
						class="w-full border-b-2 border-gray-200 py-2 text-gray-700 focus:outline-none focus:border-blue-500 transition-colors bg-transparent placeholder-gray-400">
				</div>

				<div class="relative">
					<textarea name="alamat" placeholder="Alamat Lengkap" required rows="3"
						class="w-full border-b-2 border-gray-200 py-2 text-gray-700 focus:outline-none focus:border-blue-500 transition-colors bg-transparent placeholder-gray-400 resize-none"></textarea>
				</div>

				<div class="relative">
					<input type="text" name="username" placeholder="Username" required autocomplete="off"
						class="w-full border-b-2 border-gray-200 py-2 text-gray-700 focus:outline-none focus:border-blue-500 transition-colors bg-transparent placeholder-gray-400">
				</div>

				<div class="relative">
					<input type="password" name="password" id="password" placeholder="Password" required autocomplete="off" minlength="6"
						class="w-full border-b-2 border-gray-200 py-2 text-gray-700 focus:outline-none focus:border-blue-500 transition-colors bg-transparent placeholder-gray-400 pr-10">
					<button type="button" onclick="togglePassword('password', 'eye-icon-password', 'eye-slash-icon-password')"
						class="absolute right-0 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors focus:outline-none p-1">
						<svg id="eye-icon-password" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
							<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
						</svg>
						<svg id="eye-slash-icon-password" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
						</svg>
					</button>
				</div>

				<div class="relative">
					<input type="password" name="konfirmasi_password" id="konfirmasi_password" placeholder="Konfirmasi Password" required autocomplete="off" minlength="6"
						class="w-full border-b-2 border-gray-200 py-2 text-gray-700 focus:outline-none focus:border-blue-500 transition-colors bg-transparent placeholder-gray-400 pr-10">
					<button type="button" onclick="togglePassword('konfirmasi_password', 'eye-icon-confirm', 'eye-slash-icon-confirm')"
						class="absolute right-0 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors focus:outline-none p-1">
						<svg id="eye-icon-confirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
							<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
						</svg>
						<svg id="eye-slash-icon-confirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
						</svg>
					</button>
				</div>

				<div class="pt-3">
					<button type="submit" name="daftar"
						class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-4 rounded-full transition-all duration-300 shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-0.5">
						DAFTAR
					</button>
				</div>

				<div class="text-center mt-6 space-y-2 text-sm text-gray-600">
					<p>Sudah punya akun? <a href="login_pelanggan.php"
							class="text-blue-500 font-semibold hover:text-blue-600 transition-colors">Login di sini</a></p>
					<p><a href="login.php"
							class="text-blue-500 font-semibold hover:text-blue-600 transition-colors">Login sebagai Admin</a></p>
				</div>
			</form>
		</div>

		<div class="hidden lg:flex w-7/12 bg-gradient-to-br from-[#00c6ff] to-[#0072ff] relative p-12 flex-col items-end overflow-hidden">
			<div class="text-right text-white z-20 w-full mb-8">
				<h1 class="text-4xl font-extrabold tracking-wide drop-shadow-md">Mr. Clean Laundry</h1>
				<p class="text-lg mt-2 font-medium text-white/90 drop-shadow-sm">Daftar untuk menikmati layanan laundry kami</p>
			</div>

			<img src="<?= url('_assets/img/orang.png') ?>" alt="Mr. Clean"
				class="absolute bottom-0 left-4 h-[85%] object-contain z-20 drop-shadow-2xl">

			<div class="absolute right-16 top-1/3 flex flex-col gap-8 z-20">
				<div class="bg-white/20 p-4 rounded-2xl backdrop-blur-md border border-white/30 shadow-xl animate-[bounce_3s_infinite]">
					<img src="<?= url('_assets/img/kaos.png') ?>" alt="Kaos" class="w-16 h-16 object-contain">
				</div>
				<div class="bg-white/20 p-4 rounded-2xl backdrop-blur-md border border-white/30 shadow-xl animate-[bounce_4s_infinite_1s] -ml-10">
					<img src="<?= url('_assets/img/celana.png') ?>" alt="Celana" class="w-16 h-16 object-contain">
				</div>
				<div class="bg-white/20 p-4 rounded-2xl backdrop-blur-md border border-white/30 shadow-xl animate-[bounce_3.5s_infinite_0.5s]">
					<img src="<?= url('_assets/img/kemeja.png') ?>" alt="Kemeja" class="w-16 h-16 object-contain">
				</div>
			</div>

			<div class="absolute top-20 left-20 w-12 h-12 bg-white/20 rounded-full blur-[2px]"></div>
			<div class="absolute bottom-32 left-1/2 w-8 h-8 bg-white/30 rounded-full"></div>
			<div class="absolute top-1/2 right-1/4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>

			<div class="absolute top-1/4 left-1/3 w-16 h-1 rounded-full bg-white/40 rotate-45"></div>
			<div class="absolute bottom-1/4 right-1/3 w-20 h-1.5 rounded-full bg-white/30 -rotate-12"></div>
			<div class="absolute top-1/2 left-1/4 w-10 h-1 rounded-full bg-white/50 rotate-[30deg]"></div>
			<div class="absolute top-24 right-32 w-14 h-1 rounded-full bg-white/40 -rotate-[20deg]"></div>
		</div>
	</div>

	<script>
		document.getElementById("tahun").innerHTML = new Date().getFullYear();

		function togglePassword(fieldId, eyeId, eyeSlashId) {
			var passwordInput = document.getElementById(fieldId);
			var eyeIcon = document.getElementById(eyeId);
			var eyeSlashIcon = document.getElementById(eyeSlashId);

			if (passwordInput.type === "password") {
				passwordInput.type = "text";
				eyeIcon.classList.add("hidden");
				eyeSlashIcon.classList.remove("hidden");
			} else {
				passwordInput.type = "password";
				eyeIcon.classList.remove("hidden");
				eyeSlashIcon.classList.add("hidden");
			}
		}
	</script>

</body>

</html>
