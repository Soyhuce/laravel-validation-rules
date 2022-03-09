<?php declare(strict_types=1);

namespace Soyhuce\Rules\Commands;

use Illuminate\Console\Command;

class RulesCommand extends Command
{
    public $signature = 'laravel-validation-rules';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
