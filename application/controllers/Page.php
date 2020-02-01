<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller
{
	public function sorry(): void
    {
        $this->load->library('session');

        $templateParams = [
            'transactionId' => $this->session->userdata('transaction_id'),
            'transactionOperation' => $this->session->userdata('transaction_operation'),
            'transactionStatus' => $this->session->userdata('transaction_status'),
        ];

        $this->load->view('pages/sorry', $templateParams);
	}

	public function thank_you(): void
    {
        $this->load->view('pages/thank_you');
    }
}
