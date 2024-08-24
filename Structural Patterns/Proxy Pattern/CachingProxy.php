Bạn có một đối tượng truy cập cơ sở dữ liệu nặng nề và thực hiện các
 truy vấn trực tiếp mỗi lần cần dữ liệu.



class Database {
    public function getData($query) {
        // Giả lập việc lấy dữ liệu từ cơ sở dữ liệu
        sleep(2); // Giả lập độ trễ
        return "Data from DB for query: $query";
    }
}

$db = new Database();
echo $db->getData("SELECT * FROM users");
?>
Sử dụng Proxy

Bạn tạo một lớp proxy để lưu trữ kết quả của các truy vấn, tránh truy cập 
trực tiếp vào cơ sở dữ liệu mỗi lần.


<?php
class Database
{
    public function getData($query)
    {
        sleep(2); // Giả lập độ trễ
        return "Data from DB for query: $query";
    }
}

class DatabaseProxy
{
    private $database;
    private $cache = [];

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getData($query)
    {
        if (!isset($this->cache[$query])) {
            $this->cache[$query] = $this->database->getData($query);
        }
        return $this->cache[$query];
    }
}

$dbProxy = new DatabaseProxy();
echo $dbProxy->getData("SELECT * FROM users");
echo $dbProxy->getData("SELECT * FROM users"); // Lấy từ cache
?>

Các thư viện dùng để cache thường sử dụng các cơ chế khác nhau để tối ưu hóa việc lưu trữ và truy xuất dữ liệu. Một trong các cơ chế đó có thể là Cache Proxy, nhưng còn có nhiều cơ chế khác được sử dụng tùy thuộc vào mục đích và yêu cầu cụ thể của ứng dụng. Dưới đây là một số cơ chế phổ biến:

1. Cache Proxy
Cache Proxy là một loại proxy được sử dụng để lưu trữ dữ liệu tạm thời và phục vụ dữ liệu đó cho các yêu cầu tiếp theo mà không cần phải truy vấn nguồn dữ liệu gốc.

Ví dụ: Squid, Varnish là các proxy HTTP phổ biến được sử dụng để lưu trữ cache cho các tài nguyên web.

2. In-Memory Caching
In-Memory Caching lưu trữ dữ liệu trong bộ nhớ RAM, cho phép truy xuất dữ liệu rất nhanh. Các hệ thống như Memcached và Redis sử dụng kỹ thuật này.

Ví dụ: Memcached, Redis

php
Sao chép mã
// Sử dụng Redis cho caching
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->set("key", "value");
echo $redis->get("key"); // Output: value
3. Disk-Based Caching
Disk-Based Caching lưu trữ dữ liệu trên đĩa cứng, thường chậm hơn so với in-memory caching nhưng có dung lượng lưu trữ lớn hơn.

Ví dụ: APCu với PHP, sử dụng các file để lưu trữ dữ liệu cache.

4. Object Caching
Object Caching lưu trữ các đối tượng đã khởi tạo để tái sử dụng, giúp giảm thiểu việc khởi tạo lại các đối tượng tốn kém.

Ví dụ: Doctrine Cache, một phần của Doctrine ORM, sử dụng để cache các đối tượng entity trong các ứng dụng PHP.

5. HTTP Caching
HTTP Caching sử dụng các header HTTP như Cache-Control, ETag, và Last-Modified để kiểm soát việc lưu trữ và phục vụ các tài nguyên web.

Ví dụ: Sử dụng các header trong PHP

php
Sao chép mã
// Thiết lập cache control headers
header('Cache-Control: max-age=3600, must-revalidate');
header('ETag: "abc123"');
Các cơ chế khác:
File-Based Caching: Lưu trữ dữ liệu cache trong các file trên hệ thống tập tin.
Database Caching: Lưu trữ dữ liệu cache trong cơ sở dữ liệu để tận dụng các tính năng quản lý dữ liệu và backup của cơ sở dữ liệu.

=> quản lý dữ liệu lớn chả ai dùng cache proxy, ng ta dùng in In-Memory 
như redit => học cho biết