<?php declare(strict_types=1);

namespace Soyhuce\Rules\Concerns;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Validation\Concerns\FormatsMessages;

trait ActAsValidator
{
    use FormatsMessages;

    /** @var array<string, string> */
    protected array $customMessages = [];

    /** @var array<string> */
    protected array $sizeRules = ['Size', 'Between', 'Min', 'Max', 'Gt', 'Lt', 'Gte', 'Lte'];

    protected Translator $translator;

    private function bootActAsValidator(): void
    {
        $this->translator = resolve(Translator::class);
    }
}
