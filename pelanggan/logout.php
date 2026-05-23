<?php 
require_once('../_functions.php');

// Hapus session pelanggan
unset($_SESSION['login_pelanggan']);
unset($_SESSION['id_pelanggan']);
unset($_SESSION['nama_pelanggan']);
unset($_SESSION['username_pelanggan']);

session_destroy();

echo "<script>
	alert('Anda telah logout!');
	window.location='../login_pelanggan.php';
</script>";
?>