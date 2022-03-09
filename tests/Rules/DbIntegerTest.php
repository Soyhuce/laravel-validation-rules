<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbInteger;

/**
 * @coversNothing
 */
class DbIntegerTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbInteger());
        $this->assertValidates(-2147483648, new DbInteger());
        $this->assertValidates(2147483647, new DbInteger());
        $this->assertNotValidates(-2147483649, new DbInteger());
        $this->assertNotValidates(2147483648, new DbInteger());

        $this->assertNotValidates([], new DbInteger());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbInteger());
        $this->assertNotValidates('foo', new DbInteger());

        $this->assertValidates(null, ['nullable', new DbInteger()]);
        $this->assertNotValidates(null, ['required', new DbInteger()]);
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            -2147483649,
            new DbInteger(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '-2147483648'])]
        );
        $this->assertFailsWithMessage(
            2147483648,
            new DbInteger(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '2147483647'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbInteger(),
            [trans('validation.integer', ['attribute' => 'test'])]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::integer());
    }
}
