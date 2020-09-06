<?php

namespace Dainsys\QAApp\Models;

class Question extends BaseModel
{
    protected $table = 'qa_app_questions';

    protected $fillable = ['text', 'points', 'form_id', 'question_type_id'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function questionType()
    {
        return $this->belongsTo(QuestionType::class);
    }
}
