<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use function is_array;

class Every implements ValidationRule
{
    /**
     * @param array<int, mixed> $rules
     */
    public function __construct(
        protected array $rules,
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_array($value)) {
            return;
        }

        $validator = ValidatorFacade::make(
            [$attribute => $value],
            [
                $attribute => 'array',
                "{$attribute}.*" => $this->rules,
            ],
        );

        $failed = false;

        foreach ($validator->errors()->messages() as $key => $errors) {
            foreach ($errors as $error) {
                $failed = true;
                $fail($key, $error);
            }
        }

        if ($failed) {
            $fail($attribute, 'validation.every')->translate();
        }
    }
}
