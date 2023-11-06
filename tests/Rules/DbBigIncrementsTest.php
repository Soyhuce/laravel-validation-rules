<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbBigIncrements;

/**
 * @coversNothing
 */
class DbBigIncrementsTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbBigIncrements());
        $this->assertValidates(9_223_372_036_854_775_807, new DbBigIncrements());
        $this->assertValidates('9223372036854775807', new DbBigIncrements());
        $this->assertNotValidates('9223372036854775808', new DbBigIncrements());

        $this->assertValidates(1, new DbBigIncrements());
        $this->assertNotValidates(0, new DbBigIncrements());
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::bigIncrements());
    }
}
