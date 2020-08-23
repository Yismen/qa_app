<?php

namespace Dainsys\QAApp\Models;

class Question extends BaseModel
{
    protected $table = 'qa_app_questions';

    protected $fillable = ['text', 'points', 'form_id', 'question_type_id'];
}
