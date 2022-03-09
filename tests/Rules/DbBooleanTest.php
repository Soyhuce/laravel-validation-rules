<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Soyhuce\Rules\Database\DatabaseBoolean;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbBoolean;

/**
 * @coversNothing
 */
class DbBooleanTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(0, new DbBoolean());
        $this->assertValidates(1, new DbBoolean());
        $this->assertValidates('0', new DbBoolean());
        $this->assertValidates('1', new DbBoolean());
        $this->assertValidates(false, new DbBoolean());
        $this->assertValidates(true, new DbBoolean());
        $this->assertValidates('false', new DbBoolean());
        $this->assertValidates('true', new DbBoolean());

        $this->assertNotValidates([], new DbBoolean());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), Rule::in((new DatabaseBoolean())->all()));
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbBoolean());
        $this->assertNotValidates('foo', new DbBoolean());

        $this->assertValidates(null, ['nullable', new DbBoolean()]);
        $this->assertNotValidates(null, ['required', new DbBoolean()]);
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage('foo', new DbBoolean(), [trans('validation.boolean', ['attribute' => 'test'])]);

        trans()->addLines(['validation.attributes.test' => 'custom'], 'en');
        $this->assertFailsWithMessage('foo', new DbBoolean(), ['The custom field must be true or false.']);

        trans()->addLines(['validation.custom.test.boolean' => 'It should be a boolean.'], 'en');
        $this->assertFailsWithMessage('foo', new DbBoolean(), ['It should be a boolean.']);
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(true, DbRules::boolean());
    }
}
