<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $fillable = ['name','trip_id', 'city_id', 'sequence_number'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
