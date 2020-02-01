<?php

namespace Lib\Exception;

class EmptyOrderStatusException extends \Exception
{
    protected $message = 'Order status cannot be empty!';
}
