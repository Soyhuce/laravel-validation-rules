<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbUnsignedBigInteger;

/**
 * @coversNothing
 */
class DbUnsignedBigIntegerTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbUnsignedBigInteger());
        $this->assertValidates(9_223_372_036_854_775_807, new DbUnsignedBigInteger());
        $this->assertValidates('9223372036854775807', new DbUnsignedBigInteger());
        $this->assertNotValidates('9223372036854775808', new DbUnsignedBigInteger());

        $this->assertValidates(0, new DbUnsignedBigInteger());
        $this->assertNotValidates(-1, new DbUnsignedBigInteger());
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::unsignedBigInteger());
    }
}
