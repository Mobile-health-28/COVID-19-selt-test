<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTestSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test_sessions', function (Blueprint $table) {
            $table->dateTime('end_at')->nullable()->change();
            $table->integer('score')->nullable()->change();
            $table->string('comment')->nullable()->change();   
            
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_sessions', function (Blueprint $table) {
            //
        });
    }
}
