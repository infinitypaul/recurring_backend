<?php

namespace Tests\Unit;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    protected $response;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $user = factory(User::class)->create();
        //$token = $user->createToken('token-name')->plainTextToken;
        $this->response = $this->actingAs($user);


    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    public function testIfICanGetMyDetailsWhenLoggedIn(){
         $this->response->get(route('dash'))
            ->assertStatus(200)
             ->assertJsonStructure([
            'data' => [
                'firstName'
            ]
        ]);




    }
}
