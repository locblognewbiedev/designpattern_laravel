<?php

interface Vehicle
{
    public function move();
}

class Car implements Vehicle
{
    public function move()
    {
        echo "Driving a car\n";
    }
}

class Bicycle implements Vehicle
{
    public function move()
    {
        echo "Riding a bicycle\n";
    }
}

class VehicleFactory
{
    public static function createVehicle($type)
    {
        if (strcasecmp($type, "car") == 0) {
            return new Car();
        } else if (strcasecmp($type, "bicycle") == 0) {
            return new Bicycle();
        }
        return null;
    }
}

// Main
$car = VehicleFactory::createVehicle("car");
$bicycle = VehicleFactory::createVehicle("bicycle");

$car->move();
$bicycle->move();

