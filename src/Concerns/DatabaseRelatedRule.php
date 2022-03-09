<?php declare(strict_types=1);

namespace Soyhuce\Rules\Concerns;

use Soyhuce\Rules\Database\DatabaseBoolean;
use Soyhuce\Rules\Database\DatabaseRange;

trait DatabaseRelatedRule
{
    protected function ranges(): DatabaseRange
    {
        return app(DatabaseRange::class);
    }

    protected function booleans(): DatabaseBoolean
    {
        return app(DatabaseBoolean::class);
    }
}
