<?php

// Class Abstraction
class Shape
{
    public function draw()
    {
    }
}

// Concrete Implementations
class RedCircle extends Shape
{
    public function draw()
    {
        echo "Drawing Red Circle";
    }
}

class BlueCircle extends Shape
{
    public function draw()
    {
        echo "Drawing Blue Circle";
    }
}

class RedSquare extends Shape
{
    public function draw()
    {
        echo "Drawing Red Square";
    }
}

class BlueSquare extends Shape
{
    public function draw()
    {
        echo "Drawing Blue Square";
    }
}

// Client code
$shape1 = new RedCircle();
$shape1->draw(); // Output: Drawing Red Circle

$shape2 = new BlueSquare();
$shape2->draw(); // Output: Drawing Blue Square

?>
