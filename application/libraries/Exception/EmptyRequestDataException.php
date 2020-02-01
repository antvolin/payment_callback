<?php

namespace Lib\Exception;

class EmptyRequestDataException extends \Exception
{
    protected $message = 'Request data cannot be empty!';
}
