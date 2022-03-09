<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

class DbString extends CompoundRule
{
    public function __construct(int $max = 255)
    {
        parent::__construct([
            'string',
            "max:{$max}",
        ]);
    }
}
