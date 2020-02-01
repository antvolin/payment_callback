<?php

namespace Lib\Services;

use Exception;

trait Logger
{
    /**
     * @param Exception $e
     */
    private function logError(Exception $e): void
    {
        log_message('error', $e->getMessage());

        exit;
    }
}
