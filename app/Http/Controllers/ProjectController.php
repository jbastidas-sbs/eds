<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Customer;
use App\Models\ProjectType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProjectController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Projects/Index', [
            'filters' => Request::all('search', 'trashed'),
            'projects' => Project::with('projectType','projectable')
                ->orderByCode()
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($project) => [
                    'id' => $project->id,
                    'code' => $project->code,
                    'name' => $project->name,
                    'description' => $project->description,
                    'deleted_at' => $project->deleted_at,
                    'responsible' => $project->projectable_type == 'App\Models\User' ? $project->projectable->first_name : $project->projectable->name,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Projects/Create', [
            'projectTypes' => ProjectType::get(),
            'users' => User::orderByName()
                ->get()
                ->map
                ->only('id','first_name'),
            'customers' => Customer::orderByName()
            ->get()
            ->map
            ->only('id','name'),
        ]);
    }
}
