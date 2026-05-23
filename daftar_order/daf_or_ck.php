<div class="col">
   <div class="card">
      <div class="card-title card-flex">
         <div class="card-col">
            <h2>Order Cuci Komplit</h2>	
         </div>
      </div>

      <div class="card-body">

         <!-- 🔍 Form Pencarian + 🖨 Cetak Laporan Bulanan -->
         <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; flex-wrap:wrap; gap:10px;">
            <form method="GET" style="display:flex; gap:8px; align-items:center;">
               <input type="text" name="cari_ck" placeholder="Cari order (nama / nomor / paket)" 
                  value="<?= isset($_GET['cari_ck']) ? $_GET['cari_ck'] : ''; ?>"
                  style="padding:6px 10px; border:1px solid #ccc; border-radius:5px; flex:1; min-width:240px;">
               <button type="submit" style="padding:6px 12px; background:#007bff; color:#fff; border:none; border-radius:5px;">Cari</button>
               <a href="index.php" style="padding:6px 12px; background:#6c757d; color:white; text-decoration:none; border-radius:5px;">Reset</a>
            </form>

            <form action="laporan_ck.php" method="GET" target="_blank" style="display:flex; gap:8px; align-items:center;">
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
                  if (!empty($_GET['cari_ck'])) {
                     $cari = mysqli_real_escape_string($koneksi, $_GET['cari_ck']);
                     $where = "WHERE or_ck_number LIKE '%$cari%' OR nama_pel_ck LIKE '%$cari%' OR jenis_paket_ck LIKE '%$cari%'";
                  }

                  $cuci_komplit = query("SELECT * FROM tb_order_ck $where ORDER BY id_order_ck DESC");
                  if (!empty($cuci_komplit)) :
                     $no_ck = 1;
                     foreach($cuci_komplit as $ck) : ?>
                     <tr>
                        <td><?= $no_ck; ?></td>
                        <td><?= $ck['or_ck_number'] ?></td>
                        <td><?= $ck['tgl_masuk_ck'] ?></td>
                        <td><?= $ck['nama_pel_ck'] ?></td>
                        <td><?= $ck['jenis_paket_ck'] ?></td>
                        <td><?= $ck['wkt_krj_ck'] ?></td>
                        <td><?= $ck['berat_qty_ck'] . ' Kg' ?></td>

                        <!-- KOLOM METODE PENGAMBILAN (HARUS DULUAN!) -->
                        <td>
                           <?php 
                           $metode = isset($ck['metode_pengambilan']) ? $ck['metode_pengambilan'] : 'Ambil di Tempat';
                           $icon = ($metode == 'Antar Jemput') ? '🚚' : '🏠';
                           $color = ($metode == 'Antar Jemput') ? 'color: #e17055; font-weight: 600;' : 'color: #00b894;';
                           ?>
                           <span style="<?= $color ?> font-size: 12px;">
                              <?= $icon ?> <?= $metode ?>
                           </span>
                        </td>
                        
                        <!-- KOLOM STATUS (SETELAH METODE!) -->
                        <td>
                           <?php 
                           $status = $ck['status'] ?? 'Pending';
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

                        <td>
                           <a href="<?=url('detail_order/detail_ck/detail_order_ck.php?or_ck_number=')?><?=$ck['or_ck_number']?>" class="btn btn-detail">Detail</a>
                           <a href="<?=url('daftar_order/hapus_ck.php?or_ck_number=')?><?=$ck['or_ck_number']?>" onclick="return confirm('Yakin akan menghapus?');" class="btn btn-hapus">Hapus</a>
                           <!-- Dropdown Update Status -->
                           <select onchange="updateStatus(this.value, '<?=$ck['or_ck_number']?>', 'ck')" style="padding: 5px; margin-top: 5px; border-radius: 4px; border: 1px solid #ddd;">
                              <option value="">-- Update Status --</option>
                              <option value="Pending" <?= (isset($ck['status']) && $ck['status'] == 'Pending') ? 'selected' : '' ?>>⏳ Pending</option>
                              <option value="Diproses" <?= (isset($ck['status']) && $ck['status'] == 'Diproses') ? 'selected' : '' ?>>🔄 Diproses</option>
                              <option value="Selesai" <?= (isset($ck['status']) && $ck['status'] == 'Selesai') ? 'selected' : '' ?>>✅ Selesai</option>
                              <option value="Sedang Diantar" <?= (isset($ck['status']) && $ck['status'] == 'Sedang Diantar') ? 'selected' : '' ?>>🚚 Sedang Diantar</option>
                              <option value="Diambil" <?= (isset($ck['status']) && $ck['status'] == 'Diambil') ? 'selected' : '' ?>>📦 Diambil</option>
                           </select>
                        </td>
                     </tr>
                  <?php $no_ck++; endforeach; else : ?>
                     <tr>
                        <td colspan="10" class="txt-center">Data Tidak Tersedia</td>
                     </tr>
                  <?php endif; ?>
               </tbody>
            </table>
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
</div>