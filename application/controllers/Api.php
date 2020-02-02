<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\Services\CallbackRequestHandlerService;

class Api extends CI_Controller
{
	public function callback(): void
    {
        $requestHandler = new CallbackRequestHandlerService($this->input->post(), $this->db);
        $requestHandler->handle();
	}
}
