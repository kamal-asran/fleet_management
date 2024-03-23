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

   
    
}
