<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Car;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method.
     */
    public function testIndex()
    {
        // Create some sample cars
        Car::factory(3)->create();
        // dd($car);

        $response = $this->get('/api/cars');

        $response->assertStatus(200)
            ->assertJsonCount(3); // Assuming there are 3 cars in the database
    }

    /**
     * Test the store method.
     */
    public function testStore()
    {
        $carData = [
            'model_name' => 'Test Car',
            'description' => 'This is a test car.',
            'product_year' => 2023,
            'price' => 20000,
            'manufacturer_id' => 1, // Assuming a valid manufacturer ID
        ];

        $response = $this->post('/api/cars', $carData);

        $response->assertStatus(201)
            ->assertJson($carData); // Assuming you return the created car data in the response
    }

    /**
     * Test the show method.
     */
    public function testShow()
    {
        $car = Car::factory()->create();
        
        $response = $this->get("/api/cars/{$car->id}");

        $response->assertStatus(200)
            ->assertJson($car->toArray());
    }

    // You can write similar tests for the other controller methods (update and destroy).
}
