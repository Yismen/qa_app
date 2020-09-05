<?php

namespace Dainsys\QAApp\Tests;

use Dainsys\Components\ComponentsServiceProvider;
use Dainsys\QAApp\QAAppServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\UiServiceProvider;
use Orchestra\Testbench\TestCase;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Dainsys\Locky\LockyServiceProvider;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Spatie\Permission\PermissionServiceProvider;

class AppTestCase extends TestCase
{
    /**
     * Executed before each test.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->app->bind('App\User', function () {
            return MockUser::class;
        });

        $this->withFactories(__DIR__ . '/../database/factories');
        $this->withFactories(__DIR__ . '/factories');
        $this->loadLaravelMigrations();
        $this->artisan('migrate');

        Auth::routes();
    }

    public function getPackageProviders($app)
    {
        return [
            PermissionServiceProvider::class,
            LockyServiceProvider::class,
            UiServiceProvider::class,
            ComponentsServiceProvider::class,
            QAAppServiceProvider::class,
        ];
    }

    public function user()
    {
        return factory(app('App\User'))->create();
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
