<?php
require_once __DIR__ . '/../core/Controller.php';

class auth extends Controller
{
    public function login()
    {
        $authModel = $this->model('AuthModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($authModel->validate($username, $password)) {
                $_SESSION['username'] = $username;
                header('Location: index.php?url=sinhvien/index');
                exit();
            }

            $this->view('auth/login', [
                'error' => 'Sai tài khoản hoặc mật khẩu. Vui lòng thử lại.'
            ]);
            return;
        }

        $this->view('auth/login');
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header('Location: index.php?url=home/login');
        exit();
    }
}
