<?php

namespace Lib\Services;

class SuccessPayStrategy implements PayStrategyInterface
{
    public function process(): void
    {
        redirect('/page/thank_you');
    }
}
