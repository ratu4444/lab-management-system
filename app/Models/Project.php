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
        $total_budget = $this->tasks->where('status', '!=', config('app.STATUSES.Canceled'))->sum('total_budget');

        return $total_budget ?: $this->estimated_budget;
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
            return number_format($completion_percentage, is_int($completion_percentage) ? 0 : 2);
        }
    }

    public function getBudgetIncreamentPercentageAttribute()
    {
        $estimated_budget = $this->estimated_budget;
        $total_budget = $this->total_budget;

        if (!$estimated_budget && $total_budget) return 100;
        elseif (!$estimated_budget && !$total_budget) return 0;

        $increment_percentage = (($total_budget - $estimated_budget) / $estimated_budget) * 100;
        return number_format($increment_percentage, is_int($increment_percentage) ? 0 : 2);
    }

    public function getPaidAmountAttribute()
    {
        return $this->payments->sum('amount');
    }

    public function getPaidAmountPercentageAttribute()
    {
        $total_budget = $this->total_budget;
        if (!$total_budget) return 100;

        $paid_amount = $this->paid_amount;

        $paid_amount_percentage = ($paid_amount / $total_budget) * 100;
        return number_format($paid_amount_percentage, is_int($paid_amount_percentage) ? 0 : 2);
    }

    public function getHasRunningTaskAttribute()
    {
        $statuses = config('app.STATUSES');
        $incomplete_tasks = $this->tasks
            ->whereNotIn('status',  [$statuses['Completed'], $statuses['Canceled']]);

        return (bool) $incomplete_tasks->count();
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

    public function elementSettings()
    {
        return $this->hasMany(ElementSetting::class);
    }
}
