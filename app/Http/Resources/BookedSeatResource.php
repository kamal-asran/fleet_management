<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Trip; // Adjust the path if needed

class BookedSeatResource extends JsonResource
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
            'trip' => $this->trip, 
            'from_station' => $this->fromStation, 
            'to_station' => $this->toStation, 
            'seat' => $this->seat,
        ];
    }
}
