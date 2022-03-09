<?php declare(strict_types=1);

namespace Soyhuce\Rules\Concerns;

use Soyhuce\Rules\Exceptions\ValueOutOfRange;

trait HasRange
{
    /**
     * @template T
     * @param T|null $min
     * @param T $theoreticalMin
     * @return T
     */
    public function min($min, $theoreticalMin)
    {
        if ($min === null) {
            return $theoreticalMin;
        }

        if ($min < $theoreticalMin) {
            throw ValueOutOfRange::min($theoreticalMin, $min);
        }

        return $min;
    }

    /**
     * @template T
     * @param T|null $max
     * @param T $theoreticalMax
     * @return T
     */
    public function max($max, $theoreticalMax)
    {
        if ($max === null) {
            return $theoreticalMax;
        }

        if ($max > $theoreticalMax) {
            throw ValueOutOfRange::max($theoreticalMax, $max);
        }

        return $max;
    }
}
