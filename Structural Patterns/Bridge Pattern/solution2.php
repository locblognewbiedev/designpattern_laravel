<?php

// Implementor Interface
interface Color
{
    public function applyColor();
}

// Concrete Implementors
class Red implements Color
{
    public function applyColor()
    {
        echo "Applying Red Color";
    }
}

class Blue implements Color
{
    public function applyColor()
    {
        echo "Applying Blue Color";
    }
}

// Abstraction
abstract class Shape
{
    protected $color;

    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    abstract public function draw();
}

// Refined Abstractions
class Circle extends Shape
{
    public function draw()
    {
        echo "Drawing Circle with ";
        $this->color->applyColor();
    }
}

class Square extends Shape
{
    public function draw()
    {
        echo "Drawing Square with ";
        $this->color->applyColor();
    }
}

// Client code
$shape1 = new Circle(new Red());
$shape1->draw(); // Output: Drawing Circle with Applying Red Color

$shape2 = new Square(new Blue());
$shape2->draw(); // Output: Drawing Square with Applying Blue Color

?>
