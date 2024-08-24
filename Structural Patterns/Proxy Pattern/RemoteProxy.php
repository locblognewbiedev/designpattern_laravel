Không sử dụng Remote Proxy: Mã phải xử lý tất cả chi tiết giao tiếp mạng và lỗi.

class ApiClient {
    public function getData($endpoint) {
        $url = "https://api.example.com/" . $endpoint;
        $response = file_get_contents($url);
        return json_decode($response, true);
    }
}

$apiClient = new ApiClient();
$data = $apiClient->getData("data");
print_r($data);
?>
Sử dụng Remote Proxy: Mã trở nên đơn giản hơn, lỗi được xử lý tập trung.
<?php
class RealApiClient
{
    public function getData($endpoint)
    {
        $url = "https://api.example.com/" . $endpoint;
        $response = file_get_contents($url);
        return json_decode($response, true);
    }
}

class ApiClientProxy
{
    private $realApiClient;

    public function __construct()
    {
        $this->realApiClient = new RealApiClient();
    }

    public function getData($endpoint)
    {
        try {
            return $this->realApiClient->getData($endpoint);
        } catch (Exception $e) {
            return ["error" => "Unable to retrieve data"];
        }
    }
}

$apiClientProxy = new ApiClientProxy();
$data = $apiClientProxy->getData("data");
print_r($data);
?>
Bản chất thấy nó chỉ là chia các dịch vụ thành các class riêng để dễ quản lý lỗi
kiểu như bắt lỗi http ở 1 class riêng, bắt lỗi tải dữ liệu ở 1 class riêng

