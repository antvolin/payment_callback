<?php

namespace Tests\libraries\Entity\Transaction;

use Lib\Entity\Transaction\Transaction;
use Lib\Entity\Transaction\TransactionId;
use Lib\Entity\Transaction\TransactionOperation;
use Lib\Entity\Transaction\TransactionStatus;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    private MockObject $transactionId;
    private MockObject $transactionOperation;
    private MockObject $transactionStatus;

    protected function setUp(): void
    {
        $this->transactionId = $this->createMock(TransactionId::class);
        $this->transactionId->method('getValue')->willReturn('123');

        $this->transactionOperation = $this->createMock(TransactionOperation::class);
        $this->transactionOperation->method('getValue')->willReturn('pay');

        $this->transactionStatus = $this->createMock(TransactionStatus::class);
        $this->transactionStatus->method('getValue')->willReturn('ok');
    }

    /**
     * @test
     */
    public function shouldBeConstructable(): void
    {
        $transaction = new Transaction(
            $this->transactionId,
            $this->transactionOperation,
            $this->transactionStatus
        );

        $this->assertSame($this->transactionId, $transaction->getId());
        $this->assertSame($this->transactionOperation, $transaction->getOperation());
        $this->assertSame($this->transactionStatus, $transaction->getStatus());
    }
}
