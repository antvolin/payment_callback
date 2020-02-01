<?php

use Lib\RequestHandler;
use Lib\TransactionHandler;

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{
	public function callback(): void
    {
        $this->load->helper('url');

        $requestData = $this->input->get('requestData');

        $requestHandler = new RequestHandler($requestData);
        $transaction = $requestHandler->handle();

        $transactionHandler = new TransactionHandler($transaction);
        $transactionHandler->handle();
	}
}
