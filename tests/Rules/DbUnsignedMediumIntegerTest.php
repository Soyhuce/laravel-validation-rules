<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbUnsignedMediumInteger;

/**
 * @coversNothing
 */
class DbUnsignedMediumIntegerTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbUnsignedMediumInteger());
        $this->assertValidates(0, new DbUnsignedMediumInteger());
        $this->assertValidates(16_777_215, new DbUnsignedMediumInteger());
        $this->assertNotValidates(-1, new DbUnsignedMediumInteger());
        $this->assertNotValidates(16_777_216, new DbUnsignedMediumInteger());

        $this->assertNotValidates([], new DbUnsignedMediumInteger());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbUnsignedMediumInteger());
        $this->assertNotValidates('foo', new DbUnsignedMediumInteger());

        $this->assertValidates(null, ['nullable', new DbUnsignedMediumInteger()]);
        $this->assertNotValidates(null, ['required', new DbUnsignedMediumInteger()]);
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            -1,
            new DbUnsignedMediumInteger(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '0'])]
        );
        $this->assertFailsWithMessage(
            16_777_216,
            new DbUnsignedMediumInteger(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '16777215'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbUnsignedMediumInteger(),
            [trans('validation.integer', ['attribute' => 'test'])]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::unsignedMediumInteger());
    }
}
