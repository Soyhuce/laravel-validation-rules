<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbSmallIncrements;

#[CoversNothing]
class DbSmallIncrementsTest extends RuleTestCase
{
    #[Test]
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbSmallIncrements());
        $this->assertValidates(1, new DbSmallIncrements());
        $this->assertValidates(65535, new DbSmallIncrements());
        $this->assertNotValidates(0, new DbSmallIncrements());
        $this->assertNotValidates(65536, new DbSmallIncrements());

        $this->assertNotValidates([], new DbSmallIncrements());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbSmallIncrements());
        $this->assertNotValidates('foo', new DbSmallIncrements());

        $this->assertValidates(null, ['nullable', new DbSmallIncrements()]);
        $this->assertNotValidates(null, ['required', new DbSmallIncrements()]);
    }

    #[Test]
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            0,
            new DbSmallIncrements(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '1'])]
        );
        $this->assertFailsWithMessage(
            65536,
            new DbSmallIncrements(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '65535'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbSmallIncrements(),
            [trans('validation.integer', ['attribute' => 'test'])]
        );
    }

    #[Test]
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::smallIncrements());
    }

    #[Test]
    public function postgresRangeIsCorrect(): void
    {
        // TODO
        $this->assertTrue(true);
    }
}
