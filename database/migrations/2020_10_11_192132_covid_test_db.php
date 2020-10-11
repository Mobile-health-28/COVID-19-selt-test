<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CovidTestDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        /**
         * Questions
         */
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('short_description');
            $table->string('long_description');
            $table->tinyInteger('type');
            $table->softDeletes();
            $table->timestamps();
        });
        /**
         * Choices
         */
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('test_session_id');
            $table->timestamps();
            $table->softDeletes();
             $table->foreign('question_id')->references('id')->on('questions');



        });

        /**
         * test_sessions
         */
        Schema::create('test_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->dateTime('started_at');
            $table->dateTime('end_at');
            $table->tinyInteger('score');
            $table->string('comment');
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        /**
         * user_choices
         */
        Schema::create('user_choices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('choice_id');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_choices');
        Schema::drop('test_sessions');
        Schema::drop('choices');
        Schema::drop('questions');
    
    }
}
