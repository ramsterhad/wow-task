<?php declare(strict_types = 1);

namespace Ramsterhad\WowTask\Shared\Controller;

use Ramsterhad\WowTask\Shared\Infrastructure\Contract\Storeable;

class Response
{
    public function transformDatatypeToJson(Storeable $datatype): string
    {
        return json_encode($datatype->convertObjectToAssociativeArray());
    }

    public function output(string $string): void
    {
        echo $string;
    }
}