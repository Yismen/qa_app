<?php

namespace Dainsys\QAApp\Repositories\Dashboard;

use Illuminate\Database\Eloquent\Collection;

class Weekly extends AuditBaseRepository
{
    public static function apply(int $periods = 8): Collection
    {
        return self::query('%Y-%v', now()->subWeeks($periods < 0 ? 0 : $periods - 1)->startOfWeek(), 'week');
    }
}
