<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

class DbDateTime extends CompoundRule
{
    public function __construct()
    {
        parent::__construct(['string', 'date_format:Y-m-d H:i:s']);
    }
}
