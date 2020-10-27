<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('choices', function (Blueprint $table) {
            $table->string('label')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->string('comment')->nullable();
            $table->dropColumn("test_session_id");
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
            $table->dropColumn("label");
            $table->dropColumn("is_correct");
            $table->dropColumn("comment");
        });
    }
}
