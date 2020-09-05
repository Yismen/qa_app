<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\QuestionOption;

class QuestionOptionRepository
{
    public static function all()
    {
        return QuestionOption::orderBy('question_type_id')->orderBy('name')
            ->with('questionType')
            ->get();
    }
}
