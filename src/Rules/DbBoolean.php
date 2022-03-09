<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use Illuminate\Contracts\Validation\Rule;
use Soyhuce\Rules\Concerns\ActAsValidator;
use Soyhuce\Rules\Concerns\DatabaseRelatedRule;
use function in_array;
use function is_array;

class DbBoolean implements Rule
{
    use ActAsValidator;
    use DatabaseRelatedRule;

    private string $attribute;

    public function __construct()
    {
        $this->bootActAsValidator();
    }

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
        return $this->getMessage($this->attribute, 'boolean');
    }
}
