

interface Vehicle {
    public function move();
}

class Car implements Vehicle {
    public function move() {
        echo "Driving a car\n";
    }
}

class Bicycle implements Vehicle {
    public function move() {
        echo "Riding a bicycle\n";
    }
}

abstract class VehicleFactory {
    abstract public function createVehicle(): Vehicle;
}

class CarFactory extends VehicleFactory {
    public function createVehicle(): Vehicle {
        return new Car();
    }
}

class BicycleFactory extends VehicleFactory {
    public function createVehicle(): Vehicle {
        return new Bicycle();
    }
}

// Sử dụng Factory Method Pattern
$carFactory = new CarFactory();
$car = $carFactory->createVehicle();
$car->move();

$bicycleFactory = new BicycleFactory();
$bicycle = $bicycleFactory->createVehicle();
$bicycle->move();

Abstract Factory Pattern:
<?php

interface Vehicle
{
    public function move();
}

interface Seat
{
    public function sit();
}

interface Headlight
{
    public function shine();
}

class Car implements Vehicle
{
    public function move()
    {
        echo "Driving a car\n";
    }
}

class CarSeat implements Seat
{
    public function sit()
    {
        echo "Sitting on a car seat\n";
    }
}

class CarHeadlight implements Headlight
{
    public function shine()
    {
        echo "Car headlight shining\n";
    }
}

class Bicycle implements Vehicle
{
    public function move()
    {
        echo "Riding a bicycle\n";
    }
}

class BicycleSeat implements Seat
{
    public function sit()
    {
        echo "Sitting on a bicycle seat\n";
    }
}

class BicycleHeadlight implements Headlight
{
    public function shine()
    {
        echo "Bicycle headlight shining\n";
    }
}

interface VehicleFactory
{
    public function createVehicle(): Vehicle;
    public function createSeat(): Seat;
    public function createHeadlight(): Headlight;
}

class CarFactory implements VehicleFactory
{
    public function createVehicle(): Vehicle
    {
        return new Car();
    }

    public function createSeat(): Seat
    {
        return new CarSeat();
    }

    public function createHeadlight(): Headlight
    {
        return new CarHeadlight();
    }
}

class BicycleFactory implements VehicleFactory
{
    public function createVehicle(): Vehicle
    {
        return new Bicycle();
    }

    public function createSeat(): Seat
    {
        return new BicycleSeat();
    }

    public function createHeadlight(): Headlight
    {
        return new BicycleHeadlight();
    }
}

// Sử dụng Abstract Factory Pattern
$carFactory = new CarFactory();
$car = $carFactory->createVehicle();
$carSeat = $carFactory->createSeat();
$carHeadlight = $carFactory->createHeadlight();

$car->move();
$carSeat->sit();
$carHeadlight->shine();

$bicycleFactory = new BicycleFactory();
$bicycle = $bicycleFactory->createVehicle();
$bicycleSeat = $bicycleFactory->createSeat();
$bicycleHeadlight = $bicycleFactory->createHeadlight();

$bicycle->move();
$bicycleSeat->sit();
$bicycleHeadlight->shine();

?>
