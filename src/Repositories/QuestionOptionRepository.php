<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\QuestionOption;

class QuestionOptionRepository
{
    public static function all()
    {
        return QuestionOption::orderBy('question_type_id', 'DESC')->orderBy('value', 'DESC')
            ->with('questionType')
            ->get();
    }
}
