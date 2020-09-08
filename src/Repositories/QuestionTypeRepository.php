<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\QuestionType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class QuestionTypeRepository implements QAAppRepositoryInterface
{
    public static function all(): Collection
    {
        return QuestionType::orderBy('name')
            ->with('questionOptions')
            ->get();
    }

    public static function list(): SupportCollection
    {
        return QuestionType::orderBy('name')->pluck('name', 'id');
    }
}
