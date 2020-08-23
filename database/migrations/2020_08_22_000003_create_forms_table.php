<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qa_app_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->float('goal_percentage')->nullable()->default(1)->comment('A decimal value (between 0 and 1) representing the percentage of points that will be given when chosen');
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
        Schema::dropIfExists('qa_app_forms');
    }
}
