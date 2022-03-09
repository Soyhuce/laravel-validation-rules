<?php declare(strict_types=1);

namespace Soyhuce\Rules;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Soyhuce\Rules\Database\DatabaseBoolean;
use Soyhuce\Rules\Database\DatabaseRange;

class RulesServiceProvider extends IlluminateServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(DatabaseBoolean::class, fn () => new DatabaseBoolean());
        $this->app->singleton(DatabaseRange::class, fn () => new DatabaseRange());
    }

    /**
     * @return array<string>
     */
    public function provides(): array
    {
        return [
            DatabaseBoolean::class,
            DatabaseRange::class,
        ];
    }
}
