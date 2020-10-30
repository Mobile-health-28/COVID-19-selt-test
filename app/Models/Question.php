<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    const  QUESTION_TYPE_MULTIPLE_CHOICE=1;
    const  QUESTION_TYPE_SINGLE_CHOICE=0;
    const  QUESTION_TYPE_INPUT=2;
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'short_description',
        'long_description',
        'type',
        'comment',
    ];


    function choices(){
       
            return $this->hasMany('App\Models\Choice', 'question_id', 'id');
    }
    
}