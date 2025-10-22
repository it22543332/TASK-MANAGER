<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $assignmentDate = Carbon::now();

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'assignment_date' => $assignmentDate->copy(),
            'deadline' => $assignmentDate->copy()->addDays(random_int(1, 5)),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'done']),
        ];
    }
}
