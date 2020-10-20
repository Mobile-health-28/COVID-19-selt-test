<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChoice extends Model
{
    use HasFactory;
    protected $fillable=["user_id","question_id","choice_id","test_session_id",];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public function question(){
            return $this->hasOne('App\Models\Question', 'id', 'question_id');
    
    }
    public function choice(){
        return $this->hasOne('App\Models\Choice', 'id', 'choice_id');

}
public function testSession(){
    return $this->hasOne('App\Models\TestSession', 'id', 'test_session_id');

}
}
