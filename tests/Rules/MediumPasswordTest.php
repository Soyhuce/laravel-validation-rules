<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Soyhuce\Rules\MiscRules;
use Soyhuce\Rules\Rules\MediumPassword;

/**
 * @coversNothing
 */
class MediumPasswordTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates('aZ^01234', new MediumPassword());
        $this->assertValidates('Z^012345', new MediumPassword());
        $this->assertValidates('^Z012345', new MediumPassword());
        $this->assertValidates('012345^Z', new MediumPassword());
        $this->assertValidates('a^012345', new MediumPassword());
        $this->assertValidates('aZ012345', new MediumPassword());

        $this->assertNotValidates('01234567', new MediumPassword());
        $this->assertNotValidates('azertyui', new MediumPassword());
        $this->assertNotValidates('AZERTYUI', new MediumPassword());
        $this->assertNotValidates('&~"#[]()', new MediumPassword());
        $this->assertNotValidates('a0123456', new MediumPassword());
        $this->assertNotValidates('A0123456', new MediumPassword());
        $this->assertNotValidates('^0123456', new MediumPassword());
        $this->assertNotValidates('A&~"#[]()@{}', new MediumPassword());
        $this->assertNotValidates('a&~"#[]()@{}', new MediumPassword());
        $this->assertNotValidates('Azertyui', new MediumPassword());

        $this->assertNotValidates('A[]z1', new MediumPassword());
        $this->assertNotValidates([], new MediumPassword());
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            'A[]z1',
            new MediumPassword(),
            [trans('validation.min.string', ['attribute' => 'test', 'min' => 8])]
        );
        $this->assertFailsWithMessage(
            [],
            new MediumPassword(),
            [
                trans('validation.string', ['attribute' => 'test']),
                trans('validation.min.string', ['attribute' => 'test', 'min' => 8]),
                trans('validation.regex', ['attribute' => 'test']),
            ]
        );
        $this->assertFailsWithMessage(
            'a0123456',
            new MediumPassword(),
            [trans('validation.regex', ['attribute' => 'test'])]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates('aZ^012345678', MiscRules::mediumPassword());
    }
}
