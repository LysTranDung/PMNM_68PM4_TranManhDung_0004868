<?php require_once __DIR__ . '/../partials/header.php'; ?>
<div class="card">
    <h2>Đăng nhập</h2>
    <?php if (!empty($error)): ?>
        <div class="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
    <form action="index.php?url=auth/login" method="POST">
        <div class="form-row">
            <div class="half">
                <label for="username">Email</label>
                <input type="text" id="username" name="username" placeholder="Email" required>
            </div>
            <div class="half">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
        </div>
        <div class="form-actions">
            <button class="button success" type="submit">Đăng nhập</button>
        </div>
    </form>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
