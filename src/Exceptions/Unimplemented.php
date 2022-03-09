<?php declare(strict_types=1);

namespace Soyhuce\Rules\Exceptions;

use Exception;

class Unimplemented extends Exception
{
    public function __construct(string $class, string $method)
    {
        parent::__construct("Method {$class}::{$method} is not yet implemented");
    }
}
