<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin/berita');

        $response->assertRedirect('/admin/login');
    }

    public function test_welcome_admin_link_takes_guest_to_login(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('href="' . route('login') . '"', false);
    }

    public function test_welcome_admin_link_takes_admin_to_dashboard(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/');

        $response->assertOk();
        $response->assertSee('href="' . route('admin.articles.index') . '"', false);
    }

    public function test_admin_can_log_in_and_open_the_dashboard(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'password',
            'is_admin' => true,
        ]);

        $response = $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/berita');
        $this->assertAuthenticatedAs($admin);
        $this->get('/admin/berita')->assertOk();
    }

    public function test_non_admin_cannot_access_the_admin_panel(): void
    {
        $user = User::factory()->create([
            'email' => 'reader@example.com',
            'password' => 'password',
            'is_admin' => false,
        ]);

        $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect('/admin/login');

        $this->assertGuest();
        $this->get('/admin/berita')->assertRedirect('/admin/login');
    }
}
