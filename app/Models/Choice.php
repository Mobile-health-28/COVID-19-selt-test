<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;
    protected $fillable=["label","question_id","comment","weight",];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public function question(){
            return $this->hasOne('App\Models\Question', 'id', 'question_id');
    
    }
}
