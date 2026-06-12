<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navigation.php'; ?>
<div class="card">
    <h2>Trang chủ</h2>
    <p>Chào mừng <strong><?php echo htmlspecialchars($_SESSION['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?></strong> đã đăng nhập.</p>
    <p>Chọn chức năng để quản lý danh sách sinh viên và lớp học.</p>
    <div class="form-actions">
        <a class="button" href="index.php?url=sinhvien/index">Quản lý sinh viên</a>
        <a class="button" href="index.php?url=lop/index">Quản lý lớp học</a>
    </div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
