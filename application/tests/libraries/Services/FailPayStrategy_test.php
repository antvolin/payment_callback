<?php

use Lib\Exception\EmptyTransactionInformationException;
use Lib\Exception\EmptyTransactionOperationException;
use Lib\Exception\EmptyTransactionStatusException;
use Lib\Exception\NotFoundTransactionIdException;
use Lib\Exception\NotFoundTransactionOperationException;
use Lib\Exception\NotFoundTransactionStatusException;
use Lib\Exception\TransactionIdFieldSizeException;
use Lib\Factory\TransactionFactory;
use Lib\Services\FailPayStrategy;

class FailPayStrategy_test extends TestCase
{
    private CI_Session $session;

    protected function setUp(): void
    {
        $this->resetInstance();
        $this->CI->load->library('session');
        $this->session = $this->CI->session;
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
    public function transactionDataShouldBeWriteToSessionAndRedirectedToThankYouPage(): void
    {
        $id = '1234567890123456';
        $status = '1234567890';
        $operation = 'asd';

        $factory = new TransactionFactory();
        $requestData = [
            'id' => $id,
            'status' => $status,
            'operation' => $operation,
        ];
        $transaction = $factory->create($requestData);

        $failStrategy = new FailPayStrategy($transaction);

        try {
            $failStrategy->process();
        } catch (\Exception $exception) {
            $this->assertEquals($id, $this->session->userdata('transaction_id'));
            $this->assertEquals($status, $this->session->userdata('transaction_status'));
            $this->assertEquals($operation, $this->session->userdata('transaction_operation'));

            $this->assertEquals('Redirect to /index.php/page/sorry', $exception->getMessage());
        }
    }
}
