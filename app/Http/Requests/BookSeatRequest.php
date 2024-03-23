<?php

namespace App\Http\Requests;


class BookSeatRequest extends BaseFromRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from_station_id' => 'required||exists:stations,id',
            'to_station_id' => 'required||exists:stations,id',
            'trip_id' => 'required|exists:trips,id',
        ];
    }

    
}
