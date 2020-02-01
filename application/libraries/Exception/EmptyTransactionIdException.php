<?php

namespace Lib\Exception;

class EmptyTransactionIdException extends \Exception
{
    protected $message = 'Transaction id cannot be empty!';
}
