<?php

namespace TNM\Permissions\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as BaseTestCase;
use TNM\Permissions\PermissionsServiceProvider;

class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(realpath(__DIR__.'/../src/Database/migrations'));
        $this->loadMigrationsFrom(realpath(__DIR__.'/../src/Database/test_migrations'));

    }

    protected function getPackageProviders($app): array
    {
        return [
            PermissionsServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
    }
}