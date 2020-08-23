<?php

use Dainsys\QAApp\Models\Form;
use Dainsys\QAApp\Models\QuestionType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qa_app_questions', function (Blueprint $table) {
            $table->id();
            $table->string('text', 400);
            $table->float('points')->default(0)->comment('The amount of points the question is worth');
            $table->foreignId('form_id')->constrained((new Form())->getTable());
            $table->foreignId('question_type_id')->constrained((new QuestionType())->getTable());
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
        Schema::dropIfExists('qa_app_questions');
    }
}
