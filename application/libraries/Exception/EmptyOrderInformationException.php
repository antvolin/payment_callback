<?php

namespace Lib\Exception;

class EmptyOrderInformationException extends \Exception
{
    protected $message = 'Order information cannot be empty!';
}
