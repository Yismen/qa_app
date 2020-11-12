<?php

namespace Dainsys\QAApp\Repositories\Dashboard;

use Illuminate\Database\Eloquent\Collection;

class Monthly extends AuditBaseRepository
{
    /**
     * Apply the query using specific parameters
     *
     * @return  Illuminate\Database\Eloquent\Collection;
     */
    public static function apply(int $periods = 8): Collection
    {
        return self::query('%Y-%m', now()->subMonths($periods < 0 ? 0 : $periods - 1)->startOfMonth(), 'month');
    }
}
