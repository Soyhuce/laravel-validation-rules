<?php declare(strict_types=1);

namespace Rules;

use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Soyhuce\Rules\MiscRules;
use Soyhuce\Rules\Rules\DbUnsignedTinyInteger;
use Soyhuce\Rules\Rules\Every;
use Soyhuce\Rules\Tests\Rules\RuleTestCase;

#[CoversClass(Every::class)]
class EveryTest extends RuleTestCase
{
    #[Test]
    public function theRuleCorrectlyValidates(): void
    {
        $this->assertValidates([10], new Every([new DbUnsignedTinyInteger()]));
        $this->assertValidates([0, 10], new Every([new DbUnsignedTinyInteger()]));
        $this->assertValidates(range(0, 255), new Every([new DbUnsignedTinyInteger()]));

        $this->assertNotValidates([-1], new Every([new DbUnsignedTinyInteger()]));
        $this->assertNotValidates([256, 0, 10], new Every([new DbUnsignedTinyInteger()]));

        $this->assertValidates(
            ['foo@email.com', 'bar@email.com', 'baz@email.com'],
            new Every(['required', 'string', 'email'])
        );
        $this->assertNotValidates(
            ['foo@email.com', 'bar@email.com', 'baz@email.com', 3],
            new Every(['required', 'string', 'email'])
        );

        $this->assertValidates(null, ['nullable', 'array', new Every([new DbUnsignedTinyInteger()])]);
        $this->assertNotValidates(null, ['required', 'array', new Every([new DbUnsignedTinyInteger()])]);
    }

    #[Test]
    public function messagesAreCorrectlyHandled(): void
    {
        $this->assertFailsWithMessage(
            [-1],
            new Every([new DbUnsignedTinyInteger()]),
            [trans('validation.every', ['attribute' => 'test'])]
        );
    }

    #[Test]
    public function subMessagesArePresent(): void
    {
        $this->assertEquals(
            [
                'test' => [trans('validation.every', ['attribute' => 'test'])],
                'test.0' => [trans('validation.email', ['attribute' => 'test.0'])],
                'test.1' => [trans('validation.email', ['attribute' => 'test.1'])],
                'test.2' => [trans('validation.required', ['attribute' => 'test.2'])],
            ],
            $this->makeValidator(
                ['foo', UploadedFile::fake()->create('test.txt'), null],
                ['array', new Every(['required', 'email'])]
            )
                ->getMessageBag()
                ->getMessages()
        );
    }

    #[Test]
    public function helperCanBeUsed(): void
    {
        $this->assertValidates([10], MiscRules::every(new DbUnsignedTinyInteger()));
    }
}
