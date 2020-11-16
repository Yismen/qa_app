<?php

namespace Dainsys\QAApp\Repositories;

use App\User;
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
        return User::orderBy('name')
            ->role(config('qa_app.roles.user'))
            ->pluck('name', 'id');
    }

    public static function find(int $id)
    {
        return self::query()->findOrFail($id);
    }

    public static function query()
    {
        return User::orderBy('name')
            ->role(config('qa_app.roles.user'));
    }
}
