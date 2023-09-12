<?php declare(strict_types=1);

namespace Ramsterhad\WowTask\Task\Infrastructure;

use Ramsterhad\WowTask\FirebaseAdapter\DatabaseFactory;
use Ramsterhad\WowTask\Task\Datatype\Datatype;
use Ramsterhad\WowTask\Task\Datatype\Status;
use Ramsterhad\WowTask\User\Datatype\Datatype as UserDatatype;

class Repository
{
    public function create(
        UserDatatype $user,
        string       $text,
        Status       $status,
    ) {

        $database = (new DatabaseFactory())->getDatabase();

        $reference = $database
            ->getReference('tasks')
            ->push([
                'user' => $user->getId(),
                'text' => $text,
                'status' => $status->value,
            ])
        ;

        return new Datatype(
            $reference->getKey(),
            $reference->getValue()['user'],
            $status,
            $user
        );
    }
}