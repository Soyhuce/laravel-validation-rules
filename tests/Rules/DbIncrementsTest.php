<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Exceptions\ValueOutOfRange;
use Soyhuce\Rules\Rules\DbIncrements;

#[CoversNothing]
class DbIncrementsTest extends RuleTestCase
{
    #[Test]
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates(10, new DbIncrements());
        $this->assertValidates(1, new DbIncrements());
        $this->assertValidates(4_294_967_295, new DbIncrements());
        $this->assertNotValidates(0, new DbIncrements());
        $this->assertNotValidates(4_294_967_296, new DbIncrements());

        $this->assertNotValidates([], new DbIncrements());
        $this->assertNotValidates(UploadedFile::fake()->create('file'), new DbIncrements());
        $this->assertNotValidates('foo', new DbIncrements());

        $this->assertValidates(null, ['nullable', new DbIncrements()]);
        $this->assertNotValidates(null, ['required', new DbIncrements()]);
    }

    #[Test]
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            0,
            new DbIncrements(),
            [trans('validation.min.numeric', ['attribute' => 'test', 'min' => '1'])]
        );

        $this->assertFailsWithMessage(
            4_294_967_296,
            new DbIncrements(),
            [trans('validation.max.numeric', ['attribute' => 'test', 'max' => '4294967295'])]
        );

        $this->assertFailsWithMessage(
            'foo',
            new DbIncrements(),
            [trans('validation.integer', ['attribute' => 'test'])]
        );
    }

    #[Test]
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::increments());
    }

    #[Test]
    public function minCanBeOverrode(): void
    {
        $this->assertNotValidates(1, new DbIncrements(min: 2));
    }

    #[Test]
    public function maxCanBeOverrode(): void
    {
        $this->assertNotValidates(5, new DbIncrements(max: 3));
    }

    #[Test]
    public function minMustBeInActualRange(): void
    {
        $this->expectException(ValueOutOfRange::class);
        new DbIncrements(min: -2);
    }

    #[Test]
    public function maxMustBeInActualRange(): void
    {
        $this->expectException(ValueOutOfRange::class);

        new DbIncrements(max: 4_294_967_296);
    }
}
