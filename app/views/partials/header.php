<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f7f9fc; color: #333; }
        .container { max-width: 1160px; margin: 0 auto; padding: 20px; }
        header { background: #044e7c; padding: 12px 20px; color: white; }
        header h1 { margin: 0; font-size: 1.4rem; }
        nav { margin-top: 10px; }
        nav a { color: white; text-decoration: none; margin-right: 14px; font-weight: 600; }
        .card { background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { padding: 10px 12px; border: 1px solid #e1e5ea; }
        th { background: #0b6fa4; color: white; text-align: left; }
        tr:nth-child(even) { background: #f3f6fb; }
        .button { display: inline-block; padding: 8px 14px; border-radius: 6px; text-decoration: none; color: white; background: #0b6fa4; }
        .button.secondary { background: #6b7a8f; }
        .button.danger { background: #d64550; }
        .button.success { background: #2f8f4e; }
        .form-row { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 16px; }
        .form-row label { display: block; margin-bottom: 4px; font-weight: 600; }
        .form-row input, .form-row select { width: 100%; padding: 8px 10px; border: 1px solid #c8d0df; border-radius: 6px; }
        .form-row.half { flex: 1; min-width: 180px; }
        .form-actions { margin-top: 16px; }
        .alert { color: #b43333; margin-bottom: 16px; }
        .pagination { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 14px; }
        .pagination a { padding: 8px 12px; background: #e4edf7; color: #0b6fa4; border-radius: 6px; text-decoration: none; }
        .pagination a.active { background: #0b6fa4; color: white; }
        .small-text { font-size: 0.95rem; color: #575757; }
    </style>
</head>
<body>
<header>
    <div class="container">
        <h1>Quản lý sinh viên và lớp học</h1>
        <nav>
            <a href="index.php?url=home/index">Trang chủ</a>
            <a href="index.php?url=sinhvien/index">QL Sinh viên</a>
            <a href="index.php?url=lop/index">QL Lớp học</a>
            <a href="index.php?url=auth/logout">Đăng xuất</a>
        </nav>
    </div>
</header>
<div class="container">
