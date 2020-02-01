<?php

namespace Lib\Exception;

class NotFoundOrderIdException extends \Exception
{
    protected $message = 'Order id cannot be not found!';
}
