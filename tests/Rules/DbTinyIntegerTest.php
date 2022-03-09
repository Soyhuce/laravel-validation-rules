<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbTinyInteger;

/**
 * @coversNothing
 */
class DbTinyIntegerTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbTinyInteger());
        $this->assertValidates(-128, new DbTinyInteger());
        $this->assertValidates(127, new DbTinyInteger());
        $this->assertNotValidates(-129, new DbTinyInteger());
        $this->assertNotValidates(128, new DbTinyInteger());

        $this->assertNotValidates([], new DbTinyInteger());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbTinyInteger());
        $this->assertNotValidates('foo', new DbTinyInteger());

        $this->assertValidates(null, ['nullable', new DbTinyInteger()]);
        $this->assertNotValidates(null, ['required', new DbTinyInteger()]);
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            -129,
            new DbTinyInteger(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '-128'])]
        );
        $this->assertFailsWithMessage(
            128,
            new DbTinyInteger(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '127'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbTinyInteger(),
            [trans('validation.integer', ['attribute' => 'test'])]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::tinyInteger());
    }
}
