<?php

namespace Tests\Unit;


use App\Http\Resources\ServiceResource;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Service;

class ServiceTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testWeCanListServices()
    {

        $services = factory(Service::class, 2)->create()->map(function ($service) {
            return $service;
        });

        $response = $this->get(route('services'));
        $json = $response->json();
        $resource = ServiceResource::collection($services);

        $resourceResponse = $resource->response()->getData(true);

        $this->assertEquals($json, $resourceResponse);

    }

    public function testWeCanAccessASingleService(){
        $service = factory(Service::class)->create();

        $this->get(route('service.show', $service->id))
            ->assertStatus(200);
    }
}
