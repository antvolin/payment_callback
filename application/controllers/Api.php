<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\Services\RequestHandlerService;
use Lib\Services\TransactionHandlerService;

class Api extends CI_Controller
{
	public function callback(): void
    {
        $this->load->helper('url');
        $requestData = $this->input->get('requestData');

        $requestHandler = new RequestHandlerService($requestData);
        $requestData = $requestHandler->handle();

        $transactionHandler = new TransactionHandlerService($requestData);
        $transactionHandler->handle();
	}
}
