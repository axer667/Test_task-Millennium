<?php
namespace Millennium\Exception;
use Exception;

class NoUserInRepositoryException extends Exception
{
    public function __construct(string $userId)
    {
        Exception::__construct('В репозитории отсутствует пользователь с id = ' . $userId);
    }
}