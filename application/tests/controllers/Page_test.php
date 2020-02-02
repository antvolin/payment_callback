<?php

class Page_test extends TestCase
{
    /**
     * @test
     */
    public function sorryPageShouldBeDisplayed(): void
    {
        $output = $this->request('GET', '/page/sorry');

        $this->assertStringContainsString('<p>Transaction #:</p>', $output);
        $this->assertStringContainsString('<p>Transaction operation:</p>', $output);
        $this->assertStringContainsString('<p>Transaction status:</p>', $output);
    }

    /**
     * @test
     */
    public function thankYouPageShouldBeDisplayed(): void
    {
        $output = $this->request('GET', '/page/thank_you');

        $this->assertStringContainsString('<h1>Congratulation, the transaction success!</h1>', $output);
        $this->assertStringContainsString('<p>Operation completed successfully!</p>', $output);
    }
}
