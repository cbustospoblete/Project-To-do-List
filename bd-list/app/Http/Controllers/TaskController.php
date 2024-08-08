<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;


class TaskController extends Controller
{

    public function deleteTask($id)
    {
        $task = Task::find($id);

        if ($task) {
            $task->delete();
            return $task;
        }

        return null;
    }
}
