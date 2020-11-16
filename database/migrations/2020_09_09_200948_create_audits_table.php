<?php

use App\User;
use Dainsys\QAApp\Models\Form;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qa_app_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained((new Form())->getTable());
            $table->foreignId('user_id')->constrained((new User())->getTable());
            $table->date('production_date');
            $table->double('max_points', 15, 8)->nullable();
            $table->double('points', 15, 8)->nullable();
            $table->double('points_goal', 15, 8)->nullable();
            $table->boolean('passes')->default(false);
            $table->text('data')->nullable();
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
        Schema::dropIfExists('qa_app_audits');
    }
}
