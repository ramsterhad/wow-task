<?php declare(strict_types = 1);


namespace Ramsterhad\WowTask\User\Datatype;


use Ramsterhad\WowTask\Shared\Infrastructure\Contract\Storeable;

final class Datatype implements Storeable
{
    public function __construct(private string $id, private string $name)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTableIdent(): string
    {
        return 'users';
    }

    public function convertObjectToAssociativeArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
