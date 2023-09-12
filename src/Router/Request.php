<?php declare(strict_types = 1);

namespace Ramsterhad\WowTask\Router;


use Ramsterhad\WowTask\Router\Parameter\ParameterCollection;

class Request
{
    public function __construct(
        private string $controllerNamespace,
        private ParameterCollection $parameterCollection
    ) {}

    public function getControllerNamespace(): string
    {
        return $this->controllerNamespace;
    }

    public function getParameterCollection(): ParameterCollection
    {
        return $this->parameterCollection;
    }
}
