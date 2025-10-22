<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_category(): void
    {
    /** @var User $admin */
    $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)
            ->post(route('categories.store'), [
                'name' => 'Backend',
                'description' => 'Tasks for backend developers',
                'status' => 'active',
            ]);

        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', [
            'name' => 'Backend',
            'status' => 'active',
        ]);
    }

    public function test_user_cannot_create_category(): void
    {
    /** @var User $user */
    $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)
            ->post(route('categories.store'), [
                'name' => 'Should Fail',
                'status' => 'active',
            ]);

        $response->assertForbidden();
        $this->assertDatabaseMissing('categories', ['name' => 'Should Fail']);
    }
}
