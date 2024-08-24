Bối cảnh:
Bạn đang phát triển một hệ thống quản lý đặt vé du lịch bao gồm các thành phần như hệ thống đặt vé máy bay, hệ thống đặt khách sạn và hệ thống đặt xe.
<?php
class FlightBookingSystem
{
    public function searchFlights($from, $to, $date)
    {
        echo "Searching for flights from $from to $to on $date.\n";
    }

    public function bookFlight($flightNumber)
    {
        echo "Booking flight $flightNumber.\n";
    }
}

class HotelBookingSystem
{
    public function searchHotels($location, $checkIn, $checkOut)
    {
        echo "Searching for hotels in $location from $checkIn to $checkOut.\n";
    }

    public function bookHotel($hotelName)
    {
        echo "Booking hotel $hotelName.\n";
    }
}

class CarRentalSystem
{
    public function searchCars($location, $date)
    {
        echo "Searching for cars in $location on $date.\n";
    }

    public function bookCar($carModel)
    {
        echo "Booking car $carModel.\n";
    }
}
class TravelFacade
{
    protected $flightBooking;
    protected $hotelBooking;
    protected $carRental;

    public function __construct()
    {
        $this->flightBooking = new FlightBookingSystem();
        $this->hotelBooking = new HotelBookingSystem();
        $this->carRental = new CarRentalSystem();
    }

    public function bookCompletePackage($from, $to, $flightDate, $hotelLocation, $checkIn, $checkOut, $carLocation, $carDate)
    {
        $this->flightBooking->searchFlights($from, $to, $flightDate);
        $this->flightBooking->bookFlight('FL123');

        $this->hotelBooking->searchHotels($hotelLocation, $checkIn, $checkOut);
        $this->hotelBooking->bookHotel('Hilton');

        $this->carRental->searchCars($carLocation, $carDate);
        $this->carRental->bookCar('Toyota Camry');
    }
}
$travelFacade = new TravelFacade();
$travelFacade->bookCompletePackage('NYC', 'LA', '2023-12-25', 'LA', '2023-12-25', '2023-12-30', 'LA', '2023-12-25');
