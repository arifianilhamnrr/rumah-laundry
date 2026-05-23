<div class="col">
   <div class="card">
      <div class="card-title card-flex">
         <div class="card-col">
            <h2>Order Cuci Satuan</h2>	
         </div>
      </div>

      <div class="card-body">

         <!-- 🔍 Cari & 🖨 Cetak -->
         <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; flex-wrap:wrap; gap:10px;">
            <form method="GET" style="display:flex; gap:8px; align-items:center;">
               <input type="text" name="cari_cs" placeholder="Cari order (nama / nomor / paket)" 
                  value="<?= isset($_GET['cari_cs']) ? $_GET['cari_cs'] : ''; ?>"
                  style="padding:6px 10px; border:1px solid #ccc; border-radius:5px; flex:1; min-width:240px;">
               <button type="submit" style="padding:6px 12px; background:#007bff; color:#fff; border:none; border-radius:5px;">Cari</button>
               <a href="index.php" style="padding:6px 12px; background:#6c757d; color:white; text-decoration:none; border-radius:5px;">Reset</a>
            </form>

            <form action="laporan_cs.php" method="GET" target="_blank" style="display:flex; gap:8px; align-items:center;">
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
                     <th class="sticky">Jumlah (Pcs)</th>
                     <th class="sticky">Metode</th>
                     <th class="sticky">Status</th> <!-- TAMBAHAN: KOLOM STATUS -->
                     <th class="sticky">Action</th>
                  </tr>
               </thead>

               <tbody>
                  <?php 
                  $where = "";
                  if (!empty($_GET['cari_cs'])) {
                     $cari = mysqli_real_escape_string($koneksi, $_GET['cari_cs']);
                     $where = "WHERE or_cs_number LIKE '%$cari%' OR nama_pel_cs LIKE '%$cari%' OR jenis_paket_cs LIKE '%$cari%'";
                  }

                  $cuci_satuan = query("SELECT * FROM tb_order_cs $where ORDER BY id_order_cs DESC");
                  if (!empty($cuci_satuan)) :
                     $no_cs = 1;
                     foreach($cuci_satuan as $cs) : ?>
                     <tr>
                        <td><?= $no_cs; ?></td>
                        <td><?= $cs['or_cs_number'] ?></td>
                        <td><?= $cs['tgl_masuk_cs'] ?></td>
                        <td><?= $cs['nama_pel_cs'] ?></td>
                        <td><?= $cs['jenis_paket_cs'] ?></td>
                        <td><?= $cs['wkt_krj_cs'] ?></td>
                        <td><?= $cs['jml_pcs'] . ' Pcs' ?></td>
                        
                        <!-- KOLOM METODE PENGAMBILAN -->
                        <td>
                           <?php 
                           $metode = isset($cs['metode_pengambilan']) ? $cs['metode_pengambilan'] : 'Ambil di Tempat'; // PERBAIKAN: $cs bukan $ck
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
                           $status = $cs['status'] ?? 'Pending';
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
                           <a href="<?=url('detail_order/detail_cs/detail_order_cs.php?or_cs_number=')?><?=$cs['or_cs_number']?>" class="btn btn-detail">Detail</a>
                           <a href="<?=url('daftar_order/hapus_cs.php?or_cs_number=')?><?=$cs['or_cs_number']?>" onclick="return confirm('Yakin akan menghapus?');" class="btn btn-hapus">Hapus</a>
                           
                           <select onchange="updateStatus(this.value, '<?=$cs['or_cs_number']?>', 'cs')" style="padding: 5px; margin-top: 5px; border-radius: 4px; border: 1px solid #ddd; width: 140px;">
                              <?php $current_status = $cs['status'] ?? 'Pending'; ?>
                              <option value="">-- Update Status --</option>
                              <option value="Pending" <?= ($current_status == 'Pending') ? 'selected' : '' ?>>⏳ Pending</option>
                              <option value="Diproses" <?= ($current_status == 'Diproses') ? 'selected' : '' ?>>🔄 Diproses</option>
                              <option value="Selesai" <?= ($current_status == 'Selesai') ? 'selected' : '' ?>>✅ Selesai</option>
                              <option value="Sedang Diantar" <?= ($current_status == 'Sedang Diantar') ? 'selected' : '' ?>>🚚 Sedang Diantar</option>
                              <option value="Diambil" <?= ($current_status == 'Diambil') ? 'selected' : '' ?>>📦 Diambil</option>
                           </select>
                        </td>
                     </tr>
                  <?php $no_cs++; endforeach; else : ?>
                     <tr>
                        <td colspan="10" class="txt-center">Data Tidak Tersedia</td> <!-- PERBAIKAN: colspan="10" -->
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