<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\Audit;
use Illuminate\Database\Eloquent\Collection;

class AuditRepository
{
    public static function all(): Collection
    {
        return self::query()->get();
    }

    public static function paginate($amount = 25)
    {
        return self::query()->paginate($amount);
    }

    public static function find(int $id)
    {
        return self::query()->findOrFail($id);
    }

    public static function query()
    {
        return Audit::orderBy('production_date', 'DESC')->orderBy('points')
            ->with('user', 'form');
    }
}
