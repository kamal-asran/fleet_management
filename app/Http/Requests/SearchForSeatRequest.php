<?php

namespace App\Http\Requests;


class SearchForSeatRequest extends BaseFromRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date'=>'required|date',
            'from_station_id' => 'required||exists:stations,id',
            'to_station_id' => 'required||exists:stations,id',
            'from_city_id' => 'required||exists:cities,id',
            'to_city_id' => 'required||exists:cities,id',
        ];
    }

    
}
