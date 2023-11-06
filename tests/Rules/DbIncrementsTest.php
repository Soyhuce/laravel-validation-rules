<?php declare(strict_types=1);

namespace Soyhuce\Rules\Tests\Rules;

use Illuminate\Http\UploadedFile;
use Soyhuce\Rules\DbRules;
use Soyhuce\Rules\Exceptions\ValueOutOfRange;
use Soyhuce\Rules\Rules\DbIncrements;

/**
 * @coversNothing
 */
class DbIncrementsTest extends RuleTestCase
{
    /**
     * @test
     */
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

    /**
     * @test
     */
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

    /**
     * @test
     */
    public function helperCanBeUsed(): void
    {
        $this->assertValidates(10, DbRules::increments());
    }

    /**
     * @test
     */
    public function minCanBeOverrode(): void
    {
        $this->assertNotValidates(1, new DbIncrements(min: 2));
    }

    /**
     * @test
     */
    public function maxCanBeOverrode(): void
    {
        $this->assertNotValidates(5, new DbIncrements(max: 3));
    }

    /**
     * @test
     */
    public function minMustBeInActualRange(): void
    {
        $this->expectException(ValueOutOfRange::class);
        new DbIncrements(min: -2);
    }

    /**
     * @test
     */
    public function maxMustBeInActualRange(): void
    {
        $this->expectException(ValueOutOfRange::class);

        new DbIncrements(max: 4_294_967_296);
    }
}
