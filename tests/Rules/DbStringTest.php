<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbString;

/**
 * @coversNothing
 */
class DbStringTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates('foo', new DbString());
        $this->assertValidates('foo', (new DbString(10)));

        $this->assertValidates(str_repeat('a', 255), new DbString());
        $this->assertNotValidates(str_repeat('a', 256), new DbString());
        $this->assertValidates('foo', (new DbString(3)));
        $this->assertNotValidates('foo', (new DbString(2)));

        $this->assertNotValidates([], new DbString());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbString());

        $this->assertValidates(null, ['nullable', new DbString()]);
        $this->assertNotValidates(null, ['required', new DbString()]);
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            str_repeat('a', 256),
            new DbString(),
            [trans('validation.max.string', ['attribute' => 'test', 'max' => '255'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbString(2),
            [trans('validation.max.string', ['attribute' => 'test', 'max' => '2'])]
        );
        $this->assertFailsWithMessage(
            [],
            new DbString(),
            [trans('validation.string', ['attribute' => 'test'])]
        );
        $this->assertFailsWithMessage(
            UploadedFile::fake()->create('file'),
            new DbString(),
            [trans('validation.string', ['attribute' => 'test'])]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates('foo', DbRules::string());
        $this->assertNotValidates('foo', DbRules::string(2));
    }
}
