-- SQL Server schema for student and class management
-- Change database name if needed before running.
USE [PM4];
GO

IF OBJECT_ID('dbo.tbl_lops', 'U') IS NULL
CREATE TABLE dbo.tbl_lops (
    id INT IDENTITY(1,1) PRIMARY KEY,
    tenlop NVARCHAR(255) NOT NULL,
    khoa NVARCHAR(255) NOT NULL,
    siso INT NOT NULL,
    created_at DATETIME2 DEFAULT GETDATE()
);
GO

IF OBJECT_ID('dbo.tbl_sinhviens', 'U') IS NULL
CREATE TABLE dbo.tbl_sinhviens (
    id INT IDENTITY(1,1) PRIMARY KEY,
    hoten NVARCHAR(255) NOT NULL,
    mssv NVARCHAR(50) NOT NULL,
    gioitinh NVARCHAR(20) NOT NULL,
    lop_id INT NULL,
    created_at DATETIME2 DEFAULT GETDATE(),
    CONSTRAINT FK_tbl_sinhviens_tbl_lops FOREIGN KEY (lop_id) REFERENCES dbo.tbl_lops(id)
);
GO

IF NOT EXISTS (SELECT 1 FROM dbo.tbl_lops WHERE tenlop = N'Khoa CNTT' AND khoa = N'CNTT')
INSERT INTO dbo.tbl_lops (tenlop, khoa, siso) VALUES (N'Khoa CNTT', N'CNTT', 40);
GO

IF NOT EXISTS (SELECT 1 FROM dbo.tbl_lops WHERE tenlop = N'Khoa Kinh tế' AND khoa = N'KT')
INSERT INTO dbo.tbl_lops (tenlop, khoa, siso) VALUES (N'Khoa Kinh tế', N'KT', 35);
GO

IF NOT EXISTS (SELECT 1 FROM dbo.tbl_sinhviens WHERE mssv = 'SV001')
INSERT INTO dbo.tbl_sinhviens (hoten, mssv, gioitinh, lop_id) VALUES (N'Nguyễn Văn A', 'SV001', N'Nam', 1);
GO

IF NOT EXISTS (SELECT 1 FROM dbo.tbl_sinhviens WHERE mssv = 'SV002')
INSERT INTO dbo.tbl_sinhviens (hoten, mssv, gioitinh, lop_id) VALUES (N'Trần Thị B', 'SV002', N'Nữ', 2);
GO

IF NOT EXISTS (SELECT 1 FROM dbo.tbl_sinhviens WHERE mssv = 'SV003')
INSERT INTO dbo.tbl_sinhviens (hoten, mssv, gioitinh, lop_id) VALUES (N'Lê Văn C', 'SV003', N'Nam', 1);
GO

-- SQLite schema for reference
-- PRAGMA foreign_keys = ON;
-- CREATE TABLE IF NOT EXISTS tbl_lops (
--     id INTEGER PRIMARY KEY AUTOINCREMENT,
--     tenlop TEXT NOT NULL,
--     khoa TEXT NOT NULL,
--     siso INTEGER NOT NULL,
--     created_at DATETIME DEFAULT CURRENT_TIMESTAMP
-- );
--
-- CREATE TABLE IF NOT EXISTS tbl_sinhviens (
--     id INTEGER PRIMARY KEY AUTOINCREMENT,
--     hoten TEXT NOT NULL,
--     mssv TEXT NOT NULL,
--     gioitinh TEXT NOT NULL,
--     lop_id INTEGER NULL,
--     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (lop_id) REFERENCES tbl_lops(id)
-- );
--
-- INSERT OR IGNORE INTO tbl_lops (tenlop, khoa, siso) VALUES
--     ('Khoa CNTT', 'CNTT', 40),
--     ('Khoa Kinh tế', 'KT', 35);
--
-- INSERT OR IGNORE INTO tbl_sinhviens (hoten, mssv, gioitinh, lop_id) VALUES
--     ('Nguyễn Văn A', 'SV001', 'Nam', 1),
--     ('Trần Thị B', 'SV002', 'Nữ', 2),
--     ('Lê Văn C', 'SV003', 'Nam', 1);
