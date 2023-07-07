<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function adminsAreRedirectedToHomeAfterLogin()
    {
        Artisan::call('db:seed');
        // login as admin
        $response = $this->from('/login')->post('/login', [
            'email' => 'admin@2023.laravelconf.tw',
            'password' => 'password',
        ]);

        $this->assertTrue(Auth::check());

        $response->assertStatus(302)
            ->assertRedirect('/home');
    }
}
