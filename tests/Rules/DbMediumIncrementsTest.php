<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Rules\DbMediumIncrements;

#[CoversNothing]
class DbMediumIncrementsTest extends RuleTestCase
{
    #[Test]
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbMediumIncrements());
        $this->assertValidates(1, new DbMediumIncrements());
        $this->assertValidates(16_777_215, new DbMediumIncrements());
        $this->assertNotValidates(0, new DbMediumIncrements());
        $this->assertNotValidates(16_777_216, new DbMediumIncrements());

        $this->assertNotValidates([], new DbMediumIncrements());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbMediumIncrements());
        $this->assertNotValidates('foo', new DbMediumIncrements());

        $this->assertValidates(null, ['nullable', new DbMediumIncrements()]);
        $this->assertNotValidates(null, ['required', new DbMediumIncrements()]);
    }

    #[Test]
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            0,
            new DbMediumIncrements(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '1'])]
        );
        $this->assertFailsWithMessage(
            16_777_216,
            new DbMediumIncrements(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '16777215'])]
        );
        $this->assertFailsWithMessage(
            'foo',
            new DbMediumIncrements(),
            [trans('validation.integer', ['attribute' => 'test'])]
        );
    }

    #[Test]
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::mediumIncrements());
    }
}
