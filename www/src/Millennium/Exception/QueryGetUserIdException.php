<?php
namespace Millennium\Exception;
use Exception;

class QueryGetUserIdException extends Exception
{
    public function __construct(string $userId)
    {
        Exception::__construct("Недопустимый идентификатор пользователя: \"{$userId}\". \n Идентификатор должен быть целым числом" );
    }
}