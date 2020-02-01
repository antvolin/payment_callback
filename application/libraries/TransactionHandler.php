<?php

namespace Lib;

use CI_Controller;

class TransactionHandler
{
    protected CI_Controller $CI;
    private Transaction $transaction;

    /**
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->CI =& get_instance();
        $this->transaction = $transaction;
    }

    public function handle(): void
    {
        $status = $this->transaction->getStatus();

        if ('fail' === $status) {
            $transactionData = [
                'transaction_id' => $this->transaction->getId(),
                'transaction_operation' => $this->transaction->getOperation(),
                'transaction_status' => $status,
            ];
            $this->CI->load->library('session');
            $this->CI->session->set_flashdata($transactionData);

            redirect('/page/sorry');
        } else {
            redirect('/page/thank_you');
        }
    }
}