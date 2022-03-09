<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use Soyhuce\Rules\Database\DatabaseRange;

class DbUnsignedMediumInteger extends DbNumericRangeRule
{
    /**
     * @return array<int>
     */
    protected function range(DatabaseRange $databaseRange): array
    {
        return $databaseRange->unsignedMediumInteger();
    }

    protected function typeRule(): string
    {
        return 'integer';
    }
}
