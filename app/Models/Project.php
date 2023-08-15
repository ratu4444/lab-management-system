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

    public function getTotalBudgetAttribute()
    {
        return $this->tasks->where('status', '!=', config('app.STATUSES.Canceled'))->sum('amount');
    }

    public function getCompletionPercentageAttribute()
    {
        $statuses = config('app.STATUSES');
        switch ($this->status) {
            case $statuses['Canceled']:
                return 0;
            case $statuses['Completed']:
                return 100;
            default:
            $completion_percentage = $this->tasks->where('status', '!=', $statuses['Canceled'])->pluck('completion_percentage')->avg() ?? 0;
            return sprintf("%.2f", $completion_percentage);
        }
    }

    public function getBudgetIncreamentPercentageAttribute()
    {
        $estimated_budget = $this->estimated_budget;
        if (!$estimated_budget) return 100;

        $total_budget = $this->total_budget ?? $estimated_budget;

        $increment_percentage = (($total_budget - $estimated_budget) / $estimated_budget) * 100;
        return sprintf("%.2f", $increment_percentage);
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
        return sprintf("%.2f", $paid_amount_percentage);
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
