<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSession extends Model
{
    use HasFactory;
    protected $fillable=["user_id","start_at","end_at","score","comment"];
   
}
