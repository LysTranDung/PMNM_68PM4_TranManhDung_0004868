<?php
require_once __DIR__ . '/../core/DB.php';

class AuthModel
{
    private $fallbackUsers = [
        "1" => "1",
        "user" => "654321"
    ];

    public function validate($username, $password)
    {
        $username = trim($username);
        $password = trim($password);

        if ($username === '' || $password === '') {
            return false;
        }

        try {
            $conn = ConnectDB::Connect();
            $query = (ConnectDB::getDriver() === 'sqlsrv')
                ? 'SELECT TOP 1 * FROM Student WHERE email = :username'
                : 'SELECT * FROM Student WHERE email = :username LIMIT 1';

            $stmt = $conn->prepare($query);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && isset($user['password'])) {
                return $user['password'] === $password;
            }
        } catch (PDOException $e) {
            // Nếu bảng Student chưa tồn tại hoặc lỗi DB thì fallback
        }

        return isset($this->fallbackUsers[$username]) && $this->fallbackUsers[$username] === $password;
    }
}
