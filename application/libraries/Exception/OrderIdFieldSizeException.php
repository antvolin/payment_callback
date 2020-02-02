<?php

namespace Lib\Exception;

class OrderIdFieldSizeException extends \Exception
{
    protected $message = 'Order id field size does not match the required value!';
}
