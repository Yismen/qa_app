<?php

namespace Dainsys\QAApp;

use Illuminate\Support\ServiceProvider;

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
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/dainsys_qa_app.php',
            'qa_app'
        );
    }
}
