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

    <form action="index.php?url=lop/edit/<?php echo $lop['id']; ?>" method="POST">
        <div class="form-row">
            <div class="half">
                <label for="tenlop">Tên lớp</label>
                <input type="text" id="tenlop" name="tenlop" value="<?php echo htmlspecialchars($lop['tenlop'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="half">
                <label for="khoa">Khoa</label>
                <input type="text" id="khoa" name="khoa" value="<?php echo htmlspecialchars($lop['khoa'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="half">
                <label for="siso">Sĩ số</label>
                <input type="number" id="siso" name="siso" min="0" value="<?php echo htmlspecialchars($lop['siso'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
        </div>
        <div class="form-actions">
            <button class="button success" type="submit">Cập nhật</button>
            <a class="button secondary" href="index.php?url=lop/index">Hủy</a>
        </div>
    </form>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
