<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Tasks/Index',[
            'filters' => Request::all('search', 'trashed'),
            'tasks' => Task::orderByName()
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($task) => [
                    'id' => $task->id,
                ]),
        ]);
    }
}
