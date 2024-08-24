<?php

interface LoggerInterface
{
    public function log($message);
}

class FileLogger implements LoggerInterface
{
    public function log($message)
    {
        echo "Logging message to a file: $message\n";
    }
}

class FileLogger2 implements LoggerInterface
{
    public function log($message)
    {
        echo "Logging2 message to a file: $message\n";
    }
}

class UserService
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function createUser($name)
    {
        $this->logger->log("User $name has been created.");
    }
}
class Container
{
    private $bindings = [];

    public function bind($abstract, $concrete)
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function make($abstract)
    {
        if (!isset($this->bindings[$abstract])) {
            throw new Exception("No binding found for $abstract");
        }

        return $this->resolve($this->bindings[$abstract]);
    }

    private function resolve($concrete)
    {
        $reflectionClass = new ReflectionClass($concrete);

        if (!$reflectionClass->isInstantiable()) {
            /**
             * lớp trừu tượng
             * interface
             * trait
             * thì báo lỗi
             */
            throw new Exception("Class $concrete is not instantiable.");
        }

        $constructor = $reflectionClass->getConstructor();
        /**
         * lấy constructor có dạng như sau
          Method [ <> public method __construct ] {
            - Parameters [1 (số tham số)] {
                Parameter #0 [ <required> LoggerInterface $logger ]
            }
            }
         */

        if (is_null($constructor)) {
            return new $concrete;
        }
        /**
         * nếu không có constructor thì tạo đối tượng không
         * cần constructor
         */
        $parameters = $constructor->getParameters();
        /**
         * lấy danh sách các tham số
         * array(1) {
                [0]=>
                object(ReflectionParameter)#4 (1) {
                    ["name"]=>
                    string(6) "logger"(tên biến là $logger)
                }
                }
         */
        $dependencies = [];
        /**
         * tạo mảng các phụ thuộc
         */
        foreach ($parameters as $parameter) {
            $dependency = $parameter->getType() && !$parameter->getType()->isBuiltin()
                /**
                 * nếu parameter có type(khác null) và không phải kiểu xây dựng sẵn
                 * thì lấy type đó 
                 */
                ? $parameter->getType()->getName()
                : null;

            if ($dependency) {
                $dependencies[] = $this->make($dependency);
                /**
                 * nếu type có tồn tại thì tạo dependency và thêm vào mảng $dependencies[]
                 */
            } else {
                $dependencies[] = $parameter->isDefaultValueAvailable()
                    /**
                     * kiểm tra xem nó có giá trị mặc định không nếu có thì thêm vào phụ thuộc
                     */
                    ? $parameter->getDefaultValue()
                    : null;
            }
        }

        return $reflectionClass->newInstanceArgs($dependencies);
        /**
         *tạo đối tượng từ danh sách các mảng
         */
    }
}

$container = new Container();

// Đăng ký các triển khai
$container->bind(LoggerInterface::class, FileLogger2::class);
$container->bind(UserService::class, UserService::class);

// Tạo UserService với FileLogger được tiêm tự động
$userService = $container->make(UserService::class);
/**
 * nếu được đk rồi thì tạo đối tượng đã được tim các phụ thuộc
 */
$userService->createUser('John Doe');

