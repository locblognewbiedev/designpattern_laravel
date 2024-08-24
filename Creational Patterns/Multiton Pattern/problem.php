<?php

class DatabaseConnection
{
    private static $instances = [];

    private $dbHost;
    private $dbUser;
    private $dbPassword;
    private $dbName;

    private function __construct($host, $user, $password, $name)
    {
        $this->dbHost = $host;
        $this->dbUser = $user;
        $this->dbPassword = $password;
        $this->dbName = $name;
    }

    public static function getInstance($key)
    {
        if (!isset(self::$instances[$key])) {
            // Tạo mới một thể hiện nếu chưa tồn tại
            self::$instances[$key] = new self('localhost', 'username', 'password', $key);
        }
        return self::$instances[$key];
    }

    public function connect()
    {
        // Kết nối đến cơ sở dữ liệu với các thông số đã cấu hình
        echo "Connecting to database {$this->dbName} on {$this->dbHost}...\n";
        // Code kết nối
    }
}

// Sử dụng Multiton để lấy các kết nối đến các cơ sở dữ liệu khác nhau
$db1 = DatabaseConnection::getInstance('user1');
$db2 = DatabaseConnection::getInstance('user2');

// Kết nối đến cơ sở dữ liệu cho người dùng 1
$db1->connect();

// Kết nối đến cơ sở dữ liệu cho người dùng 2
$db2->connect();

