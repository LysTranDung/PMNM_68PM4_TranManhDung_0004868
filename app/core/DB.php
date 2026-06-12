<?php
class ConnectDB {
    public static $dbDriver = 'sqlite';
    private static $conn;

    public static function Connect() {
        $config = require __DIR__ . '/config.php';
        self::$dbDriver = strtolower($config['driver'] ?? 'sqlite');
        self::$conn = null;

        try {
            if (self::$dbDriver === 'sqlsrv') {
                $host = trim($config['host'] ?? 'localhost');
                $instance = trim($config['instance'] ?? '');
                $port = trim((string)($config['port'] ?? ''));
                $dbname = $config['dbname'] ?? '';
                $username = $config['username'] ?? '';
                $password = $config['password'] ?? '';
                $charset = trim($config['charset'] ?? 'UTF-8');

                if ($host === '') {
                    $host = 'localhost';
                }

                if ($instance !== '') {
                    $server = "{$host}\\{$instance}";
                } elseif ($port !== '') {
                    $server = "{$host},{$port}";
                } else {
                    $server = $host;
                }

                $dsn = "sqlsrv:Server={$server};Database={$dbname}";
                self::$conn = new PDO($dsn, $username, $password);
            } else {
                $db_path = __DIR__ . '/../../data/pm4.db';
                $dataDir = dirname($db_path);
                if (!is_dir($dataDir)) {
                    mkdir($dataDir, 0755, true);
                }
                $dsn = "sqlite:" . $db_path;
                self::$conn = new PDO($dsn);
            }

            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
            exit;
        }

        return self::$conn;
    }

    public static function getDriver() {
        return self::$dbDriver;
    }
}
?>