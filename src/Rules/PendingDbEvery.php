<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

class PendingDbEvery
{
    public function string(int $max = 255): Every
    {
        return new Every([new DbString($max)]);
    }

    public function boolean(): Every
    {
        return new Every([new DbBoolean()]);
    }

    /**
     * @param array<string> $values
     */
    public function enum(array $values): Every
    {
        return new Every([new DbEnum($values)]);
    }

    public function date(): Every
    {
        return new Every([new DbDate()]);
    }

    public function dateTime(): Every
    {
        return new Every([new DbDateTime()]);
    }

    public function tinyInteger(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbTinyInteger($min, $max)]);
    }

    public function unsignedTinyInteger(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbUnsignedTinyInteger($min, $max)]);
    }

    public function smallInteger(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbSmallInteger($min, $max)]);
    }

    public function unsignedSmallInteger(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbUnsignedSmallInteger($min, $max)]);
    }

    public function mediumInteger(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbMediumInteger($min, $max)]);
    }

    public function unsignedMediumInteger(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbUnsignedMediumInteger($min, $max)]);
    }

    public function integer(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbInteger($min, $max)]);
    }

    public function unsignedInteger(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbUnsignedInteger($min, $max)]);
    }

    public function bigInteger(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbBigInteger($min, $max)]);
    }

    public function unsignedBigInteger(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbUnsignedBigInteger($min, $max)]);
    }

    public function smallIncrements(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbSmallIncrements($min, $max)]);
    }

    public function mediumIncrements(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbMediumIncrements($min, $max)]);
    }

    public function increments(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbIncrements($min, $max)]);
    }

    public function bigIncrements(?int $min = null, ?int $max = null): Every
    {
        return new Every([new DbBigIncrements($min, $max)]);
    }

    public function float(?float $min = null, ?float $max = null): Every
    {
        return new Every([new DbFloat($min, $max)]);
    }

    public function double(?float $min = null, ?float $max = null): Every
    {
        return new Every([new DbDouble($min, $max)]);
    }
}
