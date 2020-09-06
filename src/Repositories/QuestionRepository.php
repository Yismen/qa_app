<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\Question;

class QuestionRepository
{
    public static function all()
    {
        return Question::orderBy('form_id')->orderBy('question_type_id')->orderBy('text')
            ->with('questionType', 'form')
            ->get();
    }
}
