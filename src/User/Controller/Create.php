<?php declare(strict_types = 1);

namespace Ramsterhad\WowTask\User\Controller;

use Kreait\Firebase\Exception\DatabaseException;
use Ramsterhad\WowTask\Shared\Controller\Controller;
use Ramsterhad\WowTask\Shared\Controller\Response;
use Ramsterhad\WowTask\User\Infrastructure\Repository;

class Create extends Controller
{
    /**
     * @todo TaskCreate also an example task... no the frontend has to make it?
     *
     * @return void
     * @throws DatabaseException
     */
    public function index(): void
    {
        $user = (new Repository())->create(
            $this->request->getParameterCollection()->get('name')
        );

        $response = new Response();
        $response->output(
            $response->transformDatatypeToJson($user)
        );
    }
}
