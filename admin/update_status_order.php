<?php 
require_once('../_functions.php');

if(!isset($_SESSION['login']) || $_SESSION['master'] == ''){
	header("Location: ../login.php");
	exit;
}

// Ambil parameter
$tipe = $_GET['tipe']; // ck, dc, atau cs
$no_order = $_GET['no_order'];
$status_baru = $_GET['status'];

global $koneksi;

// Update status berdasarkan tipe
if($tipe == 'ck'){
	mysqli_query($koneksi, "UPDATE tb_order_ck SET status='$status_baru' WHERE or_ck_number='$no_order'");
} elseif($tipe == 'dc'){
	mysqli_query($koneksi, "UPDATE tb_order_dc SET status='$status_baru' WHERE or_dc_number='$no_order'");
} elseif($tipe == 'cs'){
	mysqli_query($koneksi, "UPDATE tb_order_cs SET status='$status_baru' WHERE or_cs_number='$no_order'");
}

$result = mysqli_affected_rows($koneksi);

if($result > 0 || $result == 0){
	echo "<script>
		alert('Status order berhasil diupdate menjadi: $status_baru');
		window.location='../index.php';
	</script>";
} else {
	echo "<script>
		alert('Status order gagal diupdate!');
		window.location='../index.php';
	</script>";
}
?>