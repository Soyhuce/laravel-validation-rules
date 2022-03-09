<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbUnsignedInteger;

/**
 * @coversNothing
 */
class DbUnsignedIntegerTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbUnsignedInteger());
        $this->assertValidates(0, new DbUnsignedInteger());
        $this->assertValidates(4294967295, new DbUnsignedInteger());
        $this->assertNotValidates(-1, new DbUnsignedInteger());
        $this->assertNotValidates(4294967296, new DbUnsignedInteger());

        $this->assertNotValidates([], new DbUnsignedInteger());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbUnsignedInteger());
        $this->assertNotValidates('foo', new DbUnsignedInteger());

        $this->assertValidates(null, ['nullable', new DbUnsignedInteger()]);
        $this->assertNotValidates(null, ['required', new DbUnsignedInteger()]);
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            -1,
            new DbUnsignedInteger(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '0'])]
        );
        $this->assertFailsWithMessage(
            4294967296,
            new DbUnsignedInteger(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '4294967295'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbUnsignedInteger(),
            [trans('validation.integer', ['attribute' => 'test'])]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::unsignedInteger());
    }

    /**
     * @test
     */
    public function postgresRangeIsCorrect(): void
    {
        // TODO
        $this->assertTrue(true);
    }
}
