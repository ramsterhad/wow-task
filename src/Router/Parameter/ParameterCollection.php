<?php declare(strict_types = 1);

namespace Ramsterhad\WowTask\Router\Parameter;

use http\Exception\InvalidArgumentException;

class ParameterCollection
{
    /** @var string[] $parameter  */
    private array $parameters = [];

    public function add(Parameter $parameter): void
    {
        $this->parameters[$parameter->getKey()] = $parameter->getValue();
    }

    public function has(string $key): bool
    {
        return isset($this->parameters[$key]);
    }

    public function get(string $key): string
    {
        if (!$this->has($key)) {
            throw new InvalidArgumentException('Unknown parameter "' . $key . '".');
        }

        return $this->parameters[$key];
    }
}
