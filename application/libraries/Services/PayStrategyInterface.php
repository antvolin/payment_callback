<?php

namespace Lib\Services;

interface PayStrategyInterface
{
    public function process(): void;
}
