<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Support\Facades\Validator;
use Soyhuce\Rules\MiscRules;
use Soyhuce\Rules\Rules\SafePassword;

/**
 * @coversNothing
 */
class SafePasswordTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates('aZ^012345678', new SafePassword());
        $this->assertValidates('012345678aZ^', new SafePassword());
        $this->assertValidates('\012345678aZ', new SafePassword());
        $this->assertValidates('#a012345678Z', new SafePassword());

        $this->assertNotValidates('#a0123456789', new SafePassword());
        $this->assertNotValidates('A?0123456789', new SafePassword());
        $this->assertNotValidates('A0123456789z', new SafePassword());
        $this->assertNotValidates('A&~"#[]()@{}z', new SafePassword());
        $this->assertValidates('A&~"#[]()@{}z1', new SafePassword());

        $this->assertNotValidates('A[]z1', new SafePassword());
        $this->assertNotValidates([], new SafePassword());
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            'A[]z1',
            new SafePassword(),
            [trans('validation.min.string', ['attribute' => 'test', 'min' => 12])],
        );
        $this->assertFailsWithMessage(
            [],
            new SafePassword(),
            [
                trans('validation.string', ['attribute' => 'test']),
                trans('validation.min.string', ['attribute' => 'test', 'min' => 12]),
                trans('validation.regex', ['attribute' => 'test']),
            ]
        );
        $this->assertFailsWithMessage(
            '#a0123456789',
            new SafePassword(),
            [trans('validation.regex', ['attribute' => 'test'])]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates('aZ^012345678', MiscRules::safePassword());
    }

    /**
     * @test
     */
    public function messagesCanBeOverrode(): void
    {
        $validator = Validator::make(
            ['test' => '123456789012'],
            ['test' => new SafePassword()],
            ['regex' => 'The :attribute must contain a lowercase, an uppercase, a digit and a special character.']
        );

        $this->assertFalse($validator->passes());
        $this->assertContains(
            'The test must contain a lowercase, an uppercase, a digit and a special character.',
            $validator->errors()->all()
        );
    }

    /**
     * @test
     */
    public function attributesCanBeOverrode(): void
    {
        $validator = Validator::make(
            ['test' => '123456789012'],
            ['test' => new SafePassword()],
            attributes: ['test' => 'password']
        );

        $this->assertFalse($validator->passes());
        $this->assertContains(
            trans('validation.regex', ['attribute' => 'password']),
            $validator->errors()->all()
        );
    }
}
