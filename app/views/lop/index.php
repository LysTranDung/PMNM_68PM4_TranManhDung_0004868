<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php require_once __DIR__ . '/../partials/navigation.php'; ?>
<div class="card">
    <h2>Quản lý lớp học</h2>
    <form method="GET" action="index.php" style="margin-bottom: 16px;">
        <input type="hidden" name="url" value="lop/index">
        <div class="form-row">
            <div class="half">
                <label for="search">Tìm kiếm lớp</label>
                <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search ?? '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Tên lớp hoặc khoa">
            </div>
            <div class="half">
                <label for="per_page">Số bản ghi mỗi trang</label>
                <select id="per_page" name="per_page">
                    <?php foreach ([5, 10, 20, 50] as $option): ?>
                        <option value="<?php echo $option; ?>" <?php echo ($perPage == $option) ? 'selected' : ''; ?>><?php echo $option; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-actions">
            <button class="button success" type="submit">Áp dụng</button>
            <a class="button secondary" href="index.php?url=lop/create">Thêm lớp mới</a>
        </div>
    </form>

    <p class="small-text">Hiển thị từ <?php echo $startRecord; ?> đến <?php echo $endRecord; ?> / <?php echo $totalCount; ?> bản ghi. Trang <?php echo $currentPage; ?> / <?php echo $totalPages; ?>.</p>

    <table>
        <tr>
            <th>#</th>
            <th>Tên lớp</th>
            <th>Khoa</th>
            <th>Sĩ số</th>
            <th>Thao tác</th>
        </tr>
        <?php if (!empty($lops)): ?>
            <?php foreach ($lops as $index => $lop): ?>
                <tr>
                    <td><?php echo htmlspecialchars($startRecord + $index, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($lop['tenlop'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($lop['khoa'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($lop['siso'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a class="button secondary" href="index.php?url=lop/edit/<?php echo $lop['id']; ?>">Sửa</a>
                        <a class="button danger" href="index.php?url=lop/delete/<?php echo $lop['id']; ?>" onclick="return confirm('Xác nhận xóa lớp học này?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Không có lớp học nào.</td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a class="<?php echo ($currentPage === $i) ? 'active' : ''; ?>" href="index.php?url=lop/index&search=<?php echo urlencode($search); ?>&per_page=<?php echo $perPage; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
