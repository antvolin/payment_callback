<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\Services\CallbackRequestHandlerService;
use Lib\Repository\Repository;

class Api extends CI_Controller
{
	public function callback(): void
    {
        $requestHandler = new CallbackRequestHandlerService($this->input->post(), Repository::getInstance());
        $requestHandler->handle();
	}
}
