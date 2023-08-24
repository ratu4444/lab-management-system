<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function dependentTasks()
    {
        return $this->belongsToMany(Task::class,'task_dependencies', 'task_id', 'dependent_task_id')
            ->where('task_dependencies.deleted_at', null);
    }

    public function taskDependencies()
    {
        return $this->hasMany(TaskDependency::class);
    }

    public function payments()
    {
        return $this->belongsToMany(Payment::class,'task_payments')
            ->where('task_payments.deleted_at', null);
    }
}
