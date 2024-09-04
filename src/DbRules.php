<?php declare(strict_types=1);

namespace Soyhuce\Rules;

use Soyhuce\Rules\Rules\DbBigIncrements;
use Soyhuce\Rules\Rules\DbBigInteger;
use Soyhuce\Rules\Rules\DbBoolean;
use Soyhuce\Rules\Rules\DbDate;
use Soyhuce\Rules\Rules\DbDateTime;
use Soyhuce\Rules\Rules\DbDouble;
use Soyhuce\Rules\Rules\DbEnum;
use Soyhuce\Rules\Rules\DbFloat;
use Soyhuce\Rules\Rules\DbIncrements;
use Soyhuce\Rules\Rules\DbInteger;
use Soyhuce\Rules\Rules\DbMediumIncrements;
use Soyhuce\Rules\Rules\DbMediumInteger;
use Soyhuce\Rules\Rules\DbSmallIncrements;
use Soyhuce\Rules\Rules\DbSmallInteger;
use Soyhuce\Rules\Rules\DbString;
use Soyhuce\Rules\Rules\DbTinyInteger;
use Soyhuce\Rules\Rules\DbUnsignedBigInteger;
use Soyhuce\Rules\Rules\DbUnsignedInteger;
use Soyhuce\Rules\Rules\DbUnsignedMediumInteger;
use Soyhuce\Rules\Rules\DbUnsignedSmallInteger;
use Soyhuce\Rules\Rules\DbUnsignedTinyInteger;
use Soyhuce\Rules\Rules\PendingDbEvery;

class DbRules
{
    public static function string(int $max = 255): DbString
    {
        return new DbString($max);
    }

    public static function boolean(): DbBoolean
    {
        return new DbBoolean();
    }

    /**
     * @param array<string> $values
     */
    public static function enum(array $values): DbEnum
    {
        return new DbEnum($values);
    }

    public static function date(): DbDate
    {
        return new DbDate();
    }

    public static function dateTime(): DbDateTime
    {
        return new DbDateTime();
    }

    public static function tinyInteger(?int $min = null, ?int $max = null): DbTinyInteger
    {
        return new DbTinyInteger($min, $max);
    }

    public static function unsignedTinyInteger(?int $min = null, ?int $max = null): DbUnsignedTinyInteger
    {
        return new DbUnsignedTinyInteger($min, $max);
    }

    public static function smallInteger(?int $min = null, ?int $max = null): DbSmallInteger
    {
        return new DbSmallInteger($min, $max);
    }

    public static function unsignedSmallInteger(?int $min = null, ?int $max = null): DbUnsignedSmallInteger
    {
        return new DbUnsignedSmallInteger($min, $max);
    }

    public static function mediumInteger(?int $min = null, ?int $max = null): DbMediumInteger
    {
        return new DbMediumInteger($min, $max);
    }

    public static function unsignedMediumInteger(?int $min = null, ?int $max = null): DbUnsignedMediumInteger
    {
        return new DbUnsignedMediumInteger($min, $max);
    }

    public static function integer(?int $min = null, ?int $max = null): DbInteger
    {
        return new DbInteger($min, $max);
    }

    public static function unsignedInteger(?int $min = null, ?int $max = null): DbUnsignedInteger
    {
        return new DbUnsignedInteger($min, $max);
    }

    public static function bigInteger(?int $min = null, ?int $max = null): DbBigInteger
    {
        return new DbBigInteger($min, $max);
    }

    public static function unsignedBigInteger(?int $min = null, ?int $max = null): DbUnsignedBigInteger
    {
        return new DbUnsignedBigInteger($min, $max);
    }

    public static function smallIncrements(?int $min = null, ?int $max = null): DbSmallIncrements
    {
        return new DbSmallIncrements($min, $max);
    }

    public static function mediumIncrements(?int $min = null, ?int $max = null): DbMediumIncrements
    {
        return new DbMediumIncrements($min, $max);
    }

    public static function increments(?int $min = null, ?int $max = null): DbIncrements
    {
        return new DbIncrements($min, $max);
    }

    public static function bigIncrements(?int $min = null, ?int $max = null): DbBigIncrements
    {
        return new DbBigIncrements($min, $max);
    }

    public static function float(?float $min = null, ?float $max = null): DbFloat
    {
        return new DbFloat($min, $max);
    }

    public static function double(?float $min = null, ?float $max = null): DbDouble
    {
        return new DbDouble($min, $max);
    }

    public static function every(): PendingDbEvery
    {
        return new PendingDbEvery();
    }
}
