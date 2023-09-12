<?php declare(strict_types = 1);

namespace Ramsterhad\WowTask\Shared\Infrastructure\Contract;

interface Storeable
{
    public function getTableIdent(): string;

    public function convertObjectToAssociativeArray(): array;
}
