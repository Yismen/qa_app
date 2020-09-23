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
        $user = resolve('App\User');
        Schema::create('qa_app_audits', function (Blueprint $table) use ($user) {
            $table->id();
            $table->foreignId('form_id')->constrained((new Form())->getTable());
            $table->foreignId('user_id')->constrained((new $user)->getTable());
            $table->date('production_date');
            $table->double('max_points', 15, 8)->nullable();
            $table->double('points', 15, 8)->nullable();
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
