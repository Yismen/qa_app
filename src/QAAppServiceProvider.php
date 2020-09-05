<?php

namespace Dainsys\QAApp;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use phpDocumentor\Reflection\Types\This;

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

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/qa_app'),
        ]);

        // $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'timy');
        $this->registerGates();
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
}
