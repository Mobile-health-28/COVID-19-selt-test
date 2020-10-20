<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class TestSession extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable=["user_id","started_at","end_at","score","comment"];
   
    function userChoices(){
       
        return $this->hasMany('App\Models\UserChoice', 'test_session_id', 'id');
}
function choices(){
       
    return Choice::join("user_choices","choices.id","user_choices.choice_id")
    ->join("test_sessions","user_choices.test_session_id","test_sessions.id")
    ->where("test_sessions.id",$this->id)
    ->get();
     //$this->hasMany('App\Models\UserChoice', 'test_session_id', 'id');
}
 function getAdvices(){
    $testSession=$this;
    $score=$testSession->choices()->sum("weight");
  

    $advice_message="";
    if($score<=3&&$score>0)
    {
        $advice_message="You are safe. Follow the Safety protocols and protect yourself, contact your health care provider
        for advice if you develop new symptoms or if you have close contact with someone with suspicious
        COVID-19 symptoms";
    }elseif($score<=6&&$score>3){

        $advice_message="Your Risk of suffering from the virus is Low, But to save yourself and not to endanger your loved
        ones, call your health care provider and describe your symptoms to know the causes of what you are
        facing";
    }elseif($score<=11&&$score>6){
        $advice_message="This looks Suspicious even though your risk looks minimal!!, to save yourself and not to
        endanger your loved ones, call your health care provider and describe your symptoms and your contact
        with someone who’s been diagnosed as positive immediately.";
    }
    else{
        $advice_message="This doesn’t look Good, your risk is high!!, to save yourself and not to endanger your loved
        ones, call your health care provider and describe your symptoms and your contact with someone who’s
        been diagnosed as positive immediately.";
    }
    $advice=["score"=>$score, 
    'comment'=>$advice_message,
    'end_at'=>Carbon::now(),
];
    $this->update($advice);

    return $this;
}
}
