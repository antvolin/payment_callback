<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_handler
{
    protected CI_Controller $CI;
    private string $requestData;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->CI =& get_instance();
        $this->requestData = $data['requestData'];
    }

    /**
     * @return Transaction
     */
    public function handle(): Transaction
    {
        if (!$this->requestData) {
            log_message('error', 'Missing data from Request Payload!');
        }

        $data = [];

        try {
            $data = json_decode($this->requestData, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            log_message('error', $exception->getMessage());
        }

        if (!isset($data['transaction'])) {
            log_message('error', 'Missing Transaction information from Request Payload!');
        }

        $this->CI->load->library('transaction', $data['transaction']);

        return $this->CI->transaction;
    }
}