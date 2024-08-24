Bối cảnh:
Bạn có một hệ thống quản lý hình ảnh và sử dụng một thư viện xử lý hình ảnh
 cũ (OldImageLibrary). Bạn muốn chuyển sang sử dụng một thư viện mới
  (NewImageLibrary).
<?php
class OldImageLibrary
{
    public function load($fileName)
    {
        echo "Loading image using Old Image Library: $fileName\n";
    }
    public function display()
    {
        echo "Displaying image using Old Image Library\n";
    }
}
class NewImageLibrary
{
    public function open($fileName)
    {
        echo "Opening image using New Image Library: $fileName\n";
    }
    public function render()
    {
        echo "Rendering image using New Image Library\n";
    }
}

interface ImageInterface
{
    public function load($fileName);
    public function display();
}

class OldImageLibraryAdapter implements ImageInterface
{
    private $oldImageLibrary;

    public function __construct(OldImageLibrary $oldImageLibrary)
    {
        $this->oldImageLibrary = $oldImageLibrary;
    }

    public function load($fileName)
    {
        $this->oldImageLibrary->load($fileName);
    }

    public function display()
    {
        $this->oldImageLibrary->display();
    }
}

class NewImageLibraryAdapter implements ImageInterface
{
    private $newImageLibrary;

    public function __construct(NewImageLibrary $newImageLibrary)
    {
        $this->newImageLibrary = $newImageLibrary;
    }

    public function load($fileName)
    {
        $this->newImageLibrary->open($fileName);
    }

    public function display()
    {
        $this->newImageLibrary->render();
    }
}
function processImage(ImageInterface $imageLibrary, $fileName)
{
    $imageLibrary->load($fileName);
    $imageLibrary->display();
}

$oldImageLibrary = new OldImageLibraryAdapter(new OldImageLibrary());
$newImageLibrary = new NewImageLibraryAdapter(new NewImageLibrary());

processImage($oldImageLibrary, "image1.png");
processImage($newImageLibrary, "image2.png");
