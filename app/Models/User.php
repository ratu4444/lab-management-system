<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const TYPE_SUPERADMMIN = 'superadmin';
    const TYPE_ADMIN = 'admin';
    const TYPE_CLIENT = 'client';

    public function getIsClientAttribute()
    {
        return $this->type === self::TYPE_CLIENT;
    }

    public function getInitialAttribute()
    {
        $name = $this->name;
        return strtoupper(preg_replace('/\B\w| /u', '', $name));
    }

    public function scopeWhereClient($query)
    {
        return $query->where('type', self::TYPE_CLIENT);
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id');
    }
}
