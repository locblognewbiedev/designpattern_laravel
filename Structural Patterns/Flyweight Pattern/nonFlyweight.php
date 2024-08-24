<?php
class Character
{
    private $char;
    private $font;
    private $size;
    private $color;

    public function __construct($char, $font, $size, $color)
    {
        $this->char = $char;
        $this->font = $font;
        $this->size = $size;
        $this->color = $color;
    }

    public function display()
    {
        echo "Character: {$this->char}, Font: {$this->font}, Size: {$this->size}, Color: {$this->color}\n";
    }
}

// Tạo nhiều đối tượng Character
$chars = [];
for ($i = 0; $i < 1000; $i++) {
    $chars[] = new Character('a', 'Arial', 12, 'black');
}

// Hiển thị các đối tượng Character
foreach ($chars as $char) {
    $char->display();
}
