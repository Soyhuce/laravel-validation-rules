<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use Soyhuce\Rules\Database\DatabaseRange;

class DbFloat extends DbNumericRangeRule
{
    /**
     * @return array<float>
     */
    protected function range(DatabaseRange $databaseRange): array
    {
        return $databaseRange->float();
    }

    protected function typeRule(): string
    {
        return 'numeric';
    }
}
