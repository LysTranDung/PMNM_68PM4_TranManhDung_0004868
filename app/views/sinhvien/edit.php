<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navigation.php'; ?>
<div class="card">
    <h2><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h2>

    <?php if (!empty($errors)): ?>
        <div class="alert">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="index.php?url=sinhvien/edit/<?php echo $sinhvien['id']; ?>" method="POST">
        <div class="form-row">
            <div class="half">
                <label for="hoten">Họ tên</label>
                <input type="text" id="hoten" name="hoten" value="<?php echo htmlspecialchars($sinhvien['hoten'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="half">
                <label for="mssv">MSSV</label>
                <input type="text" id="mssv" value="<?php echo htmlspecialchars($sinhvien['mssv'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="half">
                <label for="gioitinh">Giới tính</label>
                <select id="gioitinh" name="gioitinh" required>
                    <option value="">Chọn giới tính</option>
                    <option value="Nam" <?php echo ($sinhvien['gioitinh'] === 'Nam') ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo ($sinhvien['gioitinh'] === 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                    <option value="Khác" <?php echo ($sinhvien['gioitinh'] === 'Khác') ? 'selected' : ''; ?>>Khác</option>
                </select>
            </div>
            <div class="half">
                <label for="lop_id">Lớp</label>
                <select id="lop_id" name="lop_id" required>
                    <option value="">Chọn lớp</option>
                    <?php foreach ($lops as $lop): ?>
                        <option value="<?php echo $lop['id']; ?>" <?php echo ($sinhvien['lop_id'] == $lop['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($lop['tenlop'], ENT_QUOTES, 'UTF-8'); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-actions">
            <button class="button success" type="submit">Cập nhật</button>
            <a class="button secondary" href="index.php?url=sinhvien/index">Hủy</a>
        </div>
    </form>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
