<?php

namespace AliceFramework;

use AliceFramework\Commands\Common;

class Core
{
    
    /**
     * __construct
     *
     * @param string $data Request
     * @param string $name Skill Name
     */
    public function __construct($data, $name)
    {
        $this->name = $name;

        // Checking request
        if (!empty($data)) {
             $this->data = json_decode($data, true);

             if (
                 !isset($this->data['request'],
                        $this->data['request']['command'],
                        $this->data['session'],
                        $this->data['session']['session_id'],
                        $this->data['session']['message_id'],
                        $this->data['session']['user_id']
                 )
             ) {
                 $this->result = json_encode([]);
             } else {
                 $this->command    = strtolower($this->data['request']['command']);
                 $this->session_id = $this->data['session']['session_id'];
                 $this->message_id = $this->data['session']['message_id'];
                 $this->user_id    = $this->data['session']['user_id'];
             }
        } else {
            $this->result = $this->returnError('Данные отсутствуют');
        }
    }

    /**
     * returnError - Generate error response
     *
     * @param string $text
     */
    private function returnError($text)
    {
        return json_encode([
            'version' => '1.0',
            'session' => 'Error',
            'response' => [
                'text' => $text,
                'tts' =>  $text
            ]
        ]);
    }

    /**
     * returnResponse - Generate success response
     *
     * @param mixed $text
     */
    private function returnResponse($text)
    {
        return json_encode([
            'version' => '1.0',
            'session' => [
                'session_id' => $this->session_id,
                'message_id' => $this->message_id,
                'user_id' => $this->user_id
            ],
            'response' => [
                'text' => $text,
                'tts' => $text,
                'buttons' => [],
                'end_session' => false
            ]
        ]);
    }
    
    /**
     * start - Start AliceFramework
     */
    public function start()
    {
        // Return error
        if (isset($this->result)) {
            return $this->result;
        }

        // Command includes skill name
        if (strpos($this->command, $this->name) !== false) {
            $this->result = $this->returnResponse('Привет я навык ' . $this->name);
            return $this->result;
        }

        // Command processing
        if (array_key_exists($this->command, Common::$commands)) {
            $cmd = new Common::$commands[$this->command];
            $this->result = $this->returnResponse($cmd->start());
        } else {
            $this->result = $this->returnResponse('Я вас не понимаю, либо вы ничего не сказали');
        }
        
        return $this->result;
    }
}
