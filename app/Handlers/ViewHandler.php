<?php

namespace App\Handlers;

use App\Models\Task;

class ViewHandler
{
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
