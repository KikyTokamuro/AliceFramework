<?php

namespace AliceFramework;

use AliceFramework\Commands\CommandList;

class App
{
    /**
     * @var string Dialog name
     */
    private string $name;

    /**
     * @var Request Dialog request
     */
    private Request $request;

    /**
     * @param string $data Request
     * @param string $name Dialog Name
     */
    public function __construct(string $data, string $name = "AliceFramework")
    {
        $this->name = strtolower($name);
        $this->request = new Request($data);
    }

    /**
     * Start processing request data
     *
     * @return false|string
     */
    public function start() : false|string
    {
        if (!$this->request->isValid())
            return Response::error('Wrong request');

        $response = new Response(
            $this->request->getSessionId(),
            $this->request->getMessageId(),
            $this->request->getUserId()
        );

        // Command includes skill name
        if (str_contains($this->request->getCommand(), $this->name) || empty($this->request->getCommand()))
            return $response->success('Hello i am ' . $this->name);

        // Check command
        if (!CommandList::exists($this->request->getCommand()))
            return $response->success('I do not understand');

        // Command processing
        try {
            return $response->success(
                (new CommandList::$commands[$this->request->getCommand()])->start()
            );
        }
        catch (\Exception $e)
        {
            return Response::error('Command error');
        }
    }
}
