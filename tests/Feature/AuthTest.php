<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_login_page_can_be_accessed()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_admin_can_login()
    {
        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard/admin');
        $this->assertAuthenticated();
    }

    public function test_dosen_can_login()
    {
        $response = $this->post('/login', [
            'username' => '19876001',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard/dosen');
        $this->assertAuthenticated();
    }

    public function test_operator_can_login()
    {
        $response = $this->post('/login', [
            'username' => 'operator',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard/operator');
        $this->assertAuthenticated();
    }

    public function test_mahasiswa_can_login()
    {
        $response = $this->post('/login', [
            'username' => '23.01.5029',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/mahasiswa/dashboard');
        $this->assertAuthenticated();
    }

    public function test_login_fails_with_wrong_password()
    {
        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    public function test_login_fails_with_non_existent_user()
    {
        $response = $this->post('/login', [
            'username' => 'nonexistent',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    public function test_logout()
    {
        $user = \App\Models\User::where('username', 'admin')->first();
        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_authenticated_user_cannot_access_login_page()
    {
        $user = \App\Models\User::where('username', 'admin')->first();
        $this->actingAs($user);

        $response = $this->get('/login');
        $response->assertRedirect();
    }

    public function test_guest_cannot_access_protected_page()
    {
        $response = $this->get('/mahasiswa/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_role_middleware_blocks_wrong_role()
    {
        $mahasiswa = \App\Models\User::where('username', '23.01.5029')->first();
        $this->actingAs($mahasiswa);

        $response = $this->get('/dashboard/admin');
        $response->assertRedirect('/mahasiswa/dashboard');
    }
}
