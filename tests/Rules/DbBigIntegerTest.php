<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbBigInteger;

#[CoversNothing]
class DbBigIntegerTest extends RuleTestCase
{
    #[Test]
    public function theRuleCorrectlyValidates(): void
    {
        // -9223372036854775808 to 9223372036854775807
        $this->assertValidates(10, new DbBigInteger());
        $this->assertValidates(9_223_372_036_854_775_807, new DbBigInteger());
        $this->assertValidates('9223372036854775807', new DbBigInteger());
        $this->assertNotValidates('9223372036854775808', new DbBigInteger());

        $this->assertValidates(-9_223_372_036_854_775_807, new DbBigInteger());
        $this->assertValidates('-9223372036854775807', new DbBigInteger());
        $this->assertNotValidates('-9223372036854775808', new DbBigInteger());
    }

    #[Test]
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::bigInteger());
    }
}
