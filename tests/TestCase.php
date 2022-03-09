<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Soyhuce\Rules\RulesServiceProvider;

/**
 * @coversNothing
 */
class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            RulesServiceProvider::class,
        ];
    }
}
