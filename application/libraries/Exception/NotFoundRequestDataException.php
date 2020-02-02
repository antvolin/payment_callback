<?php

namespace Lib\Exception;

class NotFoundRequestDataException extends \Exception
{
    protected $message = 'Request data cannot be not found!';
}
