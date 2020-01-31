<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{
	public function callback(): void
    {
        $this->load->helper('url');

        $this->load->library('request_handler', ['requestData' => $this->input->get('requestData')]);
        $transaction = $this->request_handler->handle();

        $this->load->library('transaction_handler', ['transaction' => $transaction]);
        $this->transaction_handler->handle();
	}
}
