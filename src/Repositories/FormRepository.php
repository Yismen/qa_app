<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\Form;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class FormRepository implements QAAppRepositoryInterface
{
    public static function all(): Collection
    {
        return Form::orderBy('name')
            ->with('questions')
            ->get();
    }

    public static function list(): SupportCollection
    {
        return Form::orderBy('name')
            ->pluck('name', 'id');
    }
}
