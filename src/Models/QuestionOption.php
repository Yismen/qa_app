<?php

namespace Dainsys\QAApp\Models;

class QuestionOption extends BaseModel
{
    protected $table = 'qa_app_question_options';

    protected $fillable = ['name', 'value', 'question_type_id'];
}
