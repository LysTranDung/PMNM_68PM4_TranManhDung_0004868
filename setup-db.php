<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$config = require __DIR__ . '/app/core/config.php';

function createSqlServerDatabase($config) {
    $host = trim($config['host'] ?? 'localhost');
    $instance = trim($config['instance'] ?? '');
    $port = trim((string)($config['port'] ?? ''));

    if ($host === '') {
        $host = 'localhost';
    }

    if ($instance !== '') {
        $server = "{$host}\\{$instance}";
    } elseif ($port !== '') {
        $server = "{$host},{$port}";
    } else {
        $server = $host;
    }

    try {
        $conn = new PDO("sqlsrv:Server={$server};Database=master", $config['username'], $config['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Không thể kết nối SQL Server: ' . $e->getMessage());
    }

    $dbName = $config['dbname'];
    $exists = $conn->query("SELECT name FROM sys.databases WHERE name = '{$dbName}'")->fetch();
    if (!$exists) {
        $conn->exec("CREATE DATABASE [{$dbName}]");
        echo "✓ Tạo cơ sở dữ liệu {$dbName} thành công\n";
    }

    $conn = new PDO("sqlsrv:Server={$server};Database={$dbName}", $config['username'], $config['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->exec("IF OBJECT_ID('dbo.tbl_lops','U') IS NULL CREATE TABLE dbo.tbl_lops (
        id INT IDENTITY(1,1) PRIMARY KEY,
        tenlop NVARCHAR(255) NOT NULL,
        khoa NVARCHAR(255) NOT NULL,
        siso INT NOT NULL,
        created_at DATETIME2 DEFAULT GETDATE()
    )");

    $conn->exec("IF OBJECT_ID('dbo.tbl_sinhviens','U') IS NULL CREATE TABLE dbo.tbl_sinhviens (
        id INT IDENTITY(1,1) PRIMARY KEY,
        hoten NVARCHAR(255) NOT NULL,
        mssv NVARCHAR(50) NOT NULL,
        gioitinh NVARCHAR(20) NOT NULL,
        lop_id INT NULL,
        created_at DATETIME2 DEFAULT GETDATE(),
        CONSTRAINT FK_tbl_sinhviens_tbl_lops FOREIGN KEY (lop_id) REFERENCES dbo.tbl_lops(id)
    )");

    $conn->exec("IF NOT EXISTS (SELECT 1 FROM sys.columns WHERE object_id = OBJECT_ID('dbo.tbl_sinhviens') AND name = 'lop_id') ALTER TABLE dbo.tbl_sinhviens ADD lop_id INT NULL");
    $conn->exec("IF NOT EXISTS (SELECT 1 FROM sys.foreign_keys WHERE name = 'FK_tbl_sinhviens_tbl_lops') ALTER TABLE dbo.tbl_sinhviens ADD CONSTRAINT FK_tbl_sinhviens_tbl_lops FOREIGN KEY (lop_id) REFERENCES dbo.tbl_lops(id)");

    $conn->exec("IF NOT EXISTS (SELECT 1 FROM tbl_lops WHERE tenlop = N'Khoa CNTT' AND khoa = N'CNTT') INSERT INTO tbl_lops (tenlop, khoa, siso) VALUES (N'Khoa CNTT', N'CNTT', 40)");
    $conn->exec("IF NOT EXISTS (SELECT 1 FROM tbl_lops WHERE tenlop = N'Khoa Kinh tế' AND khoa = N'KT') INSERT INTO tbl_lops (tenlop, khoa, siso) VALUES (N'Khoa Kinh tế', N'KT', 35)");

    $conn->exec("IF NOT EXISTS (SELECT 1 FROM tbl_sinhviens WHERE mssv = 'SV001') INSERT INTO tbl_sinhviens (hoten, mssv, gioitinh, lop_id) VALUES (N'Nguyễn Văn A', 'SV001', N'Nam', 1)");
    $conn->exec("IF NOT EXISTS (SELECT 1 FROM tbl_sinhviens WHERE mssv = 'SV002') INSERT INTO tbl_sinhviens (hoten, mssv, gioitinh, lop_id) VALUES (N'Trần Thị B', 'SV002', N'Nữ', 2)");
    $conn->exec("IF NOT EXISTS (SELECT 1 FROM tbl_sinhviens WHERE mssv = 'SV003') INSERT INTO tbl_sinhviens (hoten, mssv, gioitinh, lop_id) VALUES (N'Lê Văn C', 'SV003', N'Nam', 1)");

    echo "✓ Bảng tbl_sinhviens và tbl_lops đã tạo hoặc đã tồn tại\n";
}

function createSqliteDatabase() {
    $dbPath = __DIR__ . '/data/pm4.db';
    $dataDir = dirname($dbPath);
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0755, true);
    }

    try {
        $conn = new PDO('sqlite:' . $dbPath);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conn->exec("PRAGMA foreign_keys = ON;");
        $conn->exec("CREATE TABLE IF NOT EXISTS tbl_lops (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            tenlop TEXT NOT NULL,
            khoa TEXT NOT NULL,
            siso INTEGER NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        $conn->exec("CREATE TABLE IF NOT EXISTS tbl_sinhviens (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            hoten TEXT NOT NULL,
            mssv TEXT NOT NULL,
            gioitinh TEXT NOT NULL,
            lop_id INTEGER NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (lop_id) REFERENCES tbl_lops(id)
        )");

        $columns = $conn->query("PRAGMA table_info(tbl_sinhviens)")->fetchAll(PDO::FETCH_ASSOC);
        $hasLopId = false;
        foreach ($columns as $column) {
            if (isset($column['name']) && $column['name'] === 'lop_id') {
                $hasLopId = true;
                break;
            }
        }
        if (!$hasLopId) {
            $conn->exec("ALTER TABLE tbl_sinhviens ADD COLUMN lop_id INTEGER NULL");
        }

        $conn->exec("INSERT OR IGNORE INTO tbl_sinhviens (hoten, mssv, gioitinh, lop_id) VALUES
            ('Nguyễn Văn A', 'SV001', 'Nam', 1),
            ('Trần Thị B', 'SV002', 'Nữ', 2),
            ('Lê Văn C', 'SV003', 'Nam', 1)");

        $conn->exec("INSERT OR IGNORE INTO tbl_lops (tenlop, khoa, siso) VALUES
            ('Khoa CNTT', 'CNTT', 40),
            ('Khoa Kinh tế', 'KT', 35)");

        echo "✓ Kết nối SQLite thành công\n";
        echo "✓ Bảng tbl_sinhviens và tbl_lops đã tạo hoặc đã tồn tại\n";
    } catch (PDOException $e) {
        die('Lỗi SQLite: ' . $e->getMessage());
    }
}

if ($config['driver'] === 'sqlsrv') {
    createSqlServerDatabase($config);
} else {
    createSqliteDatabase();
}
