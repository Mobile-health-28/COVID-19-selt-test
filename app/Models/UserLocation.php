<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'user_id',
        'test_session_id',
        'choice_id',
    ];
}
