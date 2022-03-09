<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use Soyhuce\Rules\Database\DatabaseRange;

class DbUnsignedInteger extends DbNumericRangeRule
{
    /**
     * @return array<int>
     */
    protected function range(DatabaseRange $databaseRange): array
    {
        return $databaseRange->unsignedInteger();
    }

    protected function typeRule(): string
    {
        return 'integer';
    }
}
