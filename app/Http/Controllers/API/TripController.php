<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookSeatRequest;
use App\Http\Requests\SearchForSeatRequest;
use App\Http\Resources\AvailableTripsResource;
use App\Http\Resources\BookedSeatResource;
use App\Services\TripService;

class TripController extends Controller
{
    protected $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }
    public function getAvailableSeats(SearchForSeatRequest $request)
    {
        $date=$request->date;
        $fromCityId=$request->from_city_id;
        $toCityId=$request->to_city_id;
        $fromStationId=$request->from_station_id;
        $toStationId=$request->to_station_id;
        try{
            $availableTrips = $this->tripService->getAvailableSeats($date,$fromCityId,$toCityId,$fromStationId,$toStationId);
        }catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
        return AvailableTripsResource::collection($availableTrips);
    }
    public function bookSeat(BookSeatRequest $request)
    {
        $userId = auth()->user()->id; // Assuming user ID is retrieved from authentication
        $tripId = $request->trip_id;
        $fromStationId = $request->from_station_id;
        $toStationId = $request->to_station_id;
    
        try{
            $booking = $this->tripService->bookSeat($tripId,$fromStationId,$toStationId,$userId);
            if(!$booking)
            {
                return response()->json(['error' => 'No available seats for this trip and stations'], 400);
            }
        }catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
        return response()->json(['message' => 'Seat booked successfully', 'booking' => new BookedSeatResource($booking)], 201);
    }
}
