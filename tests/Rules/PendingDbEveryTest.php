<?php declare(strict_types=1);

namespace Rules;

use Illuminate\Validation\Rule;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\Every;
use Soyhuce\Rules\Tests\Rules\RuleTestCase;

/**
 * @covers \Soyhuce\Rules\Rules\PendingDbEvery
 */
class PendingDbEveryTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates([10], DbRules::every()->unsignedTinyInteger());
        $this->assertValidates([0, 10], DbRules::every()->unsignedTinyInteger());
        $this->assertValidates(range(0, 255), DbRules::every()->unsignedTinyInteger());

        $this->assertNotValidates([-1], DbRules::every()->unsignedTinyInteger());
        $this->assertNotValidates([256, 0, 10], DbRules::every()->unsignedTinyInteger());

        $this->assertValidates(
            ['foo@email.com', 'bar@email.com', 'baz@email.com'],
            new Every(['required', 'string', 'email'])
        );
        $this->assertNotValidates(
            ['foo@email.com', 'bar@email.com', 'baz@email.com', 3],
            new Every(['required', 'string', 'email'])
        );

        $this->assertValidates(null, ['nullable', 'array', DbRules::every()->unsignedTinyInteger()]);
        $this->assertNotValidates(null, ['required', 'array', DbRules::every()->unsignedTinyInteger()]);
    }

    /**
     * @test
     */
    public function itDoesNotRunDatabaseValidationIfValueIsNotCorrect(): void
    {
        $this->assertNotValidates(
            [1, 2, -1],
            [
                'required',
                'array',
                DbRules::every()->unsignedTinyInteger(),
                Rule::exists('users', 'id'),
            ]
        );
    }
}
