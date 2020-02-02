<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\Services\CallbackRequestHandlerService;

class Api extends CI_Controller
{
	public function callback(): void
    {
        $requestData = $this->input->post('requestData');

        $requestHandler = new CallbackRequestHandlerService($requestData, $this->db);
        $requestHandler->handle();
	}
}
