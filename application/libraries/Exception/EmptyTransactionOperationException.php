<?php

namespace Lib\Exception;

class EmptyTransactionOperationException extends \Exception
{
    protected $message = 'Transaction operation cannot be empty!';
}
