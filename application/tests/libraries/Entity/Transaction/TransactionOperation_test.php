<?php

namespace Tests\libraries\Entity\Transaction;

use Lib\Entity\Transaction\TransactionOperation;
use Lib\Exception\EmptyTransactionOperationException;
use PHPUnit\Framework\TestCase;

class TransactionOperation_test extends TestCase
{
    /**
     * @test
     *
     * @throws EmptyTransactionOperationException
     */
    public function shouldBeConstructable(): void
    {
        $value = 'ok or fail operation value';
        $transactionOperation = new TransactionOperation($value);

        $this->assertEquals($value, $transactionOperation->getValue());
    }

    /**
     * @test
     *
     * @dataProvider notValidTransactionOperationValue
     *
     * @param $value
     *
     * @throws EmptyTransactionOperationException
     */
    public function shouldBeNotConstructableWithNotValidValue($value): void
    {
        $this->expectException(EmptyTransactionOperationException::class);

        new TransactionOperation($value);
    }

    /**
     * @return array
     */
    public function notValidTransactionOperationValue(): array
    {
        return [
            [0],
            [''],
            [false],
        ];
    }
}
