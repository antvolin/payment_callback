<?php

namespace Lib\Exception;

class NotFoundTransactionIdException extends \Exception
{
    protected $message = 'Transaction id cannot be not found!';
}
