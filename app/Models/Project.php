<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    use  SoftDeletes;

    
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

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

    public function scopeOrderByCode($query)
    {
        $query->orderBy('code');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('code', 'like', '%'.$search.'%');
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
