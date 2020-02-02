<?php

namespace Lib\Services;

class SuccessPayStrategy implements PayStrategyInterface
{
    public function process(): void
    {
        $CI =& get_instance();
        $CI->load->helper('url');

        redirect('/page/thank_you');
    }
}
