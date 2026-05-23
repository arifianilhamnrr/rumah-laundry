# 🗄️ PANDUAN PERBAIKAN DATABASE - RUMAH LAUNDRY

**Tanggal:** 23 Mei 2026  
**Priority:** 🟡 MEDIUM  
**Estimasi Waktu:** 5-7 hari

---

## 📋 DAFTAR ISI

1. [Add Foreign Keys](#1-add-foreign-keys)
2. [Add Timestamps](#2-add-timestamps)
3. [Implement Soft Delete](#3-implement-soft-delete)
4. [Reduce Data Redundancy](#4-reduce-data-redundancy)
5. [Add Indexes](#5-add-indexes)
6. [Migration Script](#6-migration-script)

---

## 1. ADD FOREIGN KEYS

### Masalah Saat Ini
- Tidak ada relasi antar tabel
- Data integrity tidak terjaga
- Bisa terjadi orphaned records
- Tidak ada cascade delete/update

### Solusi: Tambahkan Foreign Keys

#### Step 1: Backup Database
```sql
-- Backup dulu sebelum modifikasi
mysqldump -u root laundry_app > backup_before_fk.sql
```

#### Step 2: Tambah Kolom id_pelanggan di Order Tables

```sql
-- Tambah kolom id_pelanggan di tb_order_ck
ALTER TABLE tb_order_ck 
ADD COLUMN id_pelanggan INT(11) NULL AFTER id_order_ck,
ADD INDEX idx_pelanggan (id_pelanggan);

-- Tambah kolom id_pelanggan di tb_order_dc
ALTER TABLE tb_order_dc 
ADD COLUMN id_pelanggan INT(11) NULL AFTER id_order_dc,
ADD INDEX idx_pelanggan (id_pelanggan);

-- Tambah kolom id_pelanggan di tb_order_cs
ALTER TABLE tb_order_cs 
ADD COLUMN id_pelanggan INT(11) NULL AFTER id_order_cs,
ADD INDEX idx_pelanggan (id_pelanggan);
```

#### Step 3: Tambah Foreign Key Constraints

```sql
-- Foreign key untuk tb_order_ck
ALTER TABLE tb_order_ck
ADD CONSTRAINT fk_order_ck_pelanggan 
FOREIGN KEY (id_pelanggan) 
REFERENCES pelanggan(id_pelanggan)
ON DELETE SET NULL
ON UPDATE CASCADE;

-- Foreign key untuk tb_order_dc
ALTER TABLE tb_order_dc
ADD CONSTRAINT fk_order_dc_pelanggan 
FOREIGN KEY (id_pelanggan) 
REFERENCES pelanggan(id_pelanggan)
ON DELETE SET NULL
ON UPDATE CASCADE;

-- Foreign key untuk tb_order_cs
ALTER TABLE tb_order_cs
ADD CONSTRAINT fk_order_cs_pelanggan 
FOREIGN KEY (id_pelanggan) 
REFERENCES pelanggan(id_pelanggan)
ON DELETE SET NULL
ON UPDATE CASCADE;
```

#### Step 4: Update PHP Code untuk Gunakan id_pelanggan

```php
// Update fungsi order_ck() di _functions.php
function order_ck($order_ck){
    global $koneksi;

    $id_pelanggan = isset($_SESSION['id_pelanggan']) ? (int)$_SESSION['id_pelanggan'] : NULL;
    $nama_pel = htmlspecialchars($order_ck['nama_pel_ck']);
    $no_telp = htmlspecialchars($order_ck['no_telp_ck']);
    // ... rest of code
    
    $insert_ck = "INSERT INTO tb_order_ck VALUES( 
        '', ?, '$orderNum','$nama_pel','$no_telp','$alamat',
        '$jns_pkt','$wkt_kerja_ck','$berat_qty','$tarif_perkilo',
        '$tgl_masuk','$tgl_keluar','$total_bayar',
        '$ket','Pending','$metode' )";
    
    // Use prepared statement with id_pelanggan
}
```

### Checklist Foreign Keys

- [ ] Backup database
- [ ] Tambah kolom id_pelanggan di tb_order_ck
- [ ] Tambah kolom id_pelanggan di tb_order_dc
- [ ] Tambah kolom id_pelanggan di tb_order_cs
- [ ] Tambah foreign key constraints
- [ ] Update PHP code untuk simpan id_pelanggan
- [ ] Test create order masih berfungsi
- [ ] Test delete pelanggan (should set NULL)

**Estimasi:** 1 hari

---

## 2. ADD TIMESTAMPS

### Masalah Saat Ini
- Tidak ada created_at, updated_at
- Sulit tracking kapan data dibuat/diubah
- Tidak ada audit trail

### Solusi: Tambahkan Timestamps

#### Migration Script

```sql
-- Tambah timestamps ke tabel master
ALTER TABLE master
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Tambah timestamps ke tabel pelanggan
ALTER TABLE pelanggan
MODIFY COLUMN tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Tambah timestamps ke tabel tb_cuci_komplit
ALTER TABLE tb_cuci_komplit
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Tambah timestamps ke tabel tb_dry_clean
ALTER TABLE tb_dry_clean
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Tambah timestamps ke tabel tb_cuci_satuan
ALTER TABLE tb_cuci_satuan
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Tambah timestamps ke tabel tb_order_ck
ALTER TABLE tb_order_ck
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Tambah timestamps ke tabel tb_order_dc
ALTER TABLE tb_order_dc
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Tambah timestamps ke tabel tb_order_cs
ALTER TABLE tb_order_cs
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
```

### Checklist Timestamps

- [ ] Backup database
- [ ] Tambah timestamps ke semua tabel
- [ ] Test INSERT otomatis set created_at
- [ ] Test UPDATE otomatis update updated_at
- [ ] Update laporan untuk show timestamps

**Estimasi:** 2 jam

---

## 3. IMPLEMENT SOFT DELETE

### Masalah Saat Ini
- Delete data permanent
- Tidak bisa restore
- Tidak ada audit trail

### Solusi: Soft Delete

#### Migration Script

```sql
-- Tambah deleted_at ke tabel master
ALTER TABLE master
ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL;

-- Tambah deleted_at ke tabel pelanggan
ALTER TABLE pelanggan
ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL;

-- Tambah deleted_at ke tabel paket
ALTER TABLE tb_cuci_komplit
ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE tb_dry_clean
ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE tb_cuci_satuan
ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL;
```

#### Update PHP Functions

```php
// Update fungsi del_kary() di _functions.php
function del_kary($id_kary){
    $id_kary = (int)$id_kary;
    
    // Soft delete: set deleted_at instead of DELETE
    return execute_prepared(
        "UPDATE master SET deleted_at = NOW() WHERE id_user = ?",
        "i",
        [$id_kary]
    );
}

// Update fungsi query() untuk exclude soft deleted
function query($query){
    global $koneksi;
    
    // Auto add WHERE deleted_at IS NULL if not exists
    if (stripos($query, 'WHERE') === false && stripos($query, 'deleted_at') === false) {
        $query = str_replace('FROM master', 'FROM master WHERE deleted_at IS NULL', $query);
        $query = str_replace('FROM pelanggan', 'FROM pelanggan WHERE deleted_at IS NULL', $query);
    }
    
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Fungsi untuk restore soft deleted data
function restore_kary($id_kary){
    $id_kary = (int)$id_kary;
    return execute_prepared(
        "UPDATE master SET deleted_at = NULL WHERE id_user = ?",
        "i",
        [$id_kary]
    );
}
```

### Checklist Soft Delete

- [ ] Backup database
- [ ] Tambah kolom deleted_at
- [ ] Update fungsi delete jadi soft delete
- [ ] Update fungsi query untuk exclude deleted
- [ ] Buat fungsi restore
- [ ] Test delete tidak permanent
- [ ] Test query tidak tampilkan deleted data

**Estimasi:** 1 hari

---

## 4. REDUCE DATA REDUNDANCY

### Masalah Saat Ini
- Nama pelanggan di-copy ke setiap order
- Data paket di-copy ke order
- Jika pelanggan ganti nama, order lama tidak update

### Solusi: Gunakan Relasi

#### Current Structure (Redundant)
```
tb_order_ck:
- nama_pel_ck (redundant)
- no_telp_ck (redundant)
- alamat_ck (redundant)
- jenis_paket_ck (redundant)
```

#### Improved Structure
```
tb_order_ck:
- id_pelanggan (FK to pelanggan)
- id_paket_ck (FK to tb_cuci_komplit)
- snapshot_data (JSON for historical data)
```

#### Migration (Optional - Breaking Change)

**Note:** Ini breaking change, hanya lakukan jika siap refactor besar

```sql
-- Buat tabel baru dengan struktur lebih baik
CREATE TABLE tb_order_ck_new (
    id_order_ck INT(11) PRIMARY KEY AUTO_INCREMENT,
    or_ck_number VARCHAR(10) NOT NULL,
    id_pelanggan INT(11) NOT NULL,
    id_paket_ck INT(11) NOT NULL,
    berat_qty_ck INT(11) NOT NULL,
    tgl_masuk_ck DATE NOT NULL,
    tgl_keluar_ck DATE NOT NULL,
    tot_bayar DOUBLE NOT NULL,
    keterangan_ck TEXT,
    status VARCHAR(20) DEFAULT 'Pending',
    metode_pengambilan VARCHAR(20) DEFAULT 'Ambil di Tempat',
    snapshot_data JSON, -- Store historical data
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan),
    FOREIGN KEY (id_paket_ck) REFERENCES tb_cuci_komplit(id_ck)
);
```

**Rekomendasi:** Jangan lakukan ini sekarang, terlalu risky. Lakukan di versi 2.0

---

## 5. ADD INDEXES

### Masalah Saat Ini
- Query lambat untuk data besar
- Tidak ada index selain primary key

### Solusi: Tambahkan Indexes

```sql
-- Index untuk pencarian order by number
ALTER TABLE tb_order_ck ADD INDEX idx_order_number (or_ck_number);
ALTER TABLE tb_order_dc ADD INDEX idx_order_number (or_dc_number);
ALTER TABLE tb_order_cs ADD INDEX idx_order_number (or_cs_number);

-- Index untuk filter by status
ALTER TABLE tb_order_ck ADD INDEX idx_status (status);
ALTER TABLE tb_order_dc ADD INDEX idx_status (status);
ALTER TABLE tb_order_cs ADD INDEX idx_status (status);

-- Index untuk filter by date
ALTER TABLE tb_order_ck ADD INDEX idx_tgl_masuk (tgl_masuk_ck);
ALTER TABLE tb_order_dc ADD INDEX idx_tgl_masuk (tgl_masuk_dc);
ALTER TABLE tb_order_cs ADD INDEX idx_tgl_masuk (tgl_masuk_cs);

-- Index untuk pencarian pelanggan
ALTER TABLE pelanggan ADD INDEX idx_email (email);
ALTER TABLE pelanggan ADD INDEX idx_username (username);

-- Index untuk pencarian master
ALTER TABLE master ADD INDEX idx_username (username);
ALTER TABLE master ADD INDEX idx_email (email);
```

### Checklist Indexes

- [ ] Backup database
- [ ] Tambah index untuk order number
- [ ] Tambah index untuk status
- [ ] Tambah index untuk tanggal
- [ ] Tambah index untuk email/username
- [ ] Test query performance improvement

**Estimasi:** 1 jam

---

## 6. MIGRATION SCRIPT

### Complete Migration Script

Buat file: `database_migration_v2.sql`

```sql
-- ============================================
-- DATABASE MIGRATION V2
-- Rumah Laundry - Database Improvements
-- Date: 2026-05-23
-- ============================================

-- BACKUP REMINDER
-- mysqldump -u root laundry_app > backup_before_migration.sql

START TRANSACTION;

-- ============================================
-- 1. ADD FOREIGN KEYS
-- ============================================

-- Add id_pelanggan columns
ALTER TABLE tb_order_ck 
ADD COLUMN id_pelanggan INT(11) NULL AFTER id_order_ck;

ALTER TABLE tb_order_dc 
ADD COLUMN id_pelanggan INT(11) NULL AFTER id_order_dc;

ALTER TABLE tb_order_cs 
ADD COLUMN id_pelanggan INT(11) NULL AFTER id_order_cs;

-- Add foreign key constraints
ALTER TABLE tb_order_ck
ADD CONSTRAINT fk_order_ck_pelanggan 
FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan)
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE tb_order_dc
ADD CONSTRAINT fk_order_dc_pelanggan 
FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan)
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE tb_order_cs
ADD CONSTRAINT fk_order_cs_pelanggan 
FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan)
ON DELETE SET NULL ON UPDATE CASCADE;

-- ============================================
-- 2. ADD TIMESTAMPS
-- ============================================

-- Master table
ALTER TABLE master
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Pelanggan table
ALTER TABLE pelanggan
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Paket tables
ALTER TABLE tb_cuci_komplit
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

ALTER TABLE tb_dry_clean
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

ALTER TABLE tb_cuci_satuan
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Order tables
ALTER TABLE tb_order_ck
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

ALTER TABLE tb_order_dc
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

ALTER TABLE tb_order_cs
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- ============================================
-- 3. ADD SOFT DELETE
-- ============================================

ALTER TABLE master ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE pelanggan ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tb_cuci_komplit ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tb_dry_clean ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tb_cuci_satuan ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL;

-- ============================================
-- 4. ADD INDEXES
-- ============================================

-- Order number indexes
ALTER TABLE tb_order_ck ADD INDEX idx_order_number (or_ck_number);
ALTER TABLE tb_order_dc ADD INDEX idx_order_number (or_dc_number);
ALTER TABLE tb_order_cs ADD INDEX idx_order_number (or_cs_number);

-- Status indexes
ALTER TABLE tb_order_ck ADD INDEX idx_status (status);
ALTER TABLE tb_order_dc ADD INDEX idx_status (status);
ALTER TABLE tb_order_cs ADD INDEX idx_status (status);

-- Date indexes
ALTER TABLE tb_order_ck ADD INDEX idx_tgl_masuk (tgl_masuk_ck);
ALTER TABLE tb_order_dc ADD INDEX idx_tgl_masuk (tgl_masuk_dc);
ALTER TABLE tb_order_cs ADD INDEX idx_tgl_masuk (tgl_masuk_cs);

-- Pelanggan indexes
ALTER TABLE tb_order_ck ADD INDEX idx_pelanggan (id_pelanggan);
ALTER TABLE tb_order_dc ADD INDEX idx_pelanggan (id_pelanggan);
ALTER TABLE tb_order_cs ADD INDEX idx_pelanggan (id_pelanggan);

-- User indexes
ALTER TABLE pelanggan ADD INDEX idx_email (email);
ALTER TABLE pelanggan ADD INDEX idx_username (username);
ALTER TABLE master ADD INDEX idx_username (username);
ALTER TABLE master ADD INDEX idx_email (email);

COMMIT;

-- ============================================
-- MIGRATION COMPLETE
-- ============================================
```

### Cara Menjalankan Migration

```bash
# 1. Backup database
mysqldump -u root laundry_app > backup_before_migration.sql

# 2. Run migration
mysql -u root laundry_app < database_migration_v2.sql

# 3. Verify
mysql -u root laundry_app -e "SHOW TABLES; DESCRIBE tb_order_ck;"
```

---

## 📊 PROGRESS TRACKING

- [ ] Add Foreign Keys (1 hari)
- [ ] Add Timestamps (2 jam)
- [ ] Implement Soft Delete (1 hari)
- [ ] Add Indexes (1 jam)
- [ ] Create Migration Script (1 jam)
- [ ] Test Migration (2 jam)
- [ ] Update PHP Code (2 hari)

**Total Estimasi:** 5-7 hari

---

**Status:** 📝 Guide Ready  
**Next Step:** Backup database, then run migration
