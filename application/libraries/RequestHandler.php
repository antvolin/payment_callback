<?php

namespace Lib;

use JsonException;

class RequestHandler
{
    private string $requestData;

    /**
     * @param string $requestData
     */
    public function __construct(string $requestData)
    {
        $this->requestData = $requestData;
    }

    /**
     * @return Transaction
     */
    public function handle(): Transaction
    {
        if (!$this->requestData) {
            log_message('error', 'Missing data from Request Payload!');
        }

        $transactionData = [];

        try {
            $transactionData = json_decode($this->requestData, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            log_message('error', $exception->getMessage());
        }

        if (!isset($transactionData['transaction'])) {
            log_message('error', 'Missing Transaction information from Request Payload!');
        }

        return new Transaction($transactionData['transaction']);
    }
}