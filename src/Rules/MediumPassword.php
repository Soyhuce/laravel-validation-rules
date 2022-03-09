<?php declare(strict_types=1);

namespace Soyhuce\Rules\Rules;

use Soyhuce\Rules\Concerns\UsesSpecialChars;

class MediumPassword extends CompoundRule
{
    use UsesSpecialChars;

    public function __construct()
    {
        $mediumPassword = str_replace(
            [':lower', ':upper', ':digit', ':special'],
            ['a-z', 'A-Z', '0-9', $this->specialCharsRegexClass()],
            <<<'REGEXP'
            /^
            (((?=.*[:lower])(?=.*[:upper])(?=.*[:digit])(?=.*[:special]))+)|
            (((?=.*[:lower])(?=.*[:upper])(?=.*[:digit]))+)|
            (((?=.*[:lower])(?=.*[:upper])(?=.*[:special]))+)|
            (((?=.*[:lower])(?=.*[:digit])(?=.*[:special]))+)|
            (((?=.*[:upper])(?=.*[:digit])(?=.*[:special]))+)
            /x
            REGEXP
        );

        parent::__construct(['string', 'min:8', "regex:{$mediumPassword}"]);
    }
}
