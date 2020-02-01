<?php

namespace Lib\Exception;

class EmptyTransactionInformationException extends \Exception
{
    protected $message = 'Transaction information cannot be empty!';
}
