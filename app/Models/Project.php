<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    use  SoftDeletes;

    protected  $fillable = ['project_type_id','code','name','description','projectable_id','projectable_type'];

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function projectable()
    {
        return $this->morphTo();
    }
}
