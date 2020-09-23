<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\Form;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class FormRepository implements QAAppRepositoryInterface
{
    public static function all(): Collection
    {
        return self::query()->get();
    }

    public static function list(): SupportCollection
    {
        return Form::orderBy('name')
            ->pluck('name', 'id');
    }

    public static function find(int $id)
    {
        return self::query()->findOrFail($id);
    }

    public static function query()
    {
        return Form::orderBy('name')
            ->with('questions');
    }
}
