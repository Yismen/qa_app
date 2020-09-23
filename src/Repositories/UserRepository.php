<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class UserRepository implements QAAppRepositoryInterface
{
    public static function all(): Collection
    {
        return self::query()->get();
    }

    public static function list(): SupportCollection
    {
        return resolve('App\User')::orderBy('name')
            ->pluck('name', 'id');
    }

    public static function find(int $id)
    {
        return self::query()->findOrFail($id);
    }

    public static function query()
    {
        return resolve('Ap\User')::orderBy('name')
            ->with('questions');
    }
}
