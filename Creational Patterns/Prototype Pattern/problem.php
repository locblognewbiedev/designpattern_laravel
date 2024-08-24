<?php

// Định nghĩa lớp đối tượng sản phẩm
class Product
{
    private $name;
    private $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    // Phương thức sao chép để tạo đối tượng mới
    public function clone()
    {
        return new Product($this->name, $this->price);
    }

    // Phương thức để hiển thị thông tin sản phẩm
    public function getInfo()
    {
        return "Product: {$this->name}, Price: {$this->price}";
    }
}

// Lớp quản lý sản phẩm
class ProductManager
{
    private $products = [];

    // Thêm sản phẩm vào quản lý
    public function addProduct($name, Product $product)
    {
        $this->products[$name] = $product;
    }

    // Lấy sản phẩm từ quản lý
    public function getProduct($name)
    {
        return $this->products[$name]->clone();
    }
}

// Sử dụng Prototype Pattern để quản lý các đối tượng sản phẩm
$productManager = new ProductManager();

// Thêm sản phẩm vào quản lý
$productManager->addProduct("smartphone", new Product("Smartphone", 500));
$productManager->addProduct("laptop", new Product("Laptop", 1000));
$productManager->addProduct("tablet", new Product("Tablet", 300));

// Lấy và hiển thị thông tin các sản phẩm
$product1 = $productManager->getProduct("smartphone");
$product2 = $productManager->getProduct("laptop");
$product3 = $productManager->getProduct("tablet");

echo $product1->getInfo() . "<br>";
echo $product2->getInfo() . "<br>";
echo $product3->getInfo() . "<br>";

/**
 * 
 * tại sao phải clone thay vì dùng constructor rỗng để khởi tạo đối tượng?
 * Trong các ngôn ngữ lập trình nhất định, như PHP, JavaScript, và nhiều 
 * ngôn ngữ khác, không cho phép overload constructor trực tiếp như các
 *  ngôn ngữ khác như Java hoặc C++. Điều này có nghĩa là bạn không thể
 *  có nhiều hơn một constructor trong cùng một lớp với cùng số lượng 
 * tham số và tên constructor khác nhau.
 *Khi sử dụng Prototype Pattern trong những ngôn ngữ như vậy, bạn có thể
 *giả lập việc "overload constructor" bằng cách sử dụng một phương pháp 
 *khởi tạo khác (ví dụ như một phương thức initialize() hoặc clone()
 *như trong ví dụ của chúng ta) để thiết lập các thuộc tính của đối tượng 
 *sau khi đã khởi tạo.
 */