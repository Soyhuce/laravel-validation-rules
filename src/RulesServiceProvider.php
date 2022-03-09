<?php declare(strict_types=1);

namespace Soyhuce\Rules;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Soyhuce\Rules\Commands\RulesCommand;

class RulesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-validation-rules')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-validation-rules_table')
            ->hasCommand(RulesCommand::class);
    }
}
