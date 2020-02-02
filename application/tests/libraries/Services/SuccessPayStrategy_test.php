<?php

//namespace Tests\libraries\Services;

use Lib\Services\SuccessPayStrategy;
//use PHPUnit\Framework\TestCase;

class SuccessPayStrategy_test extends TestCase
{
    /**
     * @test
     */
    public function shouldBeConstructable(): void
    {
        $strategy = new SuccessPayStrategy();

        $strategy->process();

        var_dump($this->CI->headers);
        exit;
    }
}
