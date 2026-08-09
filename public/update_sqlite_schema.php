<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

header('Content-Type: text/html; charset=utf-8');
echo "<h2>🚀 Updating SQLite Database Schema on Live Production Server...</h2>";

try {
    $dbPath = database_path('database.sqlite');
    echo "SQLite DB Path: " . $dbPath . "<br>";

    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get current columns of products table
    $stmt = $pdo->query("PRAGMA table_info(products)");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN, 1);

    echo "Current products columns: " . implode(', ', $columns) . "<br>";

    if (!in_array('barcode', $columns)) {
        $pdo->exec("ALTER TABLE products ADD COLUMN barcode VARCHAR(100) NULL");
        echo "✅ SQLite: Column 'barcode' added.<br>";
    }
    if (!in_array('cost_price', $columns)) {
        $pdo->exec("ALTER TABLE products ADD COLUMN cost_price NUMERIC DEFAULT 0");
        echo "✅ SQLite: Column 'cost_price' added.<br>";
    }
    if (!in_array('unit', $columns)) {
        $pdo->exec("ALTER TABLE products ADD COLUMN unit VARCHAR(50) DEFAULT 'Pcs'");
        echo "✅ SQLite: Column 'unit' added.<br>";
    }
    if (!in_array('description', $columns)) {
        $pdo->exec("ALTER TABLE products ADD COLUMN description TEXT NULL");
        echo "✅ SQLite: Column 'description' added.<br>";
    }
    if (!in_array('is_track_stock', $columns)) {
        $pdo->exec("ALTER TABLE products ADD COLUMN is_track_stock TINYINT DEFAULT 1");
        echo "✅ SQLite: Column 'is_track_stock' added.<br>";
        $pdo->exec("UPDATE products SET is_track_stock = 0 WHERE category = 'Tiket Harian'");
    }

    // Check pos_transactions table columns
    $posTableCheck = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='pos_transactions'");
    if ($posTableCheck && $posTableCheck->fetch()) {
        $posStmt = $pdo->query("PRAGMA table_info(pos_transactions)");
        $posColumns = $posStmt->fetchAll(PDO::FETCH_COLUMN, 1);
        if (!in_array('payment_status', $posColumns)) {
            $pdo->exec("ALTER TABLE pos_transactions ADD COLUMN payment_status VARCHAR(50) DEFAULT 'paid'");
            echo "✅ SQLite: Column 'payment_status' added to pos_transactions.<br>";
        }
    }

    // Check users table columns for pos_pin
    $userStmt = $pdo->query("PRAGMA table_info(users)");
    $userColumns = $userStmt->fetchAll(PDO::FETCH_COLUMN, 1);
    if (!in_array('pos_pin', $userColumns)) {
        $pdo->exec("ALTER TABLE users ADD COLUMN pos_pin VARCHAR(10) DEFAULT '1234'");
        echo "✅ SQLite: Column 'pos_pin' added to users table.<br>";
    }

    // Check inventory_logs table
    $logsStmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='inventory_logs'");
    if (!$logsStmt->fetch()) {
        $pdo->exec("CREATE TABLE inventory_logs (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            product_id INTEGER NOT NULL,
            product_name VARCHAR(255) NOT NULL,
            type VARCHAR(50) NOT NULL,
            qty INTEGER NOT NULL,
            previous_stock INTEGER NOT NULL,
            current_stock INTEGER NOT NULL,
            notes TEXT NULL,
            created_by VARCHAR(255) NULL,
            created_at DATETIME NULL,
            updated_at DATETIME NULL
        )");
        echo "✅ SQLite: Table 'inventory_logs' CREATED.<br>";
    }

    // Check purchase_orders table
    $tablesStmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='purchase_orders'");
    if (!$tablesStmt->fetch()) {
        $pdo->exec("CREATE TABLE purchase_orders (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            po_number VARCHAR(255) UNIQUE NOT NULL,
            supplier_name VARCHAR(255) NOT NULL,
            supplier_phone VARCHAR(255) NULL,
            order_date DATE NOT NULL,
            expected_delivery_date DATE NULL,
            status VARCHAR(50) DEFAULT 'draft',
            payment_status VARCHAR(50) DEFAULT 'unpaid',
            total_amount NUMERIC DEFAULT 0,
            notes TEXT NULL,
            created_by VARCHAR(255) NULL,
            received_at DATETIME NULL,
            created_at DATETIME NULL,
            updated_at DATETIME NULL
        )");
        echo "✅ SQLite: Table 'purchase_orders' CREATED.<br>";
    }

    // Check purchase_order_items table
    $tablesItemStmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='purchase_order_items'");
    if (!$tablesItemStmt->fetch()) {
        $pdo->exec("CREATE TABLE purchase_order_items (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            purchase_order_id INTEGER NOT NULL,
            product_id INTEGER NULL,
            product_name VARCHAR(255) NOT NULL,
            qty_ordered INTEGER DEFAULT 1,
            qty_received INTEGER DEFAULT 0,
            cost_price NUMERIC DEFAULT 0,
            subtotal NUMERIC DEFAULT 0,
            created_at DATETIME NULL,
            updated_at DATETIME NULL
        )");
        echo "✅ SQLite: Table 'purchase_order_items' CREATED.<br>";
    }

    // Comprehensive High-Performance Database Indexing
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_products_active_cat_name ON products(is_active, category, name)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_products_code ON products(code)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_products_barcode ON products(barcode)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_products_track_stock ON products(is_track_stock, stock)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_po_status ON purchase_orders(status)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_users_role ON users(role)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_users_phone ON users(phone)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_users_member_card ON users(member_card_id)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_registrations_created ON registrations(created_at)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_trial_bookings_created ON trial_bookings(created_at)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_pos_tx_inv ON pos_transactions(invoice_number)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_pos_tx_created ON pos_transactions(transacted_at)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_inv_log_prod ON inventory_logs(product_id)");
    echo "✅ SQLite: Full-system High-Performance Indexes created for Users, Products, POs, Registrations, POS & Inventory Logs.<br>";

    // Check pos_shifts table
    $posShiftsCheck = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='pos_shifts'");
    if (!$posShiftsCheck->fetch()) {
        $pdo->exec("CREATE TABLE pos_shifts (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            cashier_name VARCHAR(255) NOT NULL,
            opened_at DATETIME NOT NULL,
            closed_at DATETIME NULL,
            initial_cash NUMERIC DEFAULT 0,
            expected_cash NUMERIC DEFAULT 0,
            actual_cash NUMERIC DEFAULT 0,
            difference NUMERIC DEFAULT 0,
            total_cash_sales NUMERIC DEFAULT 0,
            total_non_cash_sales NUMERIC DEFAULT 0,
            total_cash_in NUMERIC DEFAULT 0,
            total_cash_out NUMERIC DEFAULT 0,
            status VARCHAR(50) DEFAULT 'open',
            notes TEXT NULL,
            created_at DATETIME NULL,
            updated_at DATETIME NULL
        )");
        echo "✅ SQLite: Table 'pos_shifts' CREATED.<br>";
    }

    // Check pos_cash_movements table
    $posMoveCheck = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='pos_cash_movements'");
    if (!$posMoveCheck->fetch()) {
        $pdo->exec("CREATE TABLE pos_cash_movements (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            pos_shift_id INTEGER NOT NULL,
            user_id INTEGER NOT NULL,
            type VARCHAR(50) NOT NULL,
            amount NUMERIC DEFAULT 0,
            notes TEXT NULL,
            created_at DATETIME NULL,
            updated_at DATETIME NULL
        )");
        echo "✅ SQLite: Table 'pos_cash_movements' CREATED.<br>";
    }

    echo "<h3>🎉 SQLite Schema Sync Completed Cleanly!</h3>";
} catch (\Throwable $e) {
    echo "<h3 style='color: red;'>❌ SQLite Error: " . $e->getMessage() . "</h3>";
}
