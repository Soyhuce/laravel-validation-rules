<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Soyhuce\Rules\Rules\CompoundRule;

/**
 * @covers \Soyhuce\Rules\Rules\CompoundRule
 */
class CompoundRuleTest extends RuleTestCase
{
    /**
     * @test
     */
    public function indexesArraysAreCorrectlyValidated(): void
    {
        $rule = new class() extends CompoundRule {
            public function __construct()
            {
                parent::__construct(['string', 'max:10']);
            }
        };

        $validator = Validator::make(
            ['foo' => ['bar' => 'this string is too long']],
            ['foo.bar' => [$rule]]
        );

        $this->assertFalse($validator->passes());
    }

    /**
     * @test
     */
    public function typesAreCorrectlyInferred(): void
    {
        $rule = new class() extends CompoundRule {
            public function __construct()
            {
                parent::__construct(['required', 'integer']);
            }
        };

        $validator = Validator::make(
            ['foo' => 120],
            ['foo' => [$rule, 'max:10']]
        );

        $this->assertFalse($validator->passes());
    }

    /**
     * @test
     */
    public function compoundRulesCanBeUsedInConditionalRule(): void
    {
        $rule = new class() extends CompoundRule {
            public function __construct()
            {
                parent::__construct(['required', 'integer']);
            }
        };

        $validator = Validator::make(
            ['foo' => 120],
            ['foo' => Rule::when(true, [...$rule])]
        );

        $this->assertTrue($validator->passes());
    }
}
