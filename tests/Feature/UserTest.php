<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function createUser()
    {
        $user = User::factory()->create([
            'name' => $this->faker->name(),
            'email' => 'nishant@nishant.com',
            'password' => 'password',
            'profile_img' => 'storage/app/user/profile1.jpg',
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertCount(1, User::all());
    }
}
