<?php declare(strict_types = 1);


namespace Ramsterhad\WowTask\Task\Datatype;

use Ramsterhad\WowTask\Shared\Infrastructure\Contract\Storeable;
use Ramsterhad\WowTask\User\Datatype\Datatype as UserDatatype;


class Datatype implements Storeable
{
    public function __construct(
        private string       $id,
        private string       $text,
        private Status       $status,
        private UserDatatype $user
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public function getUser(): UserDatatype
    {
        return $this->user;
    }

    public function setUser(UserDatatype $user): void
    {
        $this->user = $user;
    }

    public function getTableIdent(): string
    {
        return 'tasks';
    }

    public function convertObjectToAssociativeArray(): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->getId(),
            'text' => $this->text,
            'status' => $this->status,
        ];
    }
}
