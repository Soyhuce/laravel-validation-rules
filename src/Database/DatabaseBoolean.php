<?php declare(strict_types=1);

namespace Soyhuce\Rules\Database;

class DatabaseBoolean
{
    /**
     * @return array<bool|int|string>
     */
    public function all(): array
    {
        return [1, 0, '1', '0', 'true', 'false', true, false];
    }
}
