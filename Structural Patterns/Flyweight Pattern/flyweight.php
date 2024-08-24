<?php
// Lớp Flyweight cho trạng thái nội tại
class CharacterFlyweight
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

    public function display($position)
    {
        echo "Character: {$this->char}, Position: {$position}, Font: {$this->font}, Size: {$this->size}, Color: {$this->color}\n";
    }
}

// Factory quản lý các đối tượng Flyweight
class CharacterFactory
{
    private $characters = [];

    public function getCharacter($char, $font, $size, $color)
    {
        $key = md5($char . $font . $size . $color);
        if (!isset($this->characters[$key])) {
            $this->characters[$key] = new CharacterFlyweight($char, $font, $size, $color);
        }
        return $this->characters[$key];
    }
}

// Tạo các đối tượng Flyweight
$factory = new CharacterFactory();
$chars = [];
for ($i = 0; $i < 1000; $i++) {
    $chars[] = $factory->getCharacter('a', 'Arial', 12, 'black');
}

// Hiển thị các đối tượng Flyweight
foreach ($chars as $index => $char) {
    $char->display($index);
}

