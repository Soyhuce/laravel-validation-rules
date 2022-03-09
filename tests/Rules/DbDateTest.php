<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbDate;

/**
 * @coversNothing
 */
class DbDateTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates('2018-11-06', new DbDate());
        $this->assertValidates('0001-01-01', new DbDate());
        $this->assertNotValidates('2018/11/06', new DbDate());
        $this->assertNotValidates('06-11-2018', new DbDate());
        $this->assertNotValidates('2018-11-6', new DbDate());
        $this->assertNotValidates('0000-00-00', new DbDate());
        $this->assertNotValidates('0001-00-00', new DbDate());
        $this->assertNotValidates('2018-00-00', new DbDate());

        $this->assertNotValidates([], new DbDate());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbDate());
        $this->assertNotValidates('foo', new DbDate());

        $this->assertValidates(null, ['nullable', new DbDate()]);
        $this->assertNotValidates(null, ['required', new DbDate()]);
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            '06-11-2018',
            new DbDate(),
            [trans('validation.date_format', ['attribute' => 'test', 'format' => 'Y-m-d'])]
        );
        $this->assertFailsWithMessage(
            '0000-00-00',
            new DbDate(),
            [trans('validation.date_format', ['attribute' => 'test', 'format' => 'Y-m-d'])]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates('2018-11-06', DbRules::date());
    }
}
