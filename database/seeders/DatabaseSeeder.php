<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* @var $tasks Task */
        $tasks = Task::factory(8)->create();

        foreach ($tasks as $task) {
            $task->categories()->sync([1, 2]);
        }
    }
}
