<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use Soyhuce\Rules\Concerns\DatabaseRelatedRule;
use Soyhuce\Rules\Concerns\HasRange;
use Soyhuce\Rules\Database\DatabaseRange;

abstract class DbNumericRangeRule extends CompoundRule
{
    use DatabaseRelatedRule;
    use HasRange;

    public function __construct(int|float|null $min = null, int|float|null $max = null)
    {
        [$theoreticalMin, $theoreticalMax] = $this->range($this->ranges());

        $min = $this->min($min, $theoreticalMin);
        $max = $this->max($max, $theoreticalMax);

        parent::__construct([
            $this->typeRule(),
            "min:{$min}",
            "max:{$max}",
        ]);
    }

    /**
     * @return array<float|int>
     */
    abstract protected function range(DatabaseRange $databaseRange): array;

    abstract protected function typeRule(): string;
}
