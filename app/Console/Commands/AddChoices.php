<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Question;
use App\Models\Choice;

class AddChoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'choice:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $question=Question::all();
        foreach($question as $q)
        {
            $choice=Choice::where(["question_id"=>$q->id,"label"=>"No"]);
            if($choice)
            {
                $choice->update(["weight"=>0]);
                $this->info("Updated");
            }else{
                $choice->create(["weight"=>0,"label"=>"No"]);
                $this->info("Created");
            }
        }
        $this->info("Done");
        return;
    }
}
