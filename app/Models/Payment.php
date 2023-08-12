<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Project;

class Payment extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function dependentTasks()
    {
        return $this->belongsToMany(Task::class,'task_payments')
            ->where('task_payments.deleted_at', null);
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}

