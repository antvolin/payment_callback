<?php

namespace Tests\libraries\Entity\Transaction;

use Lib\Entity\Transaction\TransactionId;
use Lib\Exception\TransactionIdFieldSizeException;
use PHPUnit\Framework\TestCase;

class TransactionIdTest extends TestCase
{
    /**
     * @test
     *
     * @throws TransactionIdFieldSizeException
     */
    public function shouldBeConstructable(): void
    {
        $value = '1234567890123456';
        $orderId = new TransactionId($value);

        $this->assertEquals($value, $orderId->getValue());
    }

    /**
     * @test
     *
     * @dataProvider notValidTransactionIdValue
     *
     * @param $value
     *
     * @throws TransactionIdFieldSizeException
     */
    public function shouldBeNotConstructableWithNotValidValue($value): void
    {
        $this->expectException(TransactionIdFieldSizeException::class);

        new TransactionId($value);
    }

    /**
     * @return array
     */
    public function notValidTransactionIdValue(): array
    {
        return [
            [0],
            [''],
            ['dsa'],
            ['dsadnmklqwenldsadnm-123njk123m,.asd'],
            [111],
            [true],
            [false],
        ];
    }
}
