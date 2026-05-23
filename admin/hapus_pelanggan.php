<?php 
	require_once('../_header.php');
	
	if(!isset($_SESSION['login']) || $_SESSION['master'] == ''){
		header("Location: ../login.php");
		exit;
	}
	
	$id = $_GET['id'];

	// Hapus pelanggan
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id'");
	$result = mysqli_affected_rows($koneksi);
?>

<?php if($result > 0): ?>
	<div class="alert">
		<div class="box">
			<img src="<?=url('_assets/img/berhasil.png')?>" height="68" alt="alert sukses">
			<p>Pelanggan Berhasil Dihapus</p>
			<button onclick="window.location='<?=url('admin/daftar_pelanggan.php')?>'" class="btn-alert">Ok</button>
		</div>
	</div>
<?php else: ?>
	<div class="alert">
		<div class="box">
			<img src="<?=url('_assets/img/gagal.png')?>" height="68" alt="alert gagal">
			<p>Pelanggan Gagal Dihapus</p>
			<button onclick="window.location='<?=url('admin/daftar_pelanggan.php')?>'" class="btn-alert">Ok</button>
		</div>
	</div>
<?php endif; ?>