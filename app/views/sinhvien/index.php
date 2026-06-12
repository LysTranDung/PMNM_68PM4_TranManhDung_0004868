<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navigation.php'; ?>
<div class="card">
    <h2>Danh sách sinh viên</h2>
    <form method="GET" action="index.php" style="margin-bottom: 18px;">
        <input type="hidden" name="url" value="sinhvien/index">
        <div class="form-row">
            <div class="half">
                <label for="search">Tìm kiếm</label>
                <input id="search" type="text" name="search" value="<?php echo htmlspecialchars($search ?? '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Tên hoặc MSSV">
            </div>
            <div class="half">
                <label for="gender">Giới tính</label>
                <select id="gender" name="gender">
                    <option value="">Tất cả</option>
                    <option value="Nam" <?php echo ($gender === 'Nam') ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo ($gender === 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                    <option value="Khác" <?php echo ($gender === 'Khác') ? 'selected' : ''; ?>>Khác</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="half">
                <label for="per_page">Số bản ghi trên trang</label>
                <select id="per_page" name="per_page">
                    <?php foreach ([5, 10, 20, 50] as $option): ?>
                        <option value="<?php echo $option; ?>" <?php echo ($perPage == $option) ? 'selected' : ''; ?>><?php echo $option; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-actions">
            <button class="button success" type="submit">Áp dụng</button>
            <a class="button secondary" href="index.php?url=sinhvien/create">Thêm sinh viên mới</a>
        </div>
    </form>

    <p class="small-text">Hiển thị <?php echo $startRecord; ?> đến <?php echo $endRecord; ?> / <?php echo $totalCount; ?> bản ghi. Trang <?php echo $currentPage; ?> / <?php echo $totalPages; ?>.</p>

    <table>
        <tr>
            <th>#</th>
            <th>Tên</th>
            <th>MSSV</th>
            <th>Giới tính</th>
            <th>Lớp</th>
            <th>Thao tác</th>
        </tr>
        <?php if (!empty($sinhviens)): ?>
            <?php foreach ($sinhviens as $index => $sinhvien): ?>
                <tr>
                    <td><?php echo htmlspecialchars($startRecord + $index, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($sinhvien['hoten'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($sinhvien['mssv'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($sinhvien['gioitinh'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($sinhvien['lop_ten'] ?? 'Chưa có lớp', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a class="button secondary" href="index.php?url=sinhvien/edit/<?php echo $sinhvien['id']; ?>">Sửa</a>
                        <a class="button danger" href="index.php?url=sinhvien/delete/<?php echo $sinhvien['id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa sinh viên này?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Không có dữ liệu sinh viên.</td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a class="<?php echo ($currentPage === $i) ? 'active' : ''; ?>" href="index.php?url=sinhvien/index&search=<?php echo urlencode($search); ?>&gender=<?php echo urlencode($gender); ?>&per_page=<?php echo $perPage; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
