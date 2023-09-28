<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Manufacturer;

class ManufacturerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // Create some sample manufacturers
        Manufacturer::factory(3)->create();

        $response = $this->get('/api/manufacturers');

        $response->assertStatus(200)
            ->assertJsonCount(3); // Assuming there are 3 manufacturers in the database
    }

    public function testStore()
    {
        $manufacturerData = [
            'title' => 'Test Manufacturer',
            'description' => 'This is a test manufacturer.',
        ];

        $response = $this->post('/api/manufacturers', $manufacturerData);

        $response->assertStatus(201)
            ->assertJson($manufacturerData);
    }

    public function testShow()
    {
        $manufacturer = Manufacturer::factory()->create();

        $response = $this->get("/api/manufacturers/{$manufacturer->id}");

        $response->assertStatus(200)
            ->assertJson($manufacturer->toArray());
    }

    public function testUpdate()
    {
        $manufacturer = Manufacturer::factory()->create();
        $newData = [
            'title' => 'Updated Manufacturer',
            'description' => 'This is an updated manufacturer.',
        ];

        $response = $this->put("/api/manufacturers/{$manufacturer->id}", $newData);

        $response->assertStatus(200)
            ->assertJson($newData);
    }

    public function testDestroy()
    {
        $manufacturer = Manufacturer::factory()->create();

        $response = $this->delete("/api/manufacturers/{$manufacturer->id}");

        $response->assertStatus(200);

        // Verify that the manufacturer has been deleted from the database
        $this->assertDatabaseMissing('manufacturers', ['id' => $manufacturer->id]);
    }
}