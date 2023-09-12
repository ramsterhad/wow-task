<?php declare(strict_types = 1);

namespace Ramsterhad\WowTask\Task\Controller;

use Ramsterhad\WowTask\Firebase\BootstrapDatabase;
use Ramsterhad\WowTask\Router\Router;
use Ramsterhad\WowTask\Shared\Controller\Controller;
use Ramsterhad\WowTask\User\Datatype as UserDatatype;

class Read extends Controller
{
    public function index()
    {
        $name = $this->request->getParameterCollection()->get('name');

        if (empty($name)) {
            header('HTTP/1.0 400 Bad Request');
            exit('Parameter name must be set: ?name=example');
        }

        $user = new UserDatatype($name);

        $snapshot = (new BootstrapDatabase())->getDatabase()->getReference($user->getName())->getSnapshot();

        if ($snapshot->exists()) {
            var_dump($snapshot->getValue());
        } else {
            Router::badRequest('Unknown name!');
        }
    }
}
