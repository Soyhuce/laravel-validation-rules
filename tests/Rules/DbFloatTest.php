<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbFloat;

/**
 * @coversNothing
 */
class DbFloatTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(12.3, new DbFloat());
        $this->assertValidates('12.3', new DbFloat());
        $this->assertValidates(-3.4028234E38, new DbFloat());
        $this->assertValidates(3.4028234E38, new DbFloat());
        $this->assertNotValidates(-3.4028235E38, new DbFloat());
        $this->assertNotValidates(3.4028235E38, new DbFloat());

        $this->assertNotValidates([], new DbFloat());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbFloat());
        $this->assertNotValidates('foo', new DbFloat());

        $this->assertValidates(null, ['nullable', new DbFloat()]);
        $this->assertNotValidates(null, ['required', new DbFloat()]);
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            -3.4028235E38,
            new DbFloat(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '-3.4028234E+38'])]
        );
        $this->assertFailsWithMessage(
            3.4028235E38,
            new DbFloat(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '3.4028234E+38'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbFloat(),
            [trans('validation.numeric', ['attribute' => 'test'])]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10.2, DbRules::float());
    }
}
