<?php

namespace Dainsys\QAApp\Models;

use Dainsys\QAApp\Repositories\QuestionTypeRepository;

class QuestionOption extends BaseModel
{
    protected $table = 'qa_app_question_options';

    protected $fillable = ['name', 'value', 'question_type_id'];

    public function questionType()
    {
        return $this->belongsTo(QuestionType::class);
    }

    public function getQuestionTypesList()
    {
        return QuestionType::orderBy('name')->pluck('name', 'id');
    }
}
