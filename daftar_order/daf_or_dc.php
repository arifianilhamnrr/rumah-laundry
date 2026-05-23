<div class="col">
   <div class="card">
      <div class="card-title card-flex">
         <div class="card-col">
            <h2>Order Dry Clean</h2>	
         </div>
      </div>

      <div class="card-body">

         <!-- 🔍 Form Pencarian + 🖨 Cetak Laporan Bulanan -->
         <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; flex-wrap:wrap; gap:10px;">
            <form method="GET" style="display:flex; gap:8px; align-items:center;">
               <input type="text" name="cari_dc" placeholder="Cari order (nama / nomor / paket)" 
                  value="<?= isset($_GET['cari_dc']) ? $_GET['cari_dc'] : ''; ?>"
                  style="padding:6px 10px; border:1px solid #ccc; border-radius:5px; flex:1; min-width:240px;">
               <button type="submit" style="padding:6px 12px; background:#007bff; color:#fff; border:none; border-radius:5px;">Cari</button>
               <a href="index.php" style="padding:6px 12px; background:#6c757d; color:white; text-decoration:none; border-radius:5px;">Reset</a>
            </form>

            <form action="laporan_dc.php" method="GET" target="_blank" style="display:flex; gap:8px; align-items:center;">
               <input type="month" name="bulan" required style="padding:6px 10px; border:1px solid #ccc; border-radius:5px;">
               <button type="submit" style="padding:6px 12px; background:#28a745; color:#fff; border:none; border-radius:5px;">🖨 Cetak</button>
            </form>
         </div>

         <div class="tabel-kontainer">
            <table class="tabel-transaksi">
               <thead>
                  <tr>
                     <th class="sticky">No</th>
                     <th class="sticky">No.Order</th>
                     <th class="sticky">Tgl Order</th>
                     <th class="sticky">Nama Pelanggan</th>
                     <th class="sticky">Jenis Paket</th>
                     <th class="sticky">Waktu Kerja</th>
                     <th class="sticky">Berat (Kg)</th>
                     <th class="sticky">Metode</th>
                     <th class="sticky">Status</th>
                     <th class="sticky">Action</th>
                  </tr>
               </thead>

               <tbody>
                  <?php 
                  $where = "";
                  if (!empty($_GET['cari_dc'])) {
                     $cari = mysqli_real_escape_string($koneksi, $_GET['cari_dc']);
                     $where = "WHERE or_dc_number LIKE '%$cari%' OR nama_pel_dc LIKE '%$cari%' OR jenis_paket_dc LIKE '%$cari%'";
                  }

                  $dry_clean = query("SELECT * FROM tb_order_dc $where ORDER BY id_order_dc DESC");
                  if (!empty($dry_clean)) :
                     $no_dc = 1;
                     foreach($dry_clean as $dc) : ?>
                     <tr>
                        <td><?= $no_dc; ?></td>
                        <td><?= $dc['or_dc_number'] ?></td>
                        <td><?= $dc['tgl_masuk_dc'] ?></td>
                        <td><?= $dc['nama_pel_dc'] ?></td>
                        <td><?= $dc['jenis_paket_dc'] ?></td>
                        <td><?= $dc['wkt_krj_dc'] ?></td>
                        <td><?= $dc['berat_qty_dc'] . ' Kg' ?></td>
                        
                        <!-- KOLOM METODE PENGAMBILAN -->
                        <td>
                           <?php 
                           $metode = isset($dc['metode_pengambilan']) ? $dc['metode_pengambilan'] : 'Ambil di Tempat';
                           $icon = ($metode == 'Antar Jemput') ? '🚚' : '🏠';
                           $color = ($metode == 'Antar Jemput') ? 'color: #e17055; font-weight: 600;' : 'color: #00b894;';
                           ?>
                           <span style="<?= $color ?> font-size: 12px;">
                              <?= $icon ?> <?= $metode ?>
                           </span>
                        </td>
                        
                        <!-- KOLOM STATUS -->
                        <td>
                           <?php 
                           $status = $dc['status'] ?? 'Pending';
                           $badge_color = '';
                           if($status == 'Pending') {
                              $badge_color = 'background: #ffeaa7; color: #d63031;';
                           } elseif($status == 'Diproses') {
                              $badge_color = 'background: #74b9ff; color: #0984e3;';
                           } elseif($status == 'Selesai') {
                              $badge_color = 'background: #55efc4; color: #00b894;';
                           } elseif($status == 'Sedang Diantar') {
                              $badge_color = 'background: #fdcb6e; color: #e17055;';
                           } elseif($status == 'Diambil') {
                              $badge_color = 'background: #dfe6e9; color: #636e72;';
                           }
                           ?>
                           <span style="<?= $badge_color ?> padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; display: inline-block;">
                              <?= $status ?>
                           </span>
                        </td>

                        <!-- KOLOM ACTION -->
                        <td>
                           <a href="<?=url('detail_order/detail_dc/detail_order_dc.php?or_dc_number=')?><?=$dc['or_dc_number']?>" class="btn btn-detail">Detail</a>
                           <a href="<?=url('daftar_order/hapus_dc.php?or_dc_number=')?><?=$dc['or_dc_number']?>" onclick="return confirm('Yakin akan menghapus?');" class="btn btn-hapus">Hapus</a>
                           
                           <select onchange="updateStatus(this.value, '<?=$dc['or_dc_number']?>', 'dc')" style="padding: 5px; margin-top: 5px; border-radius: 4px; border: 1px solid #ddd; width: 140px;">
                              <?php $current_status = $dc['status'] ?? 'Pending'; ?>
                              <option value="">-- Update Status --</option>
                              <option value="Pending" <?= ($current_status == 'Pending') ? 'selected' : '' ?>>⏳ Pending</option>
                              <option value="Diproses" <?= ($current_status == 'Diproses') ? 'selected' : '' ?>>🔄 Diproses</option>
                              <option value="Selesai" <?= ($current_status == 'Selesai') ? 'selected' : '' ?>>✅ Selesai</option>
                              <option value="Sedang Diantar" <?= ($current_status == 'Sedang Diantar') ? 'selected' : '' ?>>🚚 Sedang Diantar</option>
                              <option value="Diambil" <?= ($current_status == 'Diambil') ? 'selected' : '' ?>>📦 Diambil</option>
                           </select>
                        </td>
                     </tr>
                  <?php $no_dc++; endforeach; else : ?>
                     <tr>
                        <td colspan="10" class="txt-center">Data Tidak Tersedia</td>
                     </tr>
                  <?php endif; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<!-- Script JavaScript dipindah ke sini (DI LUAR loop) -->
<script>
function updateStatus(status, noOrder, tipe){
   if(status != ''){
      if(confirm('Update status order menjadi: ' + status + '?')){
         window.location = '<?=url('admin/update_status_order.php')?>?tipe=' + tipe + '&no_order=' + noOrder + '&status=' + status;
      }
   }
}
</script>