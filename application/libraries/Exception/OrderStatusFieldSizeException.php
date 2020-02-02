<?php

namespace Lib\Exception;

class OrderStatusFieldSizeException extends \Exception
{
    protected $message = 'Order status field size does not match the required value!';
}
