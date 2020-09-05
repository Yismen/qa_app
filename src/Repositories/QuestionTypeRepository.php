<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\QuestionType;

class QuestionTypeRepository
{
    public static function all()
    {
        return QuestionType::orderBy('name')
            ->with('questionOptions')
            ->get();
    }
}
