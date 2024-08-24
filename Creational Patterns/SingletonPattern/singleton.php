<?php

class Singleton
{
    private static $instance = null;

    private function __construct()
    {
        // Constructor private để ngăn chặn khởi tạo đối tượng từ bên ngoài
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function doSomething()
    {
        echo "Singleton doing something!";
    }
}

// Sử dụng Singleton
$singleton1 = Singleton::getInstance();
$singleton2 = Singleton::getInstance();

// Kiểm tra xem cả hai đối tượng có phải là cùng một instance hay không
var_dump($singleton1 === $singleton2); // Output: bool(true)

$singleton1->doSomething(); // Output: Singleton doing something!
