<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbUnsignedTinyInteger;

#[CoversNothing]
class DbUnsignedTinyIntegerTest extends RuleTestCase
{
    #[Test]
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbUnsignedTinyInteger());
        $this->assertValidates(0, new DbUnsignedTinyInteger());
        $this->assertValidates(255, new DbUnsignedTinyInteger());
        $this->assertNotValidates(-1, new DbUnsignedTinyInteger());
        $this->assertNotValidates(256, new DbUnsignedTinyInteger());

        $this->assertNotValidates([], new DbUnsignedTinyInteger());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbUnsignedTinyInteger());
        $this->assertNotValidates('foo', new DbUnsignedTinyInteger());

        $this->assertValidates(null, ['nullable', new DbUnsignedTinyInteger()]);
        $this->assertNotValidates(null, ['required', new DbUnsignedTinyInteger()]);
    }

    #[Test]
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            -1,
            new DbUnsignedTinyInteger(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '0'])]
        );
        $this->assertFailsWithMessage(
            256,
            new DbUnsignedTinyInteger(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '255'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbUnsignedTinyInteger(),
            [trans('validation.integer', ['attribute' => 'test'])]
        );
    }

    #[Test]
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::unsignedTinyInteger());
    }
}
