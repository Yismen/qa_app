<?php

namespace Dainsys\QAApp\Repositories\Dashboard;

use Dainsys\QAApp\Charts\AuditChart;
use Illuminate\Database\Eloquent\Collection;

class Weekly extends AuditBaseRepository
{
    public static function apply(int $periods = 8): Collection
    {
        return self::query('%Y-%v', now()->subWeeks($periods < 0 ? 0 : $periods - 1)->startOfWeek(), 'week');
    }

    public static function chart(): AuditChart
    {
        $data = self::apply();

        $chart = new AuditChart;
        $chart->labels($data->pluck('week')->toArray());

        $chart->dataset(__('qa_app::messages.weekly_goal'), 'line', $data->pluck('avg_points_goal'))
            ->color(self::$dataset_colors['goal']['line'])
            ->backgroundColor(self::$dataset_colors['goal']['background']);

        $chart->dataset(__('qa_app::messages.weekly_result'), 'line', $data->pluck('avg_points'))
            ->fill(false)
            ->color(self::$dataset_colors['result']['line'])
            ->backgroundColor(self::$dataset_colors['result']['background']);

        $chart->options(
            self::$chart_options
        );

        $chart->title(__('qa_app::messages.weekly_title'));

        return $chart;
    }
}
