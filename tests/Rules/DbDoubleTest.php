<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Soyhuce\Rules\Database\DatabaseRange;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Exceptions\Unimplemented;
use Soyhuce\Rules\Rules\DbDouble;
use function sprintf;

/**
 * @coversNothing
 */
class DbDoubleTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleIsNotImplemented(): void
    {
        $this->expectException(Unimplemented::class);
        $this->expectExceptionMessage(sprintf('Method %s::double is not yet implemented', DatabaseRange::class));

        $this->assertValidates(10, new DbDouble());
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->expectException(Unimplemented::class);
        $this->expectExceptionMessage(sprintf('Method %s::double is not yet implemented', DatabaseRange::class));

        $this->assertValidates(10, DbRules::double());
    }
}
