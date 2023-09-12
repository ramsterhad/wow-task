<?php declare(strict_types = 1);

namespace Ramsterhad\WowTask\Task\Controller;


use Ramsterhad\WowTask\Firebase\BootstrapDatabase;
use Ramsterhad\WowTask\Router\Router;
use Ramsterhad\WowTask\Shared\Controller\Controller;
use Ramsterhad\WowTask\Task\Datatype\Status;
use Ramsterhad\WowTask\Task\Infrastructure\Repository;
use Ramsterhad\WowTask\User\Controller\Create as TaskCreate;
use Ramsterhad\WowTask\User\Infrastructure\Repository as UserRepository;

/**
 * Creates a task.
 */
class Create extends Controller
{
    public function index()
    {
        $userId = $this->request->getParameterCollection()->get('user');
        $text = $this->request->getParameterCollection()->get('text');
        $status = $this->request->getParameterCollection()->get('status');

        $user = (new UserRepository())->getUserById($userId);

        /*
         * todo repository
         */
        $taskRepository = (new Repository())->create(
            $user,
            $text,
            Status::from((int) $status),
        );

exit;
        $task = new TaskCreate('', $text, Status::TODO, $user);

        /** TODO */
        $database = (new BootstrapDatabase())->getDatabase();

        $userSnapshot = $database
            ->getReference($user->getTableIdent())
            ->orderByChild('name')
            ->equalTo($user->getName())
            ->getSnapshot()
        ;

        // User exists
        if (!empty($userSnapshot->getValue())) {

            /*
            $taskSnapshot = $database
                ->getReference($task->getTableIdent())
                ->orderByChild('text')
                ->equalTo($text)
                ->getSnapshot()
            ;
            */

            // Task is not existing, create it.
            /*
            if (empty($taskSnapshot->getValue())) {
                $database->getReference($task->getTableIdent())->push(
                    $task->convertObjectToAssociativeArray()
                );
            } else {
                $database->getReference($task->getTableIdent())->set(
                    $task->convertObjectToAssociativeArray()
                );
            }
            */

            $reference = $database->getReference($task->getTableIdent())->push(
                $task->convertObjectToAssociativeArray()
            );

            echo $reference->getValue();

        } else {
            Router::badRequest('Unknown name!');
        }
    }
}
