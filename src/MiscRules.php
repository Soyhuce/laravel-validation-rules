<?php declare(strict_types=1);

namespace Soyhuce\Rules;

use Soyhuce\Rules\Rules\MediumPassword;
use Soyhuce\Rules\Rules\SafePassword;

class MiscRules
{
    public static function mediumPassword(): MediumPassword
    {
        return new MediumPassword();
    }

    public static function safePassword(): SafePassword
    {
        return new SafePassword();
    }
}
