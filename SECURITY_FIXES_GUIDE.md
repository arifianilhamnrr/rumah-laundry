# 🔒 PANDUAN PERBAIKAN KEAMANAN - RUMAH LAUNDRY

**Tanggal:** 23 Mei 2026  
**Priority:** 🔴 CRITICAL  
**Estimasi Waktu:** 5-7 hari

---

## 📋 DAFTAR ISI

1. [SQL Injection Fixes](#1-sql-injection-fixes)
2. [XSS Protection](#2-xss-protection)
3. [CSRF Protection](#3-csrf-protection)
4. [Session Security](#4-session-security)
5. [Environment Configuration](#5-environment-configuration)
6. [Password Policy](#6-password-policy)

---

## 1. SQL INJECTION FIXES

### 🔴 CRITICAL - Priority #1

### Masalah
Semua query di `_functions.php` vulnerable terhadap SQL injection karena menggunakan string concatenation.

### Lokasi File yang Harus Diperbaiki
- `_functions.php` (hampir semua fungsi)
- `login.php` (line 429)
- `login_pelanggan.php`

### Contoh Vulnerable Code

#### ❌ BEFORE (Vulnerable)
```php
// _functions.php line 68-69
$master = mysqli_query($koneksi,"SELECT * FROM master 
    WHERE username='$username' OR email='$email'");

// login.php line 429
$data = mysqli_query($koneksi,"SELECT * FROM master 
    WHERE username = '$username'");

// _functions.php line 106
mysqli_query($koneksi,"DELETE FROM master WHERE id_user = '$id_kary'");
```

### ✅ AFTER (Secure)

#### Fungsi Helper untuk Prepared Statements
```php
// Tambahkan di awal _functions.php setelah koneksi database

/**
 * Execute prepared statement SELECT query
 * @param string $query SQL query with ? placeholders
 * @param string $types Parameter types (s=string, i=integer, d=double)
 * @param array $params Parameters array
 * @return array Result rows
 */
function query_prepared($query, $types = '', $params = []) {
    global $koneksi;
    
    if (empty($types) || empty($params)) {
        // No parameters, execute directly
        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    $stmt = mysqli_prepare($koneksi, $query);
    if (!$stmt) {
        error_log("Prepare failed: " . mysqli_error($koneksi));
        return [];
    }
    
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    
    mysqli_stmt_close($stmt);
    return $rows;
}

/**
 * Execute prepared statement INSERT/UPDATE/DELETE query
 * @param string $query SQL query with ? placeholders
 * @param string $types Parameter types
 * @param array $params Parameters array
 * @return int Affected rows
 */
function execute_prepared($query, $types = '', $params = []) {
    global $koneksi;
    
    $stmt = mysqli_prepare($koneksi, $query);
    if (!$stmt) {
        error_log("Prepare failed: " . mysqli_error($koneksi));
        return 0;
    }
    
    if (!empty($types) && !empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    return $affected;
}
```

#### Fix Fungsi add_kary()
```php
// _functions.php line 58-83
function add_kary($karyawan){
    global $koneksi;

    $nama = htmlspecialchars($karyawan['nama']);
    $username = htmlspecialchars($karyawan['username']);
    $email = htmlspecialchars($karyawan['email']);
    $password = stripcslashes(htmlspecialchars($karyawan['password']));
    $level = $karyawan['level'];

    // Cek apakah username dan email sudah tersedia - SECURE
    $check = query_prepared(
        "SELECT * FROM master WHERE username = ? OR email = ?",
        "ss",
        [$username, $email]
    );
    
    if (count($check) > 0) {
        echo "<script>alert('Username atau Email Sudah Terdaftar')</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert dengan prepared statement - SECURE
    return execute_prepared(
        "INSERT INTO master (nama, email, username, password, level) VALUES (?, ?, ?, ?, ?)",
        "sssss",
        [$nama, $email, $username, $password, $level]
    );
}
```

#### Fix Fungsi update_kary()
```php
function update_kary($up_kary){
    global $koneksi;

    $id_user = (int)$up_kary['id_user'];
    $nama = htmlspecialchars($up_kary['nama']);
    $username = htmlspecialchars($up_kary['username']);
    $email = htmlspecialchars($up_kary['email']);

    return execute_prepared(
        "UPDATE master SET nama = ?, username = ?, email = ? WHERE id_user = ?",
        "sssi",
        [$nama, $username, $email, $id_user]
    );
}
```

#### Fix Fungsi del_kary()
```php
function del_kary($id_kary){
    $id_kary = (int)$id_kary; // Cast to integer
    return execute_prepared(
        "DELETE FROM master WHERE id_user = ?",
        "i",
        [$id_kary]
    );
}
```

#### Fix Login (login.php)
```php
// login.php - Replace line 425-438
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SECURE: Use prepared statement
    $data = query_prepared(
        "SELECT * FROM master WHERE username = ?",
        "s",
        [$username]
    );

    if (count($data) > 0) {
        $hasil = $data[0];

        if (password_verify($password, $hasil['password'])) {
            $_SESSION['master'] = $username;
            $_SESSION['login'] = true;
            session_regenerate_id(true); // Security: Regenerate session ID
            ?>
            <script>window.location="<?=url()?>";</script>
        <?php 
        } else { ?>
            <div class="overlay">
                <div class="message-box">
                    <a href="<?=url('login.php');?>" class="close">&times;</a>
                    <div class="message-icon">❌</div>
                    <p>Password Salah!</p>
                </div>
            </div>
        <?php 
        }
    } else { ?>
        <div class="overlay">
            <div class="message-box">
                <a href="<?=url('login.php');?>" class="close">&times;</a>
                <div class="message-icon">⚠️</div>
                <p>Username tidak ditemukan!</p>
            </div>
        </div>
    <?php 
    }
}
```

### Checklist Perbaikan SQL Injection

- [ ] Tambahkan fungsi `query_prepared()` dan `execute_prepared()`
- [ ] Fix `add_kary()` - line 58-83
- [ ] Fix `update_kary()` - line 85-102
- [ ] Fix `del_kary()` - line 104-108
- [ ] Fix `add_ck()` - line 113-125
- [ ] Fix `edit_ck()` - line 127-144
- [ ] Fix `del_ck()` - line 146-150
- [ ] Fix `add_dc()` - line 152-165
- [ ] Fix `edit_dc()` - line 167-184
- [ ] Fix `del_dc()` - line 186-190
- [ ] Fix `add_cs()` - line 192-207
- [ ] Fix `edit_cs()` - line 209-228
- [ ] Fix `del_cs()` - line 230-234
- [ ] Fix `order_ck()` - line 236-282
- [ ] Fix `order_dc()` - line 292-334
- [ ] Fix `order_cs()` - line 344-385
- [ ] Fix `login.php` - line 425-461
- [ ] Fix `login_pelanggan.php`
- [ ] Fix `register_pelanggan()` - line 620-653
- [ ] Fix `login_pelanggan()` - line 656-670
- [ ] Fix `get_pelanggan()` - line 673-677
- [ ] Fix `update_pelanggan()` - line 680-698
- [ ] Fix `get_order_pelanggan()` - line 701-735

**Estimasi:** 2-3 hari

---

## 2. XSS PROTECTION

### 🔴 HIGH - Priority #2

### Masalah
Output tidak di-escape, memungkinkan JavaScript injection.

### Fungsi Helper untuk Output Escaping
```php
// Tambahkan di _functions.php

/**
 * Escape output untuk mencegah XSS
 * @param string $string String to escape
 * @return string Escaped string
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
```

### Contoh Perbaikan

#### ❌ BEFORE (Vulnerable)
```php
// index.php line 15
<p class="judul-sm">Selamat Datang <span><?= ucfirst($_SESSION['master']) ?></span></p>

// dashboard.php line 9
<h2>👋 Selamat Datang, <?= $nama_pelanggan ?>!</h2>
```

#### ✅ AFTER (Secure)
```php
// index.php line 15
<p class="judul-sm">Selamat Datang <span><?= e(ucfirst($_SESSION['master'])) ?></span></p>

// dashboard.php line 9
<h2>👋 Selamat Datang, <?= e($nama_pelanggan) ?>!</h2>
```

### Checklist Perbaikan XSS

- [ ] Tambahkan fungsi `e()` helper
- [ ] Fix semua output `$_SESSION['master']`
- [ ] Fix semua output `$nama_pelanggan`
- [ ] Fix semua output dari database
- [ ] Fix semua output di tabel
- [ ] Fix semua output di form value

**Estimasi:** 1 hari

---

## 3. CSRF PROTECTION

### 🔴 HIGH - Priority #3

### Implementasi CSRF Token

#### Step 1: Tambahkan Fungsi CSRF di _functions.php
```php
/**
 * Generate CSRF token
 * @return string CSRF token
 */
function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 * @param string $token Token to verify
 * @return bool True if valid
 */
function csrf_verify($token) {
    if (empty($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Generate CSRF input field
 * @return string HTML input field
 */
function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}
```

#### Step 2: Tambahkan di Semua Form
```php
// Contoh: order/order_ck.php
<form action="" method="post">
    <?= csrf_field() ?>
    <!-- form fields -->
</form>
```

#### Step 3: Verify di Setiap POST Handler
```php
// Contoh: order/order_ck.php
if (isset($_POST['order_ck'])) {
    // Verify CSRF token
    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        die('CSRF token validation failed');
    }
    
    // Process form
    if (order_ck($_POST) > 0) {
        // Success
    }
}
```

### Checklist CSRF Protection

- [ ] Tambahkan fungsi CSRF di `_functions.php`
- [ ] Tambahkan CSRF field di semua form order
- [ ] Tambahkan CSRF field di form login
- [ ] Tambahkan CSRF field di form register
- [ ] Tambahkan CSRF field di form edit karyawan
- [ ] Tambahkan CSRF field di form edit paket
- [ ] Verify CSRF di semua POST handler
- [ ] Test semua form masih berfungsi

**Estimasi:** 1 hari

---

## 4. SESSION SECURITY

### 🟡 MEDIUM - Priority #4

### Implementasi Session Security

```php
// Tambahkan di awal _functions.php setelah session_start()

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
ini_set('session.gc_maxlifetime', 3600); // 1 hour

// Session timeout (1 hour)
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

// Regenerate session ID every 30 minutes
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800) {
    session_regenerate_id(true);
    $_SESSION['CREATED'] = time();
}
```

### Checklist Session Security

- [ ] Tambahkan session configuration
- [ ] Implement session timeout
- [ ] Implement session regeneration
- [ ] Add `session_regenerate_id()` after login
- [ ] Test session timeout works
- [ ] Test auto-logout after 1 hour

**Estimasi:** 4 jam

---

## 5. ENVIRONMENT CONFIGURATION

### 🟡 MEDIUM - Priority #5

### Step 1: Install vlucas/phpdotenv (Optional)
```bash
composer require vlucas/phpdotenv
```

### Step 2: Buat File .env
```env
# .env (di root project)
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=laundry_app

APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost/rumah_laundry
```

### Step 3: Buat .env.example
```env
# .env.example
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=laundry_app

APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost/rumah_laundry
```

### Step 4: Update .gitignore
```
# .gitignore
.env
vendor/
```

### Step 5: Update _functions.php
```php
// _functions.php - Replace line 6-9

// Load environment variables
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($key, $value) = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

// Database configuration from environment
$host = $_ENV['DB_HOST'] ?? 'localhost';
$user = $_ENV['DB_USER'] ?? 'root';
$pass = $_ENV['DB_PASS'] ?? '';
$db = $_ENV['DB_NAME'] ?? 'laundry_app';
```

### Checklist Environment Config

- [ ] Buat file `.env`
- [ ] Buat file `.env.example`
- [ ] Update `.gitignore`
- [ ] Update `_functions.php`
- [ ] Test koneksi database masih work
- [ ] Pastikan `.env` tidak ter-commit ke git

**Estimasi:** 2 jam

---

## 6. PASSWORD POLICY

### 🟢 LOW - Priority #6

### Update Password Requirements

#### register_pelanggan.php
```php
// Update line 141
<input type="password" name="password" id="password" 
    placeholder="Password" required autocomplete="off" 
    minlength="8" 
    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
    title="Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka">
```

#### Validasi Server-Side
```php
// Tambahkan di fungsi register_pelanggan()
function validate_password($password) {
    if (strlen($password) < 8) {
        return "Password minimal 8 karakter";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        return "Password harus mengandung huruf besar";
    }
    if (!preg_match("/[a-z]/", $password)) {
        return "Password harus mengandung huruf kecil";
    }
    if (!preg_match("/[0-9]/", $password)) {
        return "Password harus mengandung angka";
    }
    return true;
}

// Di fungsi register_pelanggan(), sebelum hash password
$password_check = validate_password($password);
if ($password_check !== true) {
    echo "<script>alert('$password_check');</script>";
    return false;
}
```

### Checklist Password Policy

- [ ] Update HTML5 validation
- [ ] Tambahkan fungsi `validate_password()`
- [ ] Implement di `register_pelanggan()`
- [ ] Implement di `add_kary()`
- [ ] Test password validation works
- [ ] Update user documentation

**Estimasi:** 2 jam

---

## 📊 PROGRESS TRACKING

### Overall Progress: 0/6 Complete

- [ ] SQL Injection Fixes (2-3 hari)
- [ ] XSS Protection (1 hari)
- [ ] CSRF Protection (1 hari)
- [ ] Session Security (4 jam)
- [ ] Environment Config (2 jam)
- [ ] Password Policy (2 jam)

**Total Estimasi:** 5-7 hari kerja

---

## 🧪 TESTING CHECKLIST

Setelah semua perbaikan:

- [ ] Test login admin
- [ ] Test login pelanggan
- [ ] Test register pelanggan
- [ ] Test create order (3 jenis)
- [ ] Test edit karyawan
- [ ] Test edit paket
- [ ] Test delete functions
- [ ] Test session timeout
- [ ] Test CSRF protection
- [ ] Test SQL injection prevention
- [ ] Test XSS prevention

---

**Status:** 📝 Guide Ready  
**Next Step:** Mulai implementasi dari Priority #1
