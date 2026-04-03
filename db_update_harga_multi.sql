-- ============================================
-- UPDATE DATABASE UNTUK HARGA MULTI-SATUAN
-- Jalankan di PHPMyAdmin atau terminal MySQL
-- ============================================

-- 1. Tambah kolom harga beli offline & online di tabel products
ALTER TABLE products
ADD COLUMN price_buy_offline DECIMAL(15,2) DEFAULT 0 AFTER price_sell,
ADD COLUMN price_buy_online DECIMAL(15,2) DEFAULT 0 AFTER price_buy_offline;

-- Update harga beli yang sudah ada ke price_buy_offline
UPDATE products SET price_buy_offline = price_buy WHERE price_buy > 0;

-- 2. Buat tabel harga jual per satuan
CREATE TABLE IF NOT EXISTS product_unit_prices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    unit_id INT NOT NULL,
    price_sell DECIMAL(15,2) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (unit_id) REFERENCES units(id) ON DELETE CASCADE,
    UNIQUE KEY unique_product_unit (product_id, unit_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Copy harga jual saat ini ke satuan dasar
INSERT INTO product_unit_prices (product_id, unit_id, price_sell)
SELECT p.id, p.base_unit_id, p.price_sell
FROM products p
WHERE p.price_sell > 0
ON DUPLICATE KEY UPDATE price_sell = VALUES(price_sell);

-- 4. Update konversi untuk set harga jual
-- Setiap konversi akan punya harga jual default
-- (dihitung dari harga jual satuan dasar × multiplier)

-- ============================================
-- SELESAI
-- ============================================

-- Untuk cek apakah berhasil:
SELECT * FROM product_unit_prices LIMIT 5;
SHOW COLUMNS FROM products;
