<?php
include '_functions.php';
global $koneksi;

if (!isset($_GET['bulan'])) {
    echo "<script>alert('Silakan pilih bulan terlebih dahulu.');window.close();</script>";
    exit;
}

$bulan = $_GET['bulan'];
$tahun = substr($bulan, 0, 4);
$bulanNum = substr($bulan, 5, 2);

$namaBulan = [
    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
];
$bulanText = $namaBulan[$bulanNum] . " " . $tahun;

$query = "
    SELECT * FROM tb_order_dc 
    WHERE MONTH(tgl_masuk_dc) = '$bulanNum' 
    AND YEAR(tgl_masuk_dc) = '$tahun'
    ORDER BY tgl_masuk_dc ASC
";
$result = mysqli_query($koneksi, $query);
$totalOrder = mysqli_num_rows($result);

$totalPendapatan = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $totalPendapatan += $row['tot_bayar'];
    $data[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Bulanan Dry Clean</title>
<style>
    body {font-family: Arial, sans-serif; background: #fff; color: #000; margin: 40px;}
    h2, h4 {text-align: center; margin: 0;}
    table {width: 100%; border-collapse: collapse; margin-top: 25px;}
    th, td {border: 1px solid #555; padding: 8px; text-align: center;}
    th {background: #007bff; color: white;}
    tr:nth-child(even) {background: #f9f9f9;}
    .summary {margin-top: 25px; border: 1px solid #ccc; padding: 15px; background: #f7f7f7; width: 50%;}
    .summary p {margin: 5px 0; font-size: 16px;}
    .print-btn {margin-top: 20px; text-align: center;}
    .print-btn button {background: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-size: 16px;}
    .print-btn button:hover {background: #218838;}
</style>
</head>
<body>

<h2>🧼 Laporan Bulanan Order Dry Clean</h2>
<h4>Periode: <?= $bulanText; ?></h4>
<hr>

<?php if (!empty($data)): ?>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>No. Order</th>
            <th>Nama Pelanggan</th>
            <th>Jenis Paket</th>
            <th>Tgl Masuk</th>
            <th>Tgl Keluar</th>
            <th>Berat (Kg)</th>
            <th>Total Bayar</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($data as $d): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['or_dc_number']; ?></td>
            <td><?= $d['nama_pel_dc']; ?></td>
            <td><?= $d['jenis_paket_dc']; ?></td>
            <td><?= $d['tgl_masuk_dc']; ?></td>
            <td><?= $d['tgl_keluar_dc']; ?></td>
            <td><?= $d['berat_qty_dc']; ?></td>
            <td>Rp <?= number_format($d['tot_bayar']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="summary">
    <p><strong>Total Order:</strong> <?= $totalOrder; ?> transaksi</p>
    <p><strong>Total Pendapatan:</strong> Rp <?= number_format($totalPendapatan); ?></p>
</div>

<div class="print-btn">
    <button onclick="window.print()">🖨 Cetak / Simpan PDF</button>
</div>

<?php else: ?>
    <p style="text-align:center; color:red;">Tidak ada data order untuk bulan <?= $bulanText; ?>.</p>
<?php endif; ?>

</body>
</html>
