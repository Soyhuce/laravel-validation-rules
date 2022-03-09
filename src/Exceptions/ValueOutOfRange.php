<?php declare(strict_types=1);

namespace Soyhuce\Rules\Exceptions;

use Exception;

class ValueOutOfRange extends Exception
{
    public static function min(int|float $expectedMin, int|float $actualMin): self
    {
        return new self("Given value is out of range : expecting min {$expectedMin}, having {$actualMin}");
    }

    public static function max(int|float $expectedMax, int|float $actualMax): self
    {
        return new self("Given value is out of range : expecting max {$expectedMax}, having {$actualMax}");
    }
}
