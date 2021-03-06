<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\QuestionType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class QuestionTypeRepository implements QAAppRepositoryInterface
{
    public static function all(): Collection
    {
        return self::query()->get();
    }

    public static function list(): SupportCollection
    {
        return QuestionType::orderBy('name')->pluck('name', 'id');
    }

    public static function find(int $id)
    {
        return self::query()->findOrFail($id);
    }

    public static function query()
    {
        return QuestionType::orderBy('name')
            ->with('questionOptions');
    }
}
