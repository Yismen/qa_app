<?php

namespace Dainsys\QAApp\Repositories\Dashboard;

use Carbon\Carbon;
use Dainsys\QAApp\Charts\AuditChart;
use Dainsys\QAApp\Models\Audit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

abstract class AuditBaseRepository
{
    /**
     * Chartjs Chart Options
     *
     * @var array
     */
    protected static $chart_options = [
        'responsive' => true,
        'tooltips' => [
            'intersect' => false,
            'mode' => 'nearest'
        ],
    ];

    /**
     * Chart Common goal colors
     *
     * @var array
     */
    protected static $dataset_colors = [
        'goal' => [
            'line' => 'rgba(244,67,54,1)',
            'background' => 'rgba(244,67,54,.25)'
        ],
        'result' => [
            'line' => 'rgba(1,87,155 ,1)',
            'background' => 'rgba(1,87,155 ,.35)'
        ]
    ];
    /**
     * Build the Query
     *
     * @param string $format
     * @param Carbon $from
     * @param string $period_name
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function query(string $format, Carbon $from, string $period_name = 'period'): Collection
    {
        $query = self::getQuery($format, $from, $period_name);

        if ($audit_form = request('form_id')) {
            $query->where('form_id', $audit_form);
        }

        if ($audit_form = request('user_id')) {
            $query->where('user_id', $audit_form);
        }

        return $query->get();
    }

    /**
     * Abstract function child class must call.
     *
     * @return void
     */
    abstract public static function apply(int $periods = 8): Collection;

    /**
     * Abstract function child class must call.
     *
     * @return void
     */
    abstract public static function chart(): AuditChart;

    /**
     * Abstracted logic to build the query
     *
     * @param string $format
     * @param Carbon $from
     * @param string $period_name
     * @return Illuminate\Database\Eloquent\Builder
     */
    protected static function getQuery(string $format, Carbon $from, string $period_name): Builder
    {
        return Audit::query()
            ->select(
                DB::raw("
                    DATE_FORMAT(production_date, '{$format}') as {$period_name}, 
                    AVG(points) as avg_points,
                    AVG(points_goal) as avg_points_goal,
                    (AVG(points) / AVG(points_goal)) *100 as result
                ")
            )
            ->whereDate('production_date', '>=', $from)
            ->whereDate('production_date', '<=', now())
            ->groupBy($period_name)
            ->orderBy($period_name);
    }
}
