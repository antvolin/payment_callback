<?php

namespace Tests\libraries\Factory;

use Lib\Exception\EmptyTransactionInformationException;
use Lib\Exception\EmptyTransactionOperationException;
use Lib\Exception\EmptyTransactionStatusException;
use Lib\Exception\NotFoundTransactionIdException;
use Lib\Exception\NotFoundTransactionOperationException;
use Lib\Exception\NotFoundTransactionStatusException;
use Lib\Exception\TransactionIdFieldSizeException;
use Lib\Factory\TransactionFactory;
use PHPUnit\Framework\TestCase;

class TransactionFactoryTest extends TestCase
{
    /**
     * @test
     *
     * @throws EmptyTransactionInformationException
     * @throws EmptyTransactionOperationException
     * @throws EmptyTransactionStatusException
     * @throws NotFoundTransactionIdException
     * @throws NotFoundTransactionOperationException
     * @throws NotFoundTransactionStatusException
     * @throws TransactionIdFieldSizeException
     */
    public function shouldBeCreatableOrder(): void
    {
        $factory = new TransactionFactory();
        $data = [
            'id' => '1234567890123456',
            'operation' => '1234567890123456',
            'status' => '1234567890',
        ];
        $order = $factory->create($data);

        $this->assertObjectHasAttribute('id', $order);
        $this->assertObjectHasAttribute('operation', $order);
        $this->assertObjectHasAttribute('status', $order);
    }

    /**
     * @test
     *
     * @throws EmptyTransactionInformationException
     * @throws EmptyTransactionOperationException
     * @throws EmptyTransactionStatusException
     * @throws NotFoundTransactionIdException
     * @throws NotFoundTransactionOperationException
     * @throws NotFoundTransactionStatusException
     * @throws TransactionIdFieldSizeException
     */
    public function shouldBeNotCreatableTransactionWithEmptyData(): void
    {
        $this->expectException(EmptyTransactionInformationException::class);

        $factory = new TransactionFactory();
        $data = [];
        $factory->create($data);
    }

    /**
     * @test
     *
     * @throws EmptyTransactionInformationException
     * @throws EmptyTransactionOperationException
     * @throws EmptyTransactionStatusException
     * @throws NotFoundTransactionIdException
     * @throws NotFoundTransactionOperationException
     * @throws NotFoundTransactionStatusException
     * @throws TransactionIdFieldSizeException
     */
    public function shouldBeNotCreatableTransactionWithEmptyTransactionId(): void
    {
        $this->expectException(NotFoundTransactionIdException::class);

        $factory = new TransactionFactory();
        $data = ['asd'];
        $factory->create($data);
    }

    /**
     * @test
     *
     * @throws EmptyTransactionInformationException
     * @throws EmptyTransactionOperationException
     * @throws EmptyTransactionStatusException
     * @throws NotFoundTransactionIdException
     * @throws NotFoundTransactionOperationException
     * @throws NotFoundTransactionStatusException
     * @throws TransactionIdFieldSizeException
     */
    public function shouldBeNotCreatableTransactionWithEmptyTransactionStatus(): void
    {
        $this->expectException(NotFoundTransactionStatusException::class);

        $factory = new TransactionFactory();
        $data = ['id' => 'asd'];
        $factory->create($data);
    }

    /**
     * @test
     *
     * @throws EmptyTransactionInformationException
     * @throws EmptyTransactionOperationException
     * @throws EmptyTransactionStatusException
     * @throws NotFoundTransactionIdException
     * @throws NotFoundTransactionOperationException
     * @throws NotFoundTransactionStatusException
     * @throws TransactionIdFieldSizeException
     */
    public function shouldBeNotCreatableTransactionWithEmptyTransactionOperation(): void
    {
        $this->expectException(NotFoundTransactionOperationException::class);

        $factory = new TransactionFactory();
        $data = ['id' => 'asd', 'status' => 'asd'];
        $factory->create($data);
    }
}
