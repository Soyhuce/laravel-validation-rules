<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use function sprintf;

class DbEnum extends CompoundRule
{
    /**
     * @param array<string> $values
     */
    public function __construct(array $values)
    {
        parent::__construct([
            'string',
            sprintf('in:%s', implode(',', $values)),
        ]);
    }
}
