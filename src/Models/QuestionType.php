<?php

namespace Dainsys\QAApp\Models;

class QuestionType extends BaseModel
{
    protected $table = 'qa_app_question_types';

    protected $fillable = ['name'];

    public function questionOptions()
    {
        return $this->hasMany(QuestionOption::class);
    }
}
