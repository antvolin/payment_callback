<?php

namespace Lib\Exception;

class NotFoundTransactionInformationException extends \Exception
{
    protected $message = 'Transaction information cannot be not found!';
}
