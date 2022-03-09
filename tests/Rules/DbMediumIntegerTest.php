<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbMediumInteger;

/**
 * @coversNothing
 */
class DbMediumIntegerTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbMediumInteger());
        $this->assertValidates(-8388608, new DbMediumInteger());
        $this->assertValidates(8388607, new DbMediumInteger());
        $this->assertNotValidates(-8388609, new DbMediumInteger());
        $this->assertNotValidates(8388608, new DbMediumInteger());

        $this->assertNotValidates([], new DbMediumInteger());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbMediumInteger());
        $this->assertNotValidates('foo', new DbMediumInteger());

        $this->assertValidates(null, ['nullable', new DbMediumInteger()]);
        $this->assertNotValidates(null, ['required', new DbMediumInteger()]);
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            -8388609,
            new DbMediumInteger(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '-8388608'])]
        );
        $this->assertFailsWithMessage(
            8388608,
            new DbMediumInteger(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '8388607'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbMediumInteger(),
            [trans('validation.integer', ['attribute' => 'test'])]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::mediumInteger());
    }
}
