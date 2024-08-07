<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use Soyhuce\Rules\Concerns\DatabaseRelatedRule;

class DbBoolean extends CompoundRule
{
    use DatabaseRelatedRule;

    public function __construct()
    {
        parent::__construct([
            'in:' . implode(',', $this->booleans()->all()),
        ]);
    }
}
