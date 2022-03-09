<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbSmallInteger;

/**
 * @coversNothing
 */
class DbSmallIntegerTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbSmallInteger());
        $this->assertValidates(-32768, new DbSmallInteger());
        $this->assertValidates(32767, new DbSmallInteger());
        $this->assertNotValidates(-32769, new DbSmallInteger());
        $this->assertNotValidates(32768, new DbSmallInteger());

        $this->assertNotValidates([], new DbSmallInteger());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbSmallInteger());
        $this->assertNotValidates('foo', new DbSmallInteger());

        $this->assertValidates(null, ['nullable', new DbSmallInteger()]);
        $this->assertNotValidates(null, ['required', new DbSmallInteger()]);
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            -32769,
            new DbSmallInteger(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '-32768'])]
        );
        $this->assertFailsWithMessage(
            32768,
            new DbSmallInteger(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '32767'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbSmallInteger(),
            [trans('validation.integer', ['attribute' => 'test'])]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::smallInteger());
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
