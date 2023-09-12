<?php declare(strict_types = 1);

namespace Ramsterhad\WowTask\Router;



use Ramsterhad\WowTask\Router\Parameter\Parameter;
use Ramsterhad\WowTask\Router\Parameter\ParameterCollection;
use Ramsterhad\WowTask\Task\Controller\Create as TaskCreate;
use Ramsterhad\WowTask\Task\Controller\Read as TaskRead;
use Ramsterhad\WowTask\User\Controller\Create as UserCreate;

class Router
{
    private array $knownRoutes = [
        'create-user' => UserCreate::class,
        'read' => TaskRead::class,
        'create' => TaskCreate::class,
    ];

    public function initialize(): Request
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = substr($uri, 1); // By default, there is everytime at least one slash. Remove it from Request.
        $uri = preg_split('/\\//', $uri);
        $uri = array_filter($uri, fn($value) => !is_null($value) && $value !== '');

        if (empty($uri)) {
            Router::badRequest('No route given');
        }

        if (!key_exists($uri[0], $this->knownRoutes)) {
            Router::badRequest('Unknown route given');
        }

        $route = $uri[0];

        $rawParameters = $uri;
        unset($rawParameters[0]);
        $rawParameters = array_values($rawParameters);

        if (count($rawParameters) % 2 !== 0) {
            Router::badRequest('Missing key value pair!');
        }

        $parameterCollection = new ParameterCollection();

        for ($i = 0; $i < count($rawParameters); $i++) {
            $parameterCollection->add(
                new Parameter($rawParameters[$i], $rawParameters[++$i])
            );
        }

        return new Request(
            $this->knownRoutes[$route],
            $parameterCollection
        );
    }

    public static function badRequest($message = ''): never
    {
        header('HTTP/1.0 400 Bad Request');
        exit($message);
    }
}
