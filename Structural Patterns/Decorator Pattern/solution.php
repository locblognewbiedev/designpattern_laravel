<?php
// Giao diện chung cho Text và Decorator
interface TextInterface
{
    public function render();
}

// Lớp Text cơ bản
class Text implements TextInterface
{
    private $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function render()
    {
        return $this->content;
    }
}

// Lớp Decorator cơ bản
abstract class TextDecorator implements TextInterface
{
    protected $text;

    public function __construct(TextInterface $text)
    {
        $this->text = $text;
    }
}

// Decorator cho in đậm
class BoldDecorator extends TextDecorator
{
    public function render()
    {
        return '<b>' . $this->text->render() . '</b>';
    }
}

// Decorator cho in nghiêng
class ItalicDecorator extends TextDecorator
{
    public function render()
    {
        return '<i>' . $this->text->render() . '</i>';
    }
}

// Decorator cho gạch chân
class UnderlineDecorator extends TextDecorator
{
    public function render()
    {
        return '<u>' . $this->text->render() . '</u>';
    }
}

// Sử dụng các decorator
$text = new Text("Hello, World!");
$boldText = new BoldDecorator($text);
$italicText = new ItalicDecorator($boldText);
$underlinedText = new UnderlineDecorator($italicText);

echo $underlinedText->render(); // <u><i><b>Hello, World!</b></i></u>
