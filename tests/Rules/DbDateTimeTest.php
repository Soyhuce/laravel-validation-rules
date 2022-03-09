<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbDateTime;

/**
 * @coversNothing
 */
class DbDateTimeTest extends RuleTestCase
{
    /**
     * @test
     */
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates('2018-11-06 14:30:36', new DbDateTime());
        $this->assertValidates('0001-01-01 00:00:00', new DbDateTime());
        $this->assertNotValidates('2018-11-06', new DbDateTime());
        $this->assertNotValidates('2018/11/06 14:30:36', new DbDateTime());
        $this->assertNotValidates('2018-11-06 1:2:3', new DbDateTime());

        $this->assertNotValidates([], new DbDateTime());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbDateTime());
        $this->assertNotValidates('foo', new DbDateTime());

        $this->assertValidates(null, ['nullable', new DbDateTime()]);
        $this->assertNotValidates(null, ['required', new DbDateTime()]);
    }

    /**
     * @test
     */
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            '06-11-2018',
            new DbDateTime(),
            [trans('validation.date_format', ['attribute' => 'test', 'format' => 'Y-m-d H:i:s'])]
        );
        $this->assertFailsWithMessage(
            '0000-00-00 00:00:00',
            new DbDateTime(),
            [trans('validation.date_format', ['attribute' => 'test', 'format' => 'Y-m-d H:i:s'])]
        );
    }

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates('2018-11-06 14:30:36', DbRules::dateTime());
    }
}
