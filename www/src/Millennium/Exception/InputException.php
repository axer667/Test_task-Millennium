<?php
namespace Millennium\Exception;
use Exception;

class InputException extends Exception
{
    public function __construct(array $fields)
    {
        Exception::__construct("Один или несколько параметров недопустимы." );
    }
}