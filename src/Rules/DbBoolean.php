<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Soyhuce\Rules\Concerns\DatabaseRelatedRule;
use function in_array;
use function is_array;

class DbBoolean implements Rule
{
    use DatabaseRelatedRule;

    private string $attribute;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function passes($attribute, $value): bool
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
}
