<?php

namespace Lib\Services;

use Lib\Entity\Transaction\Transaction;

class FailPayStrategy implements PayStrategyInterface
{
    private Transaction $transaction;

    /**
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function process(): void
    {
        $transactionId = $this->transaction->getId()->getValue();
        $transactionOperation = $this->transaction->getOperation()->getValue();
        $transactionStatus = $this->transaction->getStatus()->getValue();

        $transactionData = [
            'transaction_id' => $transactionId,
            'transaction_operation' => $transactionOperation,
            'transaction_status' => $transactionStatus,
        ];

        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->helper('url');
        $CI->session->set_flashdata($transactionData);

        redirect('/page/sorry');
    }
}
