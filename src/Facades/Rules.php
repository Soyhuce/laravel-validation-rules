<?php declare(strict_types=1);

namespace Soyhuce\Rules\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Soyhuce\Rules\Rules
 */
class Rules extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-validation-rules';
    }
}
