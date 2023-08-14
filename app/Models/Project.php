<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function getCompletionPercentageAttribute()
    {
        $completion_percentage = $this->tasks->pluck('completion_percentage')->avg() ?? 0;
        return number_format($completion_percentage, 2);
    }

    public function getBudgetIncreamentPercentageAttribute()
    {
        $estimated_budget = $this->estimated_budget;
        if (!$estimated_budget) return 100;

        $total_budget = $this->total_budget ?? $estimated_budget;

        $increment_percentage = (($total_budget - $estimated_budget) / $estimated_budget) * 100;
        return number_format($increment_percentage, 2);
    }

    public function getPaidAmountAttribute()
    {
        return $this->payments->sum('amount');
    }

    public function getPaidAmountPercentageAttribute()
    {
        $total_budget = $this->total_budget ?? $this->estimated_budget;
        if (!$total_budget) return 100;

        $paid_amount = $this->paid_amount;

        $paid_amount_percentage = ($paid_amount / $total_budget) * 100;
        return number_format($paid_amount_percentage, 2);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class );
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class );
    }
}
