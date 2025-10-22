<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_own_task(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Category $category */
        $category = Category::factory()->create(['status' => 'active']);

        $response = $this->actingAs($user)->post(route('tasks.store'), [
            'title' => 'Write docs',
            'description' => 'Document new API',
            'category_id' => $category->id,
            'deadline' => Carbon::now()->addDay()->toDateString(),
            'status' => 'pending',
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'title' => 'Write docs',
            'user_id' => $user->id,
        ]);
    }

    public function test_admin_can_assign_task_to_other_user(): void
    {
        /** @var User $admin */
        $admin = User::factory()->create(['role' => 'admin']);
        /** @var User $assignee */
        $assignee = User::factory()->create();
        /** @var Category $category */
        $category = Category::factory()->create(['status' => 'active']);

        $response = $this->actingAs($admin)->post(route('tasks.store'), [
            'title' => 'Review PR',
            'description' => 'Ensure code quality',
            'category_id' => $category->id,
            'deadline' => Carbon::now()->addDays(2)->toDateString(),
            'status' => 'in_progress',
            'user_id' => $assignee->id,
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'title' => 'Review PR',
            'user_id' => $assignee->id,
        ]);
    }

    public function test_user_cannot_modify_someone_elses_task(): void
    {
        /** @var User $owner */
        $owner = User::factory()->create();
        /** @var User $intruder */
        $intruder = User::factory()->create();
        /** @var Category $category */
        $category = Category::factory()->create(['status' => 'active']);
        /** @var Task $task */
        $task = Task::factory()->for($owner)->for($category)->create();

        $response = $this->actingAs($intruder)->put(route('tasks.update', $task), [
            'title' => 'Hacked Title',
            'description' => 'Should not save',
            'category_id' => $category->id,
            'deadline' => Carbon::now()->addDay()->toDateString(),
            'status' => 'done',
        ]);

        $response->assertForbidden();
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
            'title' => 'Hacked Title',
        ]);
    }
}
