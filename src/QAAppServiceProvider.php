<?php

namespace Dainsys\QAApp;

use Dainsys\QAApp\Http\Livewire\AdminDashboard;
use Dainsys\QAApp\Http\Livewire\FilterDashboardForm;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class QAAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'qa_app');
        $this->loadFactoriesFrom(__DIR__ . '/../database/factories');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'qa_app');

        $this->loadPublishables()
            ->registerComponents()
            ->registerGates();
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/dainsys_qa_app.php',
            'qa_app'
        );
    }

    protected function registerGates()
    {
        Gate::define('qa_app.is_admin', function () {
            return auth()->user()->hasAnyRole(config('qa_app.roles.admin'));
        });
        Gate::define('qa_app.is_auditor', function () {
            return auth()->user()->hasAnyRole(config('qa_app.roles.auditor'));
        });
        Gate::define('qa_app.is_user', function () {
            return auth()->user()->hasAnyRole(config('qa_app.roles.user'));
        });

        return $this;
    }

    protected function loadPublishables()
    {
        $this->publishes([
            __DIR__ . '/../config/dainsys_qa_app.php' => config_path('dainsys_qa_app.php'),
        ], 'qa_app.config');

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'qa_app.migrations');

        $this->publishes([
            __DIR__ . '/../resources/views/' => resource_path('views/vendor/qa_app'),
        ], 'qa_app.views');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/qa_app'),
        ], 'qa_app.lang');

        return $this;
    }

    protected function registerComponents()
    {
        Livewire::component('qa_app::admin-dashboard', AdminDashboard::class);
        Livewire::component('qa_app::filter-dashboard-form', FilterDashboardForm::class);

        return $this;
    }
}
