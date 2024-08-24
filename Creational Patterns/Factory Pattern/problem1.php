<?php

class Car
{
    public function drive()
    {
        echo "Driving a car\n";
    }
}

class Bicycle
{
    public function ride()
    {
        echo "Riding a bicycle\n";
    }
}

// Main
$car = new Car();
$bicycle = new Bicycle();

$car->drive();
$bicycle->ride();


