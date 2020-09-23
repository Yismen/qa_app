<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\QuestionOption;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class QuestionOptionRepository implements QAAppRepositoryInterface
{
    public static function all(): Collection
    {
        return self::query()->get();
    }

    public static function list(): SupportCollection
    {
        return QuestionOption::orderBy('name')
            ->pluck('name', 'id');
    }

    public static function find(int $id)
    {
        return self::query()->findOrFail($id);
    }

    public static function query()
    {
        return QuestionOption::orderBy('question_type_id', 'DESC')->orderBy('value', 'DESC')
            ->with('questionType');
    }
}
