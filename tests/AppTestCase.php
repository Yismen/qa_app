<?php

namespace Dainsys\QAApp\Tests;

use Dainsys\QAApp\QAAppServiceProvider;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\UiServiceProvider;
use Orchestra\Testbench\TestCase;

class AppTestCase extends TestCase
{
    /**
     * Executed before each test.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__ . '/../database/factories');
        // $this->withFactories(database_path('/factories'));
        $this->loadLaravelMigrations();
        $this->artisan('migrate');

        Auth::routes();
    }

    public function getPackageProviders($app)
    {
        return [
            UiServiceProvider::class,
            QAAppServiceProvider::class,
        ];
    }

    public function user()
    {
        return factory(User::class)->create();
    }

    public function make($model, array $attributes = [], $amount = null)
    {
        return factory($model, $amount)->make($attributes)->toArray();
    }

    public function create($model, array $attributes = [], $amount = null)
    {
        return factory($model, $amount)->create($attributes);
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
