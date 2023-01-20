<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    use  SoftDeletes;

    protected $fillable = ['project_id','name','estimated_time','completion_percentage'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
