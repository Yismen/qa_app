<?php

namespace Dainsys\QAApp\Repositories\Dashboard;

use Dainsys\QAApp\Charts\AuditChart;
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

    public static function chart(): AuditChart
    {
        $data = self::apply();
        $chart = new AuditChart;
        $chart->labels($data->pluck('month')->toArray());

        $chart->dataset(__('qa_app::messages.monthly_goal'), 'line', $data->pluck('avg_points_goal'))
            ->color(self::$dataset_colors['goal']['line'])
            ->backgroundColor(self::$dataset_colors['goal']['background']);

        $chart->dataset(__('qa_app::messages.monthly_result'), 'line', $data->pluck('avg_points'))
            ->fill(false)
            ->color(self::$dataset_colors['result']['line'])
            ->backgroundColor(self::$dataset_colors['result']['background']);

        $chart->title(__('qa_app::messages.monthly_title'));

        $chart->options(
            self::$chart_options
        );

        return $chart;
    }
}
