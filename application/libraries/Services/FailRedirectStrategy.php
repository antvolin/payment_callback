<?php

namespace Lib\Services;

use Lib\Entity\Transaction\Transaction;

class FailRedirectStrategy implements RedirectStrategyInterface
{
    private Transaction $transaction;

    /**
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function redirect(): void
    {
        $transactionId = $this->transaction->getId();
        $transactionOperation = $this->transaction->getOperation();
        $transactionStatus = $this->transaction->getStatus();

        $transactionData = [
            'transaction_id' => $transactionId,
            'transaction_operation' => $transactionOperation,
            'transaction_status' => $transactionStatus,
        ];
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->set_flashdata($transactionData);

        redirect('/page/sorry');
    }
}
