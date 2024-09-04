# A set of useful validation rules for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/soyhuce/laravel-validation-rules.svg?style=flat-square)](https://packagist.org/packages/soyhuce/laravel-validation-rules)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/soyhuce/laravel-validation-rules/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/soyhuce/laravel-validation-rules/actions/workflows/run-tests.yml)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/soyhuce/laravel-validation-rules/phpstan.yml?branch=main&label=phpstan&style=flat-square)](https://github.com/soyhuce/laravel-validation-rules/actions/workflows/phpstan.yml)
[![GitHub PHPStan Action Status](https://img.shields.io/github/actions/workflow/status/soyhuce/laravel-validation-rules/php-cs-fixer.yml?branch=main&label=php-cs-fixer&style=flat-square)](https://github.com/soyhuce/laravel-validation-rules/actions/workflows/php-cs-fixer.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/soyhuce/laravel-validation-rules.svg?style=flat-square)](https://packagist.org/packages/soyhuce/laravel-validation-rules)

Main objective of this package is to provide a set of validation rules for Laravel in order to make it easier to write validation.

```php
Validator::make($data, rules([
	'email' => ['required', DbRules::string()], // ['required', 'string', 'max:255']
	'smaller' => ['nullable', DbRules::string(20)], // ['nullable', 'string', 'max:20']
	'birthday' => [DbRules::date()], // ['date_format:Y-m-d']
	'tiny' => [DbRules::tinyInteger()], // ['integer', 'min:-128', 'max:127']
	// ...
]));
```

## Installation

You can install the package via composer:

```bash
composer require soyhuce/laravel-validation-rules
```

## Usage

### Available Rules

Database related rules :
- `DbRules::string`
- `DbRules::boolean`
- `DbRules::enum`
- `DbRules::date`
- `DbRules::dateTime`
- `DbRules::tinyInteger`
- `DbRules::unsignedTinyInteger`
- `DbRules::smallInteger`
- `DbRules::unsignedSmallInteger`
- `DbRules::mediumInteger`
- `DbRules::unsignedMediumInteger`
- `DbRules::integer`
- `DbRules::unsignedInteger`
- `DbRules::bigInteger`
- `DbRules::unsignedBigInteger`
- `DbRules::smallIncrements`
- `DbRules::mediumIncrements`
- `DbRules::increments`
- `DbRules::bigIncrements`
- `DbRules::float`
- `DbRules::double`

Miscellaneous rules :

- `MisRules::safePassword` : GDPR/CNIL compatible password (at least 12 characters)
- `MisRules::mediumPassword` : GDPR/CNIL compatible password (at least 8 characters)

### Using in conditional `Rule::when`

Rules extending `CompoundRule` cannot be used directly in `Rule::when`.

You will need to use `...` in this case :

```diff
'commission_account' => Rule::when(
    fn(Fluent $data) => $data->get('commission') !== null,
-   ['required', DbRules::string()],
+   ['required', ...DbRules::string()],
    'exclude'
),
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Bastien Philippe](https://github.com/bastien-phi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
