<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use Soyhuce\Rules\Concerns\UsesSpecialChars;

class SafePassword extends CompoundRule
{
    use UsesSpecialChars;

    public function __construct()
    {
        $safePassword = sprintf(
            '/^((?=.*[%s])(?=.*[%s])(?=.*[%s])(?=.*[%s]))+/',
            'a-z',
            'A-Z',
            '0-9',
            $this->specialCharsRegexClass()
        );

        parent::__construct(['string', 'min:12', "regex:{$safePassword}"]);
    }
}
