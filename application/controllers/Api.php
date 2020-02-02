<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\Services\CallbackRequestHandlerService;

class Api extends CI_Controller
{
	public function callback(): void
    {
        $this->load->helper('url');
        $requestData = $this->input->get('requestData');

        $requestHandler = new CallbackRequestHandlerService($requestData, $this->db);
        $requestHandler->handle();
	}
}
