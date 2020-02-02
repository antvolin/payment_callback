<?php

use Lib\Services\SuccessPayStrategy;
use PHPUnit\Framework\TestCase;

class SuccessPayStrategy_test extends TestCase
{
    /**
     * @test
     */
    public function shouldBeRedirectToThankYouPage(): void
    {
        $this->expectException(CIPHPUnitTestRedirectException::class);
        $this->expectExceptionMessage('Redirect to /index.php/page/thank_you');

        $strategy = new SuccessPayStrategy();
        $strategy->process();
    }
}
