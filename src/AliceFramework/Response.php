<?php

namespace AliceFramework;

class Response
{
    /**
     * @var string Request session_id
     */
    private string $sessionId;

    /**
     * @var string Request message_id
     */
    private string $messageId;

    /**
     * @var string Request user_id
     */
    private string $userId;

    public function __construct(string $sessionId, string $messageId, string $userId)
    {
        $this->sessionId = $sessionId;
        $this->messageId = $messageId;
        $this->userId    = $userId;
    }

    /**
     * Generate error JSON
     *
     * @param string $text Error message
     * @return false|string
     */
    public static function error(string $text) : false|string
    {
        return json_encode([
            'version' => '1.0',
            'session' => 'Error',
            'response' => [
                'text' => $text,
                'tts'  =>  $text
            ]
        ]);
    }

    /**
     * Generate success JSON
     *
     * @param string $text Success message
     * @return false|string
     */
    public function success(string $text) : false|string
    {
        return json_encode([
            'version' => '1.0',
            'session' => [
                'session_id' => $this->sessionId,
                'message_id' => $this->messageId,
                'user_id'    => $this->userId
            ],
            'response' => [
                'text'        => $text,
                'tts'         => $text,
                'buttons'     => [],
                'end_session' => false
            ]
        ]);
    }
}