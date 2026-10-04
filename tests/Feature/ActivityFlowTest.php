<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_authenticated_user_sees_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk();
    }

    public function test_user_can_record_an_activity_update(): void
    {
        $user = User::factory()->create([
            'role'      => 'support',
            'job_title' => 'Support Engineer',
        ]);

        $activity = Activity::create([
            'title'      => 'Test activity',
            'category'   => 'general',
            'created_by' => $user->id,
            'is_active'  => true,
        ]);

        $this->actingAs($user)
            ->post("/activities/{$activity->id}/updates", [
                'status' => 'done',
                'remark' => 'All clear.',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('activity_updates', [
            'activity_id' => $activity->id,
            'user_id'     => $user->id,
            'status'      => 'done',
            'remark'      => 'All clear.',
        ]);
    }

    public function test_admin_can_create_activity(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->post('/activities', [
                'title'       => 'New monitoring task',
                'category'    => 'infra',
                'description' => 'Check server health.',
                'is_active'   => true,
            ])
            ->assertRedirect('/activities');

        $this->assertDatabaseHas('activities', [
            'title'    => 'New monitoring task',
            'category' => 'infra',
        ]);
    }

    public function test_support_user_cannot_create_activity(): void
    {
        $user = User::factory()->create(['role' => 'support']);

        $this->actingAs($user)
            ->post('/activities', [
                'title'    => 'Unauthorized attempt',
                'category' => 'general',
            ])
            ->assertForbidden();
    }
}