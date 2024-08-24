<?php
//triển khai giống laravel
interface LoggerInterface
{
    public function log($message);
}
interface BookRepositoryInterface
{
    public function findBook($title);
}
class InMemoryBookRepository implements BookRepositoryInterface
{
    private $books = [
        '1984' => 'George Orwell',
        'To Kill a Mockingbird' => 'Harper Lee'
    ];

    public function findBook($title)
    {
        return $this->books[$title] ?? null;
    }
}
class LibraryService
{
    private $bookRepository;
    private $logger;

    public function __construct(BookRepositoryInterface $bookRepository, LoggerInterface $logger)
    {
        $this->bookRepository = $bookRepository;
        $this->logger = $logger;
    }

    public function borrowBook($title)
    {
        $book = $this->bookRepository->findBook($title);
        if ($book) {
            $this->logger->log("Borrowed book: $title by $book.");
            return "Enjoy reading '$title' by $book!";
        } else {
            $this->logger->log("Book '$title' not found.");
            return "Sorry, '$title' is not available.";
        }
    }
}
class FileLogger implements LoggerInterface
{
    public function log($message)
    {
        echo "Logging message to a file: $message\n";
    }
}
class DatabaseLogger implements LoggerInterface
{
    public function log($message)
    {
        echo "Logging message to a database: $message\n";
    }
}
class Container
{
    private $bindings = [];
    private $instances = [];

    public function bind($abstract, $concrete)
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function singleton($abstract, $concrete)
    {
        $this->instances[$abstract] = $this->resolve($concrete);
    }

    public function make($abstract)
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        if (!isset($this->bindings[$abstract])) {
            return $this->resolve($abstract);
        }

        return $this->resolve($this->bindings[$abstract]);
    }

    private function resolve($concrete)
    {
        $reflectionClass = new ReflectionClass($concrete);

        if (!$reflectionClass->isInstantiable()) {
            throw new Exception("Class $concrete is not instantiable.");
        }

        $constructor = $reflectionClass->getConstructor();

        if (is_null($constructor)) {
            return new $concrete;
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getType() && !$parameter->getType()->isBuiltin()
                ? $parameter->getType()->getName()
                : null;

            if ($dependency) {
                $dependencies[] = $this->make($dependency);
            } else {
                $dependencies[] = $parameter->isDefaultValueAvailable()
                    ? $parameter->getDefaultValue()
                    : null;
            }
        }

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}
$container = new Container();

// Đăng ký các triển khai
$container->bind(LoggerInterface::class, FileLogger::class);
$container->bind(BookRepositoryInterface::class, InMemoryBookRepository::class);

// Tạo LibraryService với các phụ thuộc được tiêm tự động
$libraryService = $container->make(LibraryService::class);

echo $libraryService->borrowBook('1984') . "\n";
echo $libraryService->borrowBook('The Catcher in the Rye') . "\n";

// Đổi sang DatabaseLogger
$container->bind(LoggerInterface::class, DatabaseLogger::class);
$libraryService = $container->make(LibraryService::class);

echo $libraryService->borrowBook('1984') . "\n";
echo $libraryService->borrowBook('To Kill a Mockingbird') . "\n";