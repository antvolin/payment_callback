<?php

namespace Lib;

class Transaction
{
    private string $id;
    private string $operation;
    private string $status;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (!isset($data['id']) || !$data['id']) {
            log_message('error', 'Missing data Id information from Request Payload!');
        }
        if (!isset($data['operation']) || !$data['operation']) {
            log_message('error', 'Missing data Operation information from Request Payload!');
        }
        if (!isset($data['status']) || !$data['status']) {
            log_message('error', 'Missing data Status information from Request Payload!');
        }

        $this->id = $data['id'];
        $this->operation = $data['operation'];
        $this->status = $data['status'];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
