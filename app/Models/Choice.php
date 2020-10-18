<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;
    protected $fillable=["label","question_id","comment","weght"];
    public function question(){
            return $this->hasOne('App\Models\Question', 'id', 'question_id');
    
    }
}
