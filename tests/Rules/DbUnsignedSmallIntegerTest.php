<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbUnsignedSmallInteger;

#[CoversNothing]
class DbUnsignedSmallIntegerTest extends RuleTestCase
{
    #[Test]
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbUnsignedSmallInteger());
        $this->assertValidates(0, new DbUnsignedSmallInteger());
        $this->assertValidates(65535, new DbUnsignedSmallInteger());
        $this->assertNotValidates(-1, new DbUnsignedSmallInteger());
        $this->assertNotValidates(65536, new DbUnsignedSmallInteger());

        $this->assertNotValidates([], new DbUnsignedSmallInteger());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbUnsignedSmallInteger());
        $this->assertNotValidates('foo', new DbUnsignedSmallInteger());

        $this->assertValidates(null, ['nullable', new DbUnsignedSmallInteger()]);
        $this->assertNotValidates(null, ['required', new DbUnsignedSmallInteger()]);
    }

    #[Test]
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            -1,
            new DbUnsignedSmallInteger(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '0'])]
        );
        $this->assertFailsWithMessage(
            65536,
            new DbUnsignedSmallInteger(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '65535'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbUnsignedSmallInteger(),
            [trans('validation.integer', ['attribute' => 'test'])]
        );
    }

    #[Test]
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::unsignedSmallInteger());
    }

    #[Test]
    public function postgresRangeIsCorrect(): void
    {
        // TODO
        $this->assertTrue(true);
    }
}
