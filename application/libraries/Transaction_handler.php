<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_handler
{
    protected CI_Controller $CI;
    private Transaction $transaction;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->CI =& get_instance();
        $this->transaction = $data['transaction'];
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