<?php declare(strict_types = 1);

namespace Ramsterhad\WowTask\Router\Parameter;

class Parameter
{
    public function __construct(private string $key, private string $value)
    {
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
