<?php

namespace App\Handlers;

use App\Models\{Category, Task};
use Illuminate\Database\Eloquent\Collection;

class ViewHandler
{
    /**
     * @return Collection
     */
    public function categoriesList(): Collection
    {
        return Category::all();
    }

    /**
     * @param bool $completed
     *
     * @return mixed
     */
    public function tasksList(bool $completed = true): mixed
    {
        return Task::completed($completed)->with('categories')->get();
    }
}
