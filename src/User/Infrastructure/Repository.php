<?php declare(strict_types = 1);

namespace Ramsterhad\WowTask\User\Infrastructure;

use Kreait\Firebase\Exception\Messaging\NotFound;
use Ramsterhad\WowTask\FirebaseAdapter\DatabaseFactory;
use Ramsterhad\WowTask\User\Datatype\Datatype;


class Repository
{
    public function getUserById(string $id): Datatype
    {
        $database = (new DatabaseFactory())->getDatabase();

        $item = $database->getReference('users')->getChild($id);

        return new Datatype(
            $item->getKey(),
            $item->getValue()['name'],
        );
    }

    public function getUserByName(string $name): Datatype
    {
        $database = (new DatabaseFactory())->getDatabase();

        $item = $database
            ->getReference('users')
            ->orderByChild('name')
            ->equalTo($name)
            ->getSnapshot()
        ;

        if (!$item->hasChildren()) {
            throw new NotFound(
                sprintf('No record found for "%s"', $name)
            );
        }

        $id = array_key_first($item->getValue());
        $nameDatabase = $item->getValue()[$id]['name'];

        return new Datatype($id, $nameDatabase);
    }

    public function create(string $name)
    {
        $database = (new DatabaseFactory())->getDatabase();

        $reference = $database
            ->getReference('users')
            ->push(['name' => $name])
        ;

        return new Datatype(
            $reference->getKey(),
            $name
        );
    }
}
