<?php

namespace Lib\Services;

use JsonException;
use Lib\Exception\EmptyRequestDataException;
use Lib\Exception\EncodingRequestDataException;

class RequestHandlerService
{
    private string $request;

    /**
     * @param string $request
     */
    public function __construct(string $request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        if (!$this->request) {
            $exception = new EmptyRequestDataException();

            log_message('error', $exception->getMessage());
        }

        try {
            /* if the response from the gateway will change in the future,
            then it is necessary to encapsulate the request in a separate object */
            $request = json_decode($this->request, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            $exception = new EncodingRequestDataException($exception->getMessage());

            log_message('error', $exception->getMessage());
        }

        return $request;
    }
}
