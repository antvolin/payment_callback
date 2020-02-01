<?php

namespace Lib\Exception;

class EmptyTransactionStatusException extends \Exception
{
    protected $message = 'Transaction status cannot be empty!';
}
