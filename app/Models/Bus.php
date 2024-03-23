<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = ['bus_number', 'total_seats'];

    public function trips()
    {
        return $this->belongsToMany(Trip::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
