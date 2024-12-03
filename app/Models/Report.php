<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function getFilePathAttribute()
    {
        return getFileUrl($this->file);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
