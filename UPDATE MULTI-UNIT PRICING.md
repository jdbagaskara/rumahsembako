# Update: Sistem Harga Multi-Satuan & Harga Beli Offline/Online

## Ringkasan

Sistem telah diperbarui untuk mendukung:
1. **Harga jual per satuan** - Setiap produk dapat memiliki harga jual berbeda untuk setiap satuan (pcs, pack, dus, dll)
2. **Harga beli ganda** - Setiap produk memiliki 2 harga beli: Offline dan Online

## File yang Diubah

### 1. Database Update
- **`db_update_harga_multi.sql`**
  - Menambahkan kolom `price_buy_offline` dan `price_buy_online` di tabel `products`
  - Membuat tabel baru `product_unit_prices` untuk menyimpan harga jual per satuan
  - Meng-copy harga jual existing ke satuan dasar

### 2. API Files
- **`api_get_product_prices.php`** - Mengambil harga jual per satuan untuk produk tertentu
- **`api_save_product_price.php`** - Menyimpan/mengupdate/menghapus harga jual per satuan
- **`api_get_units_no_price.php`** - Mengambil satuan yang belum memiliki harga jual
- **`api_get_units.php`** - **UPDATE** Sekarang mengembalikan `price_sell` untuk setiap satuan

### 3. Master Produk
- **`master_produk.php`** - **MAJOR UPDATE**
  - Form input sekarang memiliki 2 field harga beli: Offline & Online
  - Harga jual dihapus dari form utama (diatur per satuan)
  - Modal baru untuk mengatur harga jual per satuan
  - Tabel menampilkan badge jumlah satuan yang memiliki harga
  - Tombol "Atur" untuk mengelola harga jual per satuan

### 4. Point of Sale (POS)
- **`penjualan_pos.php`** - **UPDATE**
  - Sekarang menggunakan harga jual spesifik per satuan dari tabel `product_unit_prices`
  - Dropdown satuan menampilkan harga per satuan
  - Fallback ke perhitungan otomatis jika harga belum diatur
  - Query produk diupdate untuk mengambil harga satuan dasar

## Cara Penggunaan

### Langkah 1: Jalankan Database Update
```bash
# Buka PHPMyAdmin atau terminal MySQL
# Jalankan perintah dari file db_update_harga_multi.sql
```

### Langkah 2: Update Produk dengan Harga Baru
1. Buka **Master Data → Master Produk**
2. Edit produk yang ingin diupdate
3. Isi harga beli offline dan online
4. Klik tombol **"Atur"** di kolom Harga Jual
5. Di modal yang muncul:
   - Klik **"Tambah Harga Jual Baru"**
   - Pilih satuan dan masukkan harga jual
   - Klik tombol (+) untuk menyimpan
   - Edit atau hapus harga yang sudah ada

### Langkah 3: Transaksi Penjualan
1. Buka **Transaksi → Kasir/POS**
2. Pilih produk
3. Pilih satuan - harga otomatis mengikuti harga yang sudah diatur
4. Selesai!

## Struktur Database Baru

### Tabel `products` (update)
```sql
- price_buy_offline DECIMAL(15,2)  -- Harga beli offline
- price_buy_online DECIMAL(15,2)   -- Harga beli online
```

### Tabel `product_unit_prices` (baru)
```sql
- id INT AUTO_INCREMENT PRIMARY KEY
- product_id INT
- unit_id INT
- price_sell DECIMAL(15,2)
- created_at TIMESTAMP
- updated_at TIMESTAMP
- UNIQUE KEY (product_id, unit_id)
```

## Contoh Implementasi

### Produk: Indomie Goreng

**Harga Beli (di master_produk.php):**
- Offline: Rp 2.500
- Online: Rp 2.700

**Harga Jual per Satuan (di modal harga jual):**
- pcs: Rp 3.500
- pack (isi 5): Rp 17.500
- dus (isi 40): Rp 140.000

**Di POS:**
- User pilih "pack" → harga otomatis Rp 17.500
- User pilih "dus" → harga otomatis Rp 140.000
- User pilih "pcs" → harga otomatis Rp 3.500

## Catatan Penting

1. **Harga jual WAJIB diatur per satuan** - Tidak ada lagi perhitungan otomatis
2. **Harga beli offline/online hanya referensi** - Untuk input pembelian, harga tetap diinput manual per transaksi
3. **Jika harga jual satuan belum diatur** - Sistem akan fallback ke perhitungan otomatis (harga dasar / multiplier)
4. **Database migration** - Pastikan jalankan SQL update terlebih dahulu sebelum menggunakan sistem baru

## Troubleshooting

### Problem: Harga jual muncul 0 di POS
**Solusi:**
- Pastikan sudah menjalankan `db_update_harga_multi.sql`
- Cek harga jual per satuan sudah diatur di master produk
- Refresh halaman POS

### Problem: Modal harga jual tidak muncul
**Solusi:**
- Pastikan produk sudah disimpan terlebih dahulu
- Cek console browser untuk error JavaScript
- Pastikan API files ada dan tidak error

### Problem: Satuan tidak muncul di dropdown
**Solusi:**
- Pastikan konversi satuan sudah diatur di Master Konversi
- Cek apakah satuan sudah memiliki harga (untuk add new price)

## File Reference

Untuk detail implementasi, lihat file-file berikut:
- [master_produk.php](master_produk.php) - UI utama pengelolaan produk
- [penjualan_pos.php](penjualan_pos.php) - UI POS dengan harga multi-satuan
- [api_get_units.php](api_get_units.php) - API untuk mengambil satuan + harga
- [api_save_product_price.php](api_save_product_price.php) - API CRUD harga per satuan

---

**Update Date:** 2026-04-03
**Version:** 2.0 - Multi-Unit Pricing System
