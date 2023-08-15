<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class   Inspection extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function dependentTask()
    {
        return $this->belongsToMany(Task::class,'inspection_dependencies','inspection_id','dependent_task_id')
            ->where('inspection_dependencies.deleted_at', null);
    }

    public function inspectionDependencies()
    {
        return $this->hasMany(InspectionDependency::class);
    }
}
