<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Trip; // Adjust the path if needed

class AvailableTripsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'bus' => $this->bus, 
            'from_city' => $this->fromCity, 
            'to_city' => $this->toCity, 
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'available_seats' => $this->availableSeats,
        ];
    }
}
