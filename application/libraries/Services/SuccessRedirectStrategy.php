<?php

namespace Lib\Services;

class SuccessRedirectStrategy implements RedirectStrategyInterface
{
    public function redirect(): void
    {
        redirect('/page/thank_you');
    }
}
