<?php

namespace Lib\Exception;

class TransactionIdFieldSizeException extends \Exception
{
    protected $message = 'Transaction id field size does not match the required value!';
}
