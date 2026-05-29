<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
        $this->adminUser = User::where('username', 'admin')->first();
    }

    public function test_admin_dashboard_loads()
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('/dashboard/admin');
        $response->assertStatus(200);
    }

    public function test_admin_users_page_loads()
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('/admin/users');
        $response->assertStatus(200);
    }

    public function test_admin_can_create_dosen_account()
    {
        $this->actingAs($this->adminUser);

        $response = $this->post('/admin/users', [
            'name'     => 'Dosen Baru',
            'username' => '19990001',
            'role'     => 'dosen',
            'password' => 'password123',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', ['username' => '19990001', 'role' => 'dosen']);
        $this->assertDatabaseHas('dosens', ['nik' => '19990001']);
    }

    public function test_admin_can_create_operator_account()
    {
        $this->actingAs($this->adminUser);

        $response = $this->post('/admin/users', [
            'name'     => 'Operator Baru',
            'username' => 'operator2',
            'role'     => 'operator',
            'password' => 'password123',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', ['username' => 'operator2', 'role' => 'operator']);
    }

    public function test_admin_can_delete_user()
    {
        $this->actingAs($this->adminUser);

        $user = User::where('username', 'operator')->first();

        $response = $this->delete("/admin/users/{$user->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_cannot_access_mahasiswa_routes()
    {
        $this->actingAs($this->adminUser);

        $response = $this->get('/mahasiswa/dashboard');
        $response->assertRedirect();
    }
}
