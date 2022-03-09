<?php declare(strict_types=1);

namespace Soyhuce\Rules\Concerns;

trait UsesSpecialChars
{
    /** @var array<string> */
    public static array $specialChars = [
        ' ',
        '#',
        '$',
        '£',
        '€',
        '%',
        '&',
        '%',
        '@',
        "'",
        '"',
        '`',
        '*',
        '+',
        '-',
        '_',
        ',',
        '.',
        ':',
        ';',
        '!',
        '?',
        '§',
        'µ',
        '/',
        '\\',
        '[',
        ']',
        '(',
        ')',
        '{',
        '}',
        '<',
        '>',
        '=',
        '^',
        '~',
        '|',
    ];

    protected function specialCharsRegexClass(string $delimiter = '/'): string
    {
        return preg_quote(implode('', static::$specialChars), $delimiter);
    }
}
