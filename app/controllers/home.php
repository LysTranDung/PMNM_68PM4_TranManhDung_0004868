<?php
<<<<<<< HEAD
class auth {

    public $user = [
        "1" => "1",
        "user" => "654321"
    ];



public function login() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $username = $_POST["username"] ?? '';
        $password = $_POST["password"] ?? '';

        if (
            isset($this->user[$username]) &&
            $this->user[$username] === $password
        ) {
            // Đăng nhập thành công
            $_SESSION["username"] = $username;
            
            header("Location: /home/index");
            exit();
        } else {
            header("Location: /home/login");
            exit();
        }
    }
}
}
?>
=======
class home{
    public function index(){
        require_once "../app/views/home/index.php";
    }
    public function login(){
        require_once "../app/views/home/login.php";
    }
}
>>>>>>> f36696361597fc57af1d538b401e57fe9cb24167
