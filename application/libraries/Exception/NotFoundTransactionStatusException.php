<?php

namespace Lib\Exception;

class NotFoundTransactionStatusException extends \Exception
{
    protected $message = 'Transaction status cannot be not found!';
}
