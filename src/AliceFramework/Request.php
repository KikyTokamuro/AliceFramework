<?php

namespace AliceFramework;

class Request
{
    /**
     * @var array Request data
     */
    private array $data = [];

    /**
     * @var bool Is empty request
     */
    private bool $isEmpty = true;

    /**
     * @var bool Is valid request
     */
    private bool $isValid = false;

    /**
     * @var string Request command
     */
    private string $command = "";

    /**
     * @var string Request session_id
     */
    private string $sessionId = "";

    /**
     * @var string Request message_id
     */
    private string $messageId = "";

    /**
     * @var string Request user_id
     */
    private string $userId = "";

    public function __construct(string $data)
    {
        if (empty($data))
            return;

        $this->isEmpty = false;

        // Decode request JSON
        $requestData = json_decode($data, true);

        // Validate request
        if ($this->isValidData($requestData))
        {
            $this->isValid = true;

            // Set request params
            $this->command   = strtolower($requestData['request']['command']);
            $this->sessionId = $requestData['session']['session_id'];
            $this->messageId = $requestData['session']['message_id'];
            $this->userId    = $requestData['session']['user_id'];
        }
    }

    /**
     * Validate request data
     *
     * @param mixed $requestData Request data
     * @return bool
     */
    private function isValidData(mixed $requestData) : bool
    {
        return isset(
            $requestData['request'],
            $requestData['request']['command'],
            $requestData['session'],
            $requestData['session']['session_id'],
            $requestData['session']['message_id'],
            $requestData['session']['user_id']
        );
    }

    /**
     * Request is valid
     *
     * @return bool
     */
    public function isValid() : bool
    {
        return $this->isValid && !$this->isEmpty;
    }

    /**
     * @return string Get request command
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @return string Get request session_id
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * @return string Get request message_id
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

    /**
     * @return string Get request user_id
     */
    public function getUserId(): string
    {
        return $this->userId;
    }
}