
Virtual Proxy và Lazy Loading đều là các kỹ thuật dùng để trì hoãn việc khởi tạo đối tượng cho đến khi nó thực sự cần thiết. Dưới đây là sự khác nhau giữa hai kỹ thuật này cùng với hai ví dụ cụ thể bằng PHP để minh họa:

Virtual Proxy
Virtual Proxy là một đối tượng thay thế cho đối tượng thực sự mà nó đại diện. Khi một phương thức của đối tượng thật được gọi, proxy sẽ thực hiện kiểm tra và chỉ khởi tạo đối tượng thật nếu cần thiết.

Ví dụ 1: Tải dữ liệu người dùng từ cơ sở dữ liệu

Giả sử bạn có một lớp User tải dữ liệu người dùng từ cơ sở dữ liệu. Bạn có thể sử dụng một lớp UserProxy để đại diện cho người dùng:

php
Sao chép mã
interface User {
    public function getName();
}

class RealUser implements User {
    private $id;
    private $name;
    
    public function __construct($id) {
        $this->id = $id;
        $this->loadFromDatabase();
    }
    
    private function loadFromDatabase() {
        // Giả sử kết nối cơ sở dữ liệu và tải tên người dùng
        $this->name = "User" . $this->id;
        echo "Loading user from database\n";
    }
    
    public function getName() {
        return $this->name;
    }
}

class UserProxy implements User {
    private $realUser;
    private $id;
    
    public function __construct($id) {
        $this->id = $id;
    }
    
    public function getName() {
        if ($this->realUser === null) {
            $this->realUser = new RealUser($this->id);
        }
        return $this->realUser->getName();
    }
}

// Sử dụng
$userProxy = new UserProxy(1);
echo $userProxy->getName();
Lazy Loading
Lazy Loading là một kỹ thuật trì hoãn việc khởi tạo đối tượng hoặc tải dữ liệu cho đến khi nó thực sự cần thiết.

Ví dụ 2: Tải danh sách sản phẩm trong một giỏ hàng

Giả sử bạn có một lớp Cart có thể chứa nhiều sản phẩm, và bạn chỉ muốn tải danh sách sản phẩm khi thực sự cần thiết:

php
Sao chép mã
class Product {
    private $id;
    private $name;
    
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }
}

class Cart {
    private $products = null;
    
    public function getProducts() {
        if ($this->products === null) {
            $this->loadProducts();
        }
        return $this->products;
    }
    
    private function loadProducts() {
        // Giả sử tải sản phẩm từ cơ sở dữ liệu
        $this->products = [
            new Product(1, "Product 1"),
            new Product(2, "Product 2"),
        ];
        echo "Loading products from database\n";
    }
}

// Sử dụng
$cart = new Cart();
foreach ($cart->getProducts() as $product) {
    echo $product->getName() . "\n";
}
So sánh
Virtual Proxy:

Thay thế đối tượng thật và kiểm soát việc khởi tạo nó.
Thường sử dụng khi việc khởi tạo đối tượng thật tốn kém và không cần thiết ngay lập tức.
Ví dụ: UserProxy chỉ khởi tạo RealUser khi cần lấy tên người dùng.
Lazy Loading:

Trì hoãn việc tải dữ liệu hoặc khởi tạo đối tượng cho đến khi cần.
Thường sử dụng khi việc tải dữ liệu hoặc khởi tạo đối tượng tốn kém và không cần thiết ngay lập tức.
Ví dụ: Cart chỉ tải danh sách sản phẩm khi cần truy cập.
Cả hai kỹ thuật này giúp cải thiện hiệu suất ứng dụng bằng cách tránh khởi tạo không cần thiết.


=> kết luận 2 cái chả khác mẹ gì nhau. constructor nắm id,name khi cần lấy
getProducts thì tạo đối tượng trong hàm này dự trên id,name
