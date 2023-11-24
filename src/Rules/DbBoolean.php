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

    /**
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_array($value) && in_array($value, $this->booleans()->all(), true)) {
            return;
        }

        $validator = Validator::make([], []);
        $validator->addFailure($attribute, 'boolean');

        $fail($validator->errors()->first($attribute));
    }
}
