<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbEnum;

/**
 * @coversNothing
 */
class DbEnumTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates('foo', new DbEnum(['foo', 'bar']));
        $this->assertValidates('bar', new DbEnum(['foo', 'bar']));

        $this->assertNotValidates('FOO', new DbEnum(['foo', 'bar']));
        $this->assertNotValidates('Foo', new DbEnum(['foo', 'bar']));
        $this->assertNotValidates('baz', new DbEnum(['foo', 'bar']));

        $this->assertNotValidates([], new DbEnum(['foo', 'bar']));
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbEnum(['foo', 'bar']));

        $this->assertValidates(null, ['nullable', new DbEnum(['foo', 'bar'])]);
        $this->assertNotValidates(null, ['required', new DbEnum(['foo', 'bar'])]);
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            'baz',
            new DbEnum(['foo', 'bar']),
            [trans('validation.in', ['attribute' => 'test'])]
        );
        $this->assertFailsWithMessage(
            [],
            new DbEnum(['foo', 'bar']),
            [
                trans('validation.string', ['attribute' => 'test']),
                trans('validation.in', ['attribute' => 'test']),
            ]
        );
        $this->assertFailsWithMessage(
            UploadedFile::fake()->create('file'),
            new DbEnum(['foo', 'bar']),
            [
                trans('validation.string', ['attribute' => 'test']),
                trans('validation.in', ['attribute' => 'test']),
            ]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates('foo', DbRules::enum(['foo', 'bar']));
    }
}
