<?php

namespace Dainsys\QAApp\Models;

use Dainsys\QAApp\Repositories\FormRepository;
use Dainsys\QAApp\Repositories\QuestionTypeRepository;

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

    public function getFormsListAttribute()
    {
        return FormRepository::list();
    }

    public function getQuestionTypesListAttribute()
    {
        return QuestionTypeRepository::list();
    }

    public function getQuestionOptionsListAttribute()
    {
        return $this->questionType->questionOptions()->pluck('name', 'id');
    }
}
