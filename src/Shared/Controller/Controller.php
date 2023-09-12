<?php declare(strict_types = 1);

namespace Ramsterhad\WowTask\Shared\Controller;

use Ramsterhad\WowTask\Shared\Controller\Contract\Controller as ControllerInterface;
use Ramsterhad\WowTask\Router\Request;

abstract class Controller implements ControllerInterface
{
    public function __construct(protected Request $request)
    {
    }
}