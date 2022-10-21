<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Validator;
use Soyhuce\Rules\Tests\TestCase;

/**
 * @coversNothing
 */
class RuleTestCase extends TestCase
{
    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function makeValidator($value, $rule)
    {
        return Validator::make(['test' => $value], ['test' => $rule]);
    }

    protected function validates($value, $rule)
    {
        return $this->makeValidator($value, $rule)->passes();
    }

    protected function assertValidates($value, $rule): void
    {
        if (!$this->validates($value, $rule)) {
            dump(tap($this->makeValidator($value, $rule), static function (ValidatorContract $validator): void {
                $validator->passes();
            })
                ->getMessageBag()
                ->get('test'));
        }
        $this->assertTrue($this->validates($value, $rule));
    }

    protected function assertNotValidates($value, $rule): void
    {
        $this->assertFalse($this->validates($value, $rule));
    }

    protected function assertFailsWithMessage($value, $rule, $messages): void
    {
        $this->assertEquals(
            $messages,
            tap($this->makeValidator($value, $rule), static function (ValidatorContract $validator): void {
                $validator->passes();
            })
                ->getMessageBag()
                ->get('test')
        );
    }
}
