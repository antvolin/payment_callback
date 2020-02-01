<?php

namespace Lib\Exception;

class NotFoundOrderStatusException extends \Exception
{
    protected $message = 'Order status cannot be not found!';
}
