<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use ArrayIterator;
use Illuminate\Support\Arr;
use Illuminate\Validation\ConditionalRules;
use IteratorAggregate;

/**
 * @implements \IteratorAggregate<int, string>
 */
abstract class CompoundRule extends ConditionalRules implements IteratorAggregate
{
    /**
     * @param array<int, string> $rules
     */
    public function __construct(array $rules)
    {
        parent::__construct(true, $rules);
    }

    /**
     * @return ArrayIterator<int, string>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator(Arr::wrap($this->rules));
    }
}
