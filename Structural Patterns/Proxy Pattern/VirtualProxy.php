Không sử dụng Proxy

Bạn có một đối tượng hình ảnh lớn, cần tải toàn bộ hình ảnh vào bộ nhớ
 mỗi khi đối tượng được khởi tạo.

class Image {
    private $filename;

    public function __construct($filename) {
        $this->filename = $filename;
        $this->load();
    }

    public function load() {
        echo "Loading image: " . $this->filename . "\n";
    }

    public function display() {
        echo "Displaying image: " . $this->filename . "\n";
    }
}

$image = new Image("large_image.jpg");
$image->display();
?>


<?php
class RealImage
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->load();
    }

    public function load()
    {
        echo "Loading image: " . $this->filename . "\n";
    }

    public function display()
    {
        echo "Displaying image: " . $this->filename . "\n";
    }
}

class ImageProxy
{
    private $realImage;
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function display()
    {
        if ($this->realImage === null) {
            $this->realImage = new RealImage($this->filename);
        }
        $this->realImage->display();
    }
}

$imageProxy = new ImageProxy("large_image.jpg");
$imageProxy->display(); // Image được tải và hiển thị khi cần thiết
?>

#Giải quyết: Proxy trì hoãn việc tải hình ảnh đến khi thực sự cần, 
tiết kiệm tài nguyên và thời gian.

