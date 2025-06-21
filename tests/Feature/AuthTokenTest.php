<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class AuthTokenTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Draai migraties voor de testdatabase
        $this->artisan('migrate', ['--env' => 'testing']);
    }

    public function test_user_can_generate_token()
    {
        $user = User::create([
            'name' => 'Test Gebruiker',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }

    public function test_user_cannot_generate_token_with_invalid_credentials()
    {
        User::create([
            'name' => 'Test Gebruiker',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'verkeerd',
        ]);

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_access_protected_route()
    {
        $user = User::factory()->create();

        $token = $user->createToken('Test')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/protected-route');

        $response->assertStatus(200);
    }

    public function test_guest_cannot_access_protected_route()
    {
        $response = $this->getJson('/api/protected-route');

        $response->assertStatus(401);
    }
}
