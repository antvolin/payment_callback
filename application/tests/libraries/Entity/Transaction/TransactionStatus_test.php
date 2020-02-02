<?php

namespace Tests\libraries\Entity\Transaction;

use Lib\Entity\Transaction\TransactionStatus;
use Lib\Exception\EmptyTransactionStatusException;
use PHPUnit\Framework\TestCase;

class TransactionStatus_test extends TestCase
{
    /**
     * @test
     *
     * @throws EmptyTransactionStatusException
     */
    public function shouldBeConstructable(): void
    {
        $value = 'ok or fail status value';
        $transactionStatus = new TransactionStatus($value);

        $this->assertEquals($value, $transactionStatus->getValue());
    }

    /**
     * @test
     *
     * @dataProvider notValidTransactionStatusValue
     *
     * @param $value
     *
     * @throws EmptyTransactionStatusException
     */
    public function shouldBeNotConstructableWithNotValidValue($value): void
    {
        $this->expectException(EmptyTransactionStatusException::class);

        new TransactionStatus($value);
    }

    /**
     * @return array
     */
    public function notValidTransactionStatusValue(): array
    {
        return [
            [0],
            [''],
            [false],
        ];
    }
}
