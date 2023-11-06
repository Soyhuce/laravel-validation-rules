<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;
use Soyhuce\Rules\Concerns\DatabaseRelatedRule;
use function in_array;
use function is_array;

class DbBoolean implements ValidationRule
{
    use DatabaseRelatedRule;

    private string $attribute;

    /**
     * Determine if the validation rule passes.
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function passes(string $attribute, mixed $value): bool
    {
        $this->attribute = $attribute;

        return !is_array($value) && in_array($value, $this->booleans()->all(), true);
    }

    public function message(): string
    {
        $validator = Validator::make([], []);
        $validator->addFailure($this->attribute, 'boolean');

        return $validator->errors()->first($this->attribute);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->passes($attribute, $value)) {
            $fail($this->message());
        }
    }
}
