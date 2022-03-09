<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use Soyhuce\Rules\Database\DatabaseRange;

class DbIncrements extends DbNumericRangeRule
{
    /**
     * @return array<int>
     */
    protected function range(DatabaseRange $databaseRange): array
    {
        return $databaseRange->increments();
    }

    protected function typeRule(): string
    {
        return 'integer';
    }
}
