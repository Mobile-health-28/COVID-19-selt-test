<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChoiceTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('choices', function (Blueprint $table) {
            $table->tinyInteger('weight')->default(1);
            $table->dropColumn("is_correct");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('choices', function (Blueprint $table) {
            $table->dropColumn("weight");
            $table->boolean('is_correct')->nullable();
        });
    }
}
