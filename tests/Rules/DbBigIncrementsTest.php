<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbBigIncrements;

#[CoversNothing]
class DbBigIncrementsTest extends RuleTestCase
{
    #[Test]
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbBigIncrements());
        $this->assertValidates(9_223_372_036_854_775_807, new DbBigIncrements());
        $this->assertValidates('9223372036854775807', new DbBigIncrements());
        $this->assertNotValidates('9223372036854775808', new DbBigIncrements());

        $this->assertValidates(1, new DbBigIncrements());
        $this->assertNotValidates(0, new DbBigIncrements());
    }

    #[Test]
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::bigIncrements());
    }
}
