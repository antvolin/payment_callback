<?php

namespace Lib\Exception;

class NotFoundTransactionOperationException extends \Exception
{
    protected $message = 'Transaction operation cannot be not found!';
}
