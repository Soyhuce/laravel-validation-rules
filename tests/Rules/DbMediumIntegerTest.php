<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbMediumInteger;

#[CoversNothing]
class DbMediumIntegerTest extends RuleTestCase
{
    #[Test]
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbMediumInteger());
        $this->assertValidates(-8_388_608, new DbMediumInteger());
        $this->assertValidates(8_388_607, new DbMediumInteger());
        $this->assertNotValidates(-8_388_609, new DbMediumInteger());
        $this->assertNotValidates(8_388_608, new DbMediumInteger());

        $this->assertNotValidates([], new DbMediumInteger());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbMediumInteger());
        $this->assertNotValidates('foo', new DbMediumInteger());

        $this->assertValidates(null, ['nullable', new DbMediumInteger()]);
        $this->assertNotValidates(null, ['required', new DbMediumInteger()]);
    }

    #[Test]
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            -8_388_609,
            new DbMediumInteger(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '-8388608'])]
        );
        $this->assertFailsWithMessage(
            8_388_608,
            new DbMediumInteger(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '8388607'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbMediumInteger(),
            [trans('validation.integer', ['attribute' => 'test'])]
        );
    }

    #[Test]
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::mediumInteger());
    }
}
