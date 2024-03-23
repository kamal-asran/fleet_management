<?php

namespace Tests\Unit;

use App\Http\Controllers\API\TripController;
use App\Http\Requests\BookSeatRequest;
use App\Http\Requests\SearchForSeatRequest;
use App\Http\Resources\AvailableTripsResource;
use App\Http\Resources\BookedSeatResource;
use App\Models\Trip;
use App\Models\User;
use App\Services\TripService;
use Carbon\Carbon;
use Database\Seeders\BusesTableSeeder;
use Database\Seeders\CitiesTableSeeder;
use Database\Seeders\SeatsTableSeeder;
use Database\Seeders\StationsTableSeeder;
use Database\Seeders\TripsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class TripControllerTest extends TestCase
{
    use RefreshDatabase; 

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UsersTableSeeder::class);
        $this->seed(BusesTableSeeder::class);
        $this->seed(CitiesTableSeeder::class);
        $this->seed(SeatsTableSeeder::class);
        $this->seed(TripsTableSeeder::class);
        $this->seed(StationsTableSeeder::class);

        $user = User::factory()->create();
        $this->actingAs($user);
    }
    public function testSeededDataExists()
    {
        $this->assertDatabaseHas('cities', ['name' => 'Cairo']);
        $this->assertDatabaseHas('trips', ['id' => 2]);
    }

    public function test_getAvailableSeats_returns_available_trips()
    {
        $tripService=new TripService();
        $tripController = new TripController($tripService);
        $parameters = [
            'date' => Carbon::parse(Trip::find(1)->departure_time),
            'from_city_id'=>1,
            'to_city_id'=>4,
            'from_station_id'=>1,
            'to_station_id'=>6
        ];
       
        $response = $tripController->getAvailableSeats(new SearchForSeatRequest($parameters));
        $this->assertInstanceOf(AvailableTripsResource::class, $response->first());
        $this->assertCount(1, $response);      
    }

    public function test_bookSeat_creates_booking_for_available_seat(){

        $tripService=new TripService();
       
        $tripController = new TripController($tripService);
        $parameters = [
            'trip_id'=>1,
            'from_station_id'=>1,
            'to_station_id'=>6
        ];
        
        $response = $tripController->bookSeat(new BookSeatRequest($parameters));

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

}
