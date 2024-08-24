Kiểm soát quyền truy cập
Bạn có một đối tượng xử lý tệp tin quan trọng mà không có cơ chế kiểm soát
 quyền truy cập.


class FileManager {
    public function readFile($file) {
        return file_get_contents($file);
    }
}

$fileManager = new FileManager();
echo $fileManager->readFile("important.txt");
?>
Sử dụng Proxy

Bạn tạo một lớp proxy để kiểm tra quyền truy cập trước khi cho phép 
đọc tệp tin.

<?php
class FileManager
{
    public function readFile($file)
    {
        return file_get_contents($file);
    }
}

class FileManagerProxy
{
    private $fileManager;
    private $authorizedUsers;
    private $user;
    public function __construct($user)
    {
        $this->fileManager = new FileManager();
        $this->authorizedUsers = ["admin", "manager"];
        $this->user = $user;
    }

    public function readFile($file)
    {
        if (in_array($this->user, $this->authorizedUsers)) {
            return $this->fileManager->readFile($file);
        } else {
            return "Access Denied";
        }
    }
}

$fileManagerProxy = new FileManagerProxy("guest");
echo $fileManagerProxy->readFile("important.txt");
?>

//thấy protected proxy cũng bình thường. theo mình nghĩ bản chất của 
nhóm proxy pattern này là chỉ khởi tạo khi được gọi
giống như ở trên nó khởi tạo việc đọc file chứ nó có báo lỗi không có quyền liền đâu
khi nào đọc nó mới báo