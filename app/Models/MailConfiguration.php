<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailConfiguration extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function oauthToken()
    {
        return $this->belongsTo(OauthToken::class);
    }
}
