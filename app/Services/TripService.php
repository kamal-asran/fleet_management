<?php
namespace App\Services;

use App\Models\Booking;
use App\Models\Trip;
use App\Models\Station;

class TripService
{
    public function getAvailableSeats($date,$fromCityId,$toCityId,$fromStationId,$toStationId)
    {
        //Search for matching trips 
        $trips = Trip::with(['stations.city','fromCity','toCity'])
            ->whereDate('departure_time', $date)
            ->where('from_city_id', $fromCityId)
            ->where('to_city_id', $toCityId)
            ->get();

    
        //Filter trips based on station criteria
        $trips = $trips->filter(function ($trip) use ($fromStationId, $toStationId) {
            return $trip->stations->contains('id', $fromStationId) &&
                   $trip->stations->contains('id', $toStationId);
        });
    
        //Determine available seats for each trip
        $trips->map(function ($trip) use ($fromStationId, $toStationId)
        {
            $seatIds = $trip->bus->seats->pluck('id'); // Get all seat IDs for the trip

            // Exclude booked seats
            $bookedSeatIds = $trip->bookings->pluck('seat_id');
            $seatIds = $seatIds->diff($bookedSeatIds);

            $fromStationSequenceNumber=Station::where('id',$fromStationId)->first()->sequence_number;
            $toStationSequenceNumber=Station::where('id',$toStationId)->first()->sequence_number;

            // Conditionally add seats from specific bookings
            $availableSeatIds1 = Booking::where('trip_id', $trip->id)
                ->where('to_station_sequence_number', '<=', $fromStationSequenceNumber)
                ->distinct()
                ->pluck('seat_id');
            $availableSeatIds2 = Booking::where('trip_id', $trip->id)
                ->whereIn('seat_id',$availableSeatIds1)
                ->where('from_station_sequence_number', '>=', $toStationSequenceNumber)
                ->distinct()
                ->pluck('seat_id');

            $seatIds = $seatIds->merge($availableSeatIds2);

            $trip->availableSeats = $seatIds;
        });
    
        return $trips;
    }

    public function bookSeat(int $tripId, int $fromStationId,int $toStationId,$userId)
    {
            
        // Get available seats
        $availableSeats = $this->getAvailableSeatsForTrip($tripId, $fromStationId, $toStationId);

        // Check if no seats are available
        if ($availableSeats->isEmpty()) {
            return false;
        }

        // Select a random seat ID from available seats
        $randomSeatId = $availableSeats->random();
        
        // Get sequence_number form the stations
        $fromStationSequenceNumber = Station::where('id', $fromStationId)->first()->sequence_number;
        $toStationSequenceNumber = Station::where('id', $toStationId)->first()->sequence_number;
       
        //Create a new booking
        $booking = Booking::create([
            'user_id' => $userId,
            'trip_id' => $tripId,
            'from_station_id' => $fromStationId,
            'to_station_id' => $toStationId,
            'seat_id' => $randomSeatId,
            'from_station_sequence_number'=>$fromStationSequenceNumber,
            'to_station_sequence_number'=>$toStationSequenceNumber,
        ]);

        return $booking;    
    }

    private function getAvailableSeatsForTrip($tripId, $fromStationId, $toStationId)
    {
        $trip = Trip::with(['stations.city', 'fromCity', 'toCity', 'bus.seats'])
            ->where('id', $tripId)
            ->first();
    
        if (!$trip) {
            return collect([]);
        }
        // Get all seat IDs for the trip
        $seatIds = $trip->bus->seats->pluck('id');
    
        // Exclude booked seats
        $bookedSeatIds = $trip->bookings->pluck('seat_id');
        $seatIds = $seatIds->diff($bookedSeatIds);
    
        $fromStationSequenceNumber = Station::where('id', $fromStationId)->first()->sequence_number;
        $toStationSequenceNumber = Station::where('id', $toStationId)->first()->sequence_number;
    
        // Conditionally add seats from specific bookings (same logic as getAvailableSeats)
        $availableSeatIds1 = Booking::where('trip_id', $tripId)
            ->where('to_station_sequence_number', '<=', $fromStationSequenceNumber)
            ->distinct()
            ->pluck('seat_id');
            
        $availableSeatIds2 = Booking::where('trip_id', $tripId)
            ->whereIn('seat_id', $availableSeatIds1)
            ->where('from_station_sequence_number', '>=', $toStationSequenceNumber)
            ->distinct()
            ->pluck('seat_id');
    
        $seatIds = $seatIds->merge($availableSeatIds2);
    
        return $seatIds;
    }

   
    
}
