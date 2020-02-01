<?php

namespace Lib\Exception;

class EmptyOrderIdException extends \Exception
{
    protected $message = 'Order id cannot be empty!';
}
