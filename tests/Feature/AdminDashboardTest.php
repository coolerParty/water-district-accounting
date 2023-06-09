<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{

    public function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();

        // now re-register all the roles and permissions (clears cache and reloads relations)
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    public function test_dashboard_page_require_login()
    {
        $user = User::factory()->unverified()->create();

        $this->actingAs($user)
            ->get(route('landing.worldwide'))
            ->assertRedirect(route('home'));

        $this->assertGuest();
    }

    // public function test_dashboard_page_require_permission()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
}
