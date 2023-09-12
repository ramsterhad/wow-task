<?php declare(strict_types=1);

use Ramsterhad\WowTask\Router\Router;

require_once '../src/bootstrap.php';

$request = (new Router())->initialize();

$controllerNamespace = $request->getControllerNamespace();
$controller = new $controllerNamespace($request);
$controller->index();
