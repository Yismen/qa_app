<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\Question;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class QuestionRepository implements QAAppRepositoryInterface
{
    public static function all(): Collection
    {
        return self::query()->get();
    }

    public static function list(): SupportCollection
    {
        return Question::orderBy('text')
            ->pluck('text', 'id');
    }

    public static function find(int $id)
    {
        return self::query()->findOrFail($id);
    }

    public static function query()
    {
        return Question::orderBy('form_id')->orderBy('question_type_id')->orderBy('points', 'DESC')
            ->with('questionType', 'form');
    }
}
