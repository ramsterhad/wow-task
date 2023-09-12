<?php declare(strict_types = 1);


namespace Ramsterhad\WowTask\Task\Datatype;

enum Status: int
{
    case TODO = 0;
    case DONE = 1;
}