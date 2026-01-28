<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\Rules\Database\DatabaseRange;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Exceptions\Unimplemented;
use Soyhuce\Rules\Rules\DbDouble;
use function sprintf;

#[CoversNothing]
class DbDoubleTest extends RuleTestCase
{
    #[Test]
    public function theRuleIsNotImplemented(): void
    {
        $this->expectException(Unimplemented::class);
        $this->expectExceptionMessage(sprintf('Method %s::double is not yet implemented', DatabaseRange::class));

        $this->assertValidates(10, new DbDouble());
    }

    #[Test]
    public function helperCanBeUsed(): void
    {
        $this->expectException(Unimplemented::class);
        $this->expectExceptionMessage(sprintf('Method %s::double is not yet implemented', DatabaseRange::class));

        $this->assertValidates(10, DbRules::double());
    }
}
