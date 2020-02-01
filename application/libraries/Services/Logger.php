<?php

namespace Lib\Services;

trait Logger
{
    /**
     * @param string $msg
     */
    private function logError(string $msg): void
    {
        log_message('error', $msg);

        exit;
    }
}
