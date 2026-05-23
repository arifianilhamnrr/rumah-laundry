# 📱 Perbaikan CSS/JS di Mobile

## Masalah yang Diperbaiki

### 1. ✅ Meta Viewport
**Masalah:** Header tidak memiliki meta viewport, menyebabkan tampilan tidak responsive di mobile.

**Solusi:** Ditambahkan meta viewport di:
- `_header.php`
- `pelanggan/header_pelanggan.php`

```html
<meta name="viewport" content="width=device-width, initial-scale=1.0">
```

---

### 2. ✅ Fungsi URL Dinamis
**Masalah:** Fungsi `url()` hardcoded ke `http://localhost/rumah_laundry`, menyebabkan path salah di subfolder.

**Solusi:** Diubah menjadi dinamis dengan regex untuk mendeteksi folder root project.

**File:** `_functions.php` (baris 25-51)

**Cara Kerja:**
- Deteksi protokol (http/https)
- Deteksi host dari `$_SERVER['HTTP_HOST']`
- Cari folder root dengan regex `/rumah_laundry/`
- Generate URL: `http://localhost/rumah_laundry`

**Keuntungan:**
- Bekerja dari folder manapun (root, subfolder)
- Support https
- Support berbagai environment

---

### 3. ✅ Responsive CSS
**Masalah:** Hanya ada 1 media query, banyak elemen tidak responsive di mobile.

**Solusi:** Ditambahkan 208 baris responsive CSS di `_assets/css/style.css`

**Media Queries:**
- `@media (max-width: 1024px)` - Tablet & Mobile Landscape
- `@media (max-width: 768px)` - Mobile Portrait
- `@media (max-width: 480px)` - Small Mobile
- iOS Safari Fix - Prevent zoom saat focus input
- Landscape Orientation Fix

**Fitur Responsive:**
- Container full width di mobile
- Navigation vertical di mobile
- Card stack vertical
- Table horizontal scroll
- Button full width
- Font size 16px untuk input (prevent iOS zoom)

---

## Cara Testing

### Test 1: Dari Root
```
http://localhost/rumah_laundry/test_assets.php
```

### Test 2: Dari Subfolder Pelanggan
```
http://localhost/rumah_laundry/pelanggan/test_assets_pelanggan.php
```

### Test 3: Di Mobile Real
1. Cari IP komputer: `ipconfig` (Windows)
2. Buka di mobile: `http://[IP]/rumah_laundry/test_assets.php`
3. Contoh: `http://192.168.1.100/rumah_laundry/test_assets.php`

### Test 4: Browser Developer Tools
1. Tekan `F12`
2. Klik icon mobile (Toggle Device Toolbar)
3. Pilih device: iPhone, iPad, Android
4. Refresh halaman

---

## Checklist Verifikasi

- [ ] CSS terbaca (card memiliki styling)
- [ ] Logo/gambar muncul
- [ ] Navigation responsive (vertical di mobile)
- [ ] Card stack vertical di mobile
- [ ] Button full width di mobile
- [ ] Table bisa scroll horizontal
- [ ] Tidak ada zoom otomatis saat focus input (iOS)

---

## File yang Dimodifikasi

1. `_functions.php` - Fungsi url() dinamis
2. `_header.php` - Meta viewport
3. `pelanggan/header_pelanggan.php` - Meta viewport
4. `_assets/css/style.css` - Responsive CSS (+208 baris)

---

## Troubleshooting

### CSS tidak terbaca?
1. Cek console browser (F12) untuk error 404
2. Pastikan path benar: `http://localhost/rumah_laundry/_assets/css/style.css`
3. Buka file test: `test_assets.php`

### Gambar tidak muncul?
1. Cek folder `_assets/img/logo/` ada file `nav-logo.png`
2. Cek console browser untuk error
3. Pastikan path benar di fungsi `url()`

### Masih tidak responsive?
1. Clear cache browser (Ctrl+Shift+R)
2. Pastikan meta viewport ada di header
3. Cek media queries di `style.css` (baris 1141+)

---

**Tanggal Perbaikan:** 23 Mei 2026
**Status:** ✅ Selesai
